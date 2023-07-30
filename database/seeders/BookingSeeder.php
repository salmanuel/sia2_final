<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bk = [
            [
                'room_id' => 1,
                'last_name' => 'Salutan',
                'first_name' => 'John Emanuelle',
                'arrival_date' => '2023-07-31',
                'departure_date' => '2023-08-05',
                'num_adults' => 2,
                'num_kids' => 1,
                'phone' => '123-456-7890',
                'email' => 'salutanemanuelle@gmail.com',
            ],
            [
                'room_id' => 2,
                'last_name' => 'Salutan',
                'first_name' => 'John Emanuelle',
                'arrival_date' => '2023-07-31',
                'departure_date' => '2023-08-05',
                'num_adults' => 2,
                'num_kids' => 1,
                'phone' => '123-456-7890',
                'email' => 'emanuelle21latina@gmail.com',
            ],
        ];
        
        foreach ($bk as $b) {
            Booking::create($b);
        }
    }
}
