<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class RemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $announcement_image_id;

    /**
     * Create a new job instance.
     */
    public function __construct($announcement_image_id)
    {
        $this->announcement_image_id = $announcement_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = Image::find($this->announcement_image_id);
        if (!$i) {
            return;
        }

        $srcPath = storage_path('app/public/' . $i->path);

        // Imposta la variabile di ambiente GOOGLE_APPLICATION_CREDENTIALS
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        // https://cloud.google.com/vision/docs/detecting-faces
        $imageAnnotator = new ImageAnnotatorClient();
        $content = file_get_contents($srcPath);
        $response = $imageAnnotator->faceDetection($content);
        $faces = $response->getFaceAnnotations();

        $image = SpatieImage::load($srcPath);

        foreach ($faces as $face) {
            $vertices = $face->getBoundingPoly()->getVertices();

            $bounds = [];

            foreach ($vertices as $vertex) {
                $bounds[] = [$vertex->getX(), $vertex->getY()];
            }

            // Calcolare la larghezza e l'altezza del rettangolo di delimitazione del volto
            $wmWidth = $bounds[2][0] - $bounds[0][0];
            $wmHeight = $bounds[2][1] - $bounds[0][1];

            // Calcolare il centro del rettangolo di delimitazione del volto
            $centerX = $bounds[0][0] + (($bounds[2][0] - $bounds[0][0]) / 2);
            $centerY = $bounds[0][1] + (($bounds[2][1] - $bounds[0][1]) / 2);

            // Calcolare il padding in modo che la filigrana sia centrata sul volto
            $paddingX = $centerX - ($wmWidth / 2);
            $paddingY = $centerY - ($wmHeight / 2);

            $image->watermark(base_path('resources/img/smile.png'))
                ->watermarkPosition('top-left') // Posizionare la filigrana in base al punto in alto a sinistra
                ->watermarkPadding($paddingX, $paddingY)
                ->watermarkWidth($wmWidth, Manipulations::UNIT_PIXELS)
                ->watermarkHeight($wmHeight, Manipulations::UNIT_PIXELS)
                ->watermarkFit(Manipulations::FIT_STRETCH);
        }

        $image->save($srcPath);
        $imageAnnotator->close();
    }
}