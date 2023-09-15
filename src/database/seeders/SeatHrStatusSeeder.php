<?php

namespace Cryocaustik\SeatHr\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatHrStatusSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('seat_hr_statuses')->insert([
            [
                'name' => 'pending',
                'color' => 'secondary',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'in review',
                'color' => 'primary',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'approved',
                'color' => 'success',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'canceled',
                'color' => 'warning',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'denied',
                'color' => 'danger',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
