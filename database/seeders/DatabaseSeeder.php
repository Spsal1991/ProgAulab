<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Region;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [['name' => 'Auto', 'img' => 'car.png'], ['name' => 'Moto', 'img' => 'moto.png'], ['name' => 'Elettrodomestici', 'img' => 'elettrodomestici.png'], ['name' => 'Smartphone', 'img' => 'smartphone.png'], ['name' => 'Biciclette', 'img' => 'biciclette.png'], ['name' => 'Sport', 'img' => 'sport.png'], ['name' => 'Videogiochi', 'img' => 'videogiochi.png'], ['name' => 'Pc-Laptop', 'img' => 'pc.png']];

        foreach ($categories as $category) {
            $categoryModel = new Category();
            $categoryModel->name = $category['name'];
            $categoryModel->img = '/Media-Css/' . $category['img'];
            $categoryModel->save();
        }

        $regions = [['name' => 'Abruzzo', 'img' => 'auto.svg'], ['name' => 'Basilicata', 'img' => 'moto.svg'], ['name' => 'Calabria', 'img' => 'elettrodomestici.svg'], ['name' => 'Campania', 'img' => 'smartphone.svg'], ['name' => 'Emilia-Romagna', 'img' => 'biciclette.svg'], ['name' => 'Friuli', 'img' => 'sport.svg'], ['name' => 'Lazio', 'img' => 'videogiochi.svg'], ['name' => 'Liguria', 'img' => 'pc.svg'], ['name' => 'Lombardia', 'img' => 'videogiochi.svg'], ['name' => 'Marche', 'img' => 'pc.svg'], ['name' => 'Molise', 'img' => 'auto.svg'], ['name' => 'Piemonte', 'img' => 'moto.svg'], ['name' => 'Puglia', 'img' => 'elettrodomestici.svg'], ['name' => 'Sardegna', 'img' => 'smartphone.svg'], ['name' => 'Sicilia', 'img' => 'biciclette.svg'], ['name' => 'Toscana', 'img' => 'sport.svg'], ['name' => 'Trentino', 'img' => 'videogiochi.svg'], ['name' => 'Umbria', 'img' => 'pc.svg'], ['name' => "Valle D'Aosta", 'img' => 'videogiochi.svg'], ['name' => 'Veneto', 'img' => 'pc.svg']];

        foreach ($regions as $region) {
            $regionModel = new Region();
            $regionModel->name = $region['name'];
            $regionModel->img = '/Media-Css/' . $region['img'];
            $regionModel->save();
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
