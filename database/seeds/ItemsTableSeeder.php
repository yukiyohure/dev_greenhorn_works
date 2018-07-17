<?php

use Illuminate\Database\Seeder;
use App\Entities\Items;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Items::truncate();
        Items::create([
          'item_category_id' => 1,
          'name' => 'book1',
          'item_info' => 'test1',
          ]);

        Items::create([
          'item_category_id' => 2,
          'name' => 'PC1',
          'item_info' => 'test2',
          ]);
    }
}
