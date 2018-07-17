<?php

use Illuminate\Database\Seeder;
use App\Entities\ItemCategory;

class ItemCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemCategory::truncate();
        ItemCategory::create([
          'category' => '書籍',
        ]);
        ItemCategory::create([
          'category' => 'PC',
        ]);
    }
}
