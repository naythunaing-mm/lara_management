<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class siteSettingsTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->truncate();
        DB::table('site_settings')->insert([
            'id'             => '1',
            'name'           => 'Lara Hotel',
            'email'          => 'larahotel@gmail.com',
            'address'        => '132St, Tamwe Township, Yangon',
            'checkin'        => Carbon::createFromFormat('g:i A', '9:00 AM')->format('H:i:s'),
            'checkout'       => Carbon::createFromFormat('g:i A', '6:00 PM')->format('H:i:s'),
            'break_start'    => Carbon::createFromFormat('g:i A', '12:00 PM')->format('H:i:s'),
            'break_end'      => Carbon::createFromFormat('g:i A', '1:00 PM')->format('H:i:s'),
            'hotel_checkin'  => Carbon::createFromFormat('g:i A', '2:00 PM')->format('H:i:s'),
            'hotel_checkout' => Carbon::createFromFormat('g:i A', '12:00 PM')->format('H:i:s'),
            'outline_phone'  => '09772803152',
            'online_phone'   => '0944315522',
            'size_unit'      => 'cm',
            'occupancy'      => 'Peoples',
            'price_unit'     => 'USD($)',
            'logo'           => 'logo.png',
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s')
        ]);
    }
}
