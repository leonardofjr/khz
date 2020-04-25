<?php

use Illuminate\Database\Seeder;
use App\ProductTag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductTag::truncate();
        ProductTag::create(['name' => 'beat']);
    }
}
