<?php

use Illuminate\Database\Seeder;
use App\Entities\Stores;

class StoresTableSeeder extends Seeder
{
  public function run()
  {
    Stores::truncate();
    Stores::create([
      'name' => '新宿店',
      'kana_name' => 'シンジュクテン',
    ]);
    Stores::create([
      'name' => '渋谷店',
      'kana_name' => 'シブヤテン',
    ]);
    Stores::create([
      'name' => '池袋店',
      'kana_name' => 'イケブクロテン',
    ]);
  }
}
