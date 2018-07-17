<?php

use Illuminate\Database\Seeder;
use App\Entities\DailyReports;
use Carbon\Carbon;

class DailyReportsTableSeeder extends Seeder
{

    public function run()
    {
        DailyReports::truncate();
        DailyReports::create(
            [
                'user_id' => 1,
                'title' => '初日',
                'contents' => '研修初日でした。',
                'reporting_time' => Carbon::create('2016','1','20'),
            ]
        );
        DailyReports::create(
            [
                'user_id' => 1,
                'title' => 'テスト１',
                'contents' => 'これはテスト１です。',
                'reporting_time' => Carbon::create('2016','3','20'),
            ]
        );
        DailyReports::create(
            [
                'user_id' => 1,
                'title' => 'テスト２',
                'contents' => 'これはテスト２です。',
                'reporting_time' => Carbon::create('2016','3','25'),
            ]
        );
        DailyReports::create(
            [
                'user_id' => 1,
                'title' => 'テスト３',
                'contents' => 'これはテスト３です。',
                'reporting_time' => Carbon::create('2017','3','20'),
            ]
        );
        DailyReports::create(
            [
                'user_id' => 1,
                'title' => 'テスト４',
                'contents' => 'これはテスト４です。',
                'reporting_time' => Carbon::create('2017','4','16'),
            ]
        );
    }
}
