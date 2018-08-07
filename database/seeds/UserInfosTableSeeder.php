<?php

use Illuminate\Database\Seeder;
use App\Models\UserInfos;

class UserInfosTableSeeder extends Seeder
{
  public function run()
  {
    UserInfos::truncate();
    {
    UserInfos::create([
        'first_name' => '聖史',
        'last_name' => '坂田',
        'email' => 'hoge@gmail.com',
        'tel' => 11111111,
        'sex' => '男',
        'birthday' => '1997-06-12',
        'hire_date' => '2017-12-3',
        'store_id' => 1,
        'access_right' => 6,
        'position_code' => 75,
        'is_registered' => 1 

    ]);
    UserInfos::create([
        'first_name' => '大地',
        'last_name' => '安藤',
        'email' => 'fuga@gmail.com',
        'tel' => 222222222,
        'sex' => '男',
        'birthday' => '1993-10-24',
        'hire_date' => '2017-04-3',
        'store_id' => 2,
        'access_right' => 7,
        'position_code' => 25,
        'is_registered' => 1 

    ]);
    UserInfos::create([
        'first_name' => '翔平',
        'last_name' => '金谷',
        'email' => 'hogefuga@gmail.com',
        'tel' => 333333333,
        'sex' => '男',
        'birthday' => '1991-10-26',
        'hire_date' => '2018-07-16',
        'store_id' => 3,
        'access_right' => 0,
        'position_code' => 100,
        'is_registered' => 1 

    ]);
    }
  }
}
