<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $periods = new CarbonPeriod('2024-12-01', '2024-12-30');
            foreach ($periods as $period) {
                $attendance = new Attendance();
                $attendance->user_id = $user->id;
                $attendance->date = $period->format('Y-m-d');
                $attendance->save();
            }
        }
    }
}
