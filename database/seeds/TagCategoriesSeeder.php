<?php

use Illuminate\Database\Seeder;
use App\Entities\TagCategory;

class TagCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TagCategory::truncate();
      TagCategory::create(
          [
            'name' => 'フロント',
          ]
      );

      TagCategory::create(
          [
            'name' => 'バック',
          ]
      );


      TagCategory::create(
          [
            'name' => 'その他',
          ]
      );
    }
}
