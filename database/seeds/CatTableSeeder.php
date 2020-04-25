<?php

use Illuminate\Database\Seeder;
use App\ProductCat;

class CatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCat::truncate();
        ProductCat::create(['name' => 'beat']);
        ProductCat::create(['name' => 'sound']);
    }
}
