<?php

use Illuminate\Database\Seeder;
use App\Entities\RentInfos;

class RentInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RentInfos::truncate();
        RentInfos::create([
            'user_id' => 1,
            'item_id' => 1,
            'admin_user_id' => 1,
            'rental_request_at' => '2017-05-22 00:00:00',
            'created_at' => '2017-05-22 00:00:00',
            'updated_at' => '2017-05-22 00:00:00',
        ]);

        RentInfos::create([
            'user_id' => 2,
            'item_id' => 2,
            'admin_user_id' => 1,
            'rental_request_at' => '2017-05-24 00:00:00',
            'created_at' => '2017-05-24 00:00:00',
            'updated_at' => '2017-05-24 00:00:00',
        ]);
    }
}
