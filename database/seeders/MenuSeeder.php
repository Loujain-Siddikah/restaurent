<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item= Item::create([
            'name' => 'MENÜ1',
            'describtion' => 'ATOM ET + PATATES + AYRAN',
            'price' => '120',
            'img1' => '',
            'img2' => '',
            'img3' => ''
        ]);
    }
}
