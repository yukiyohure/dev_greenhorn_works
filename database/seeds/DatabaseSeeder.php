<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(DailyReportsTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(RentInfosTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ItemCategoriesTableSeeder::class);
        $this->call(TagCategoriesSeeder::class);
    }
}
