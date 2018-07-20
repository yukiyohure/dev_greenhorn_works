<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    User::truncate();
    User::create([
      'name' => 'test',
      'password' => bcrypt('1234'),
      'user_info_id' => 1
    ]);
    User::create([
      'name' => 'test1',
      'password' => bcrypt('1234'),
      'user_info_id' => 2
    ]);
    User::create([
      'name' => 'test2',
      'password' => bcrypt('1234'),
      'user_info_id' => 3
    ]);
  }
}
