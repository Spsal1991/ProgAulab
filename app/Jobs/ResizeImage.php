<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $w;
    private $h;
    private $fileName;
    private $path;
    /**
     * Create a new job instance.
     */
    public function __construct($filePath, $w, $h)
    {
        $this->path = dirname($filePath);
        $this->fileName = basename($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $w = $this->w;
        $h = $this->h;
        $scrPath = storage_path() . "/app/public/" . $this->path . "/" . $this->fileName;
        $destPath = storage_path() . "/app/public/" . $this->path . "/crop_" . $this->fileName;
        
        $croppedImage = Image::load($scrPath)
            ->crop(Manipulations::CROP_CENTER, $w, $h)
            ->watermark(base_path('public/Media-Css/logo2.png'))

            ->watermarkOpacity(70)
            ->watermarkWidth(100, Manipulations::UNIT_PIXELS)
            ->watermarkHeight(100, Manipulations::UNIT_PIXELS)
            ->watermarkPadding(5, 5, Manipulations::UNIT_PERCENT)
            ->save($destPath);
    }
}
