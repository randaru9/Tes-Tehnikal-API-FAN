<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Epresence;
use Illuminate\Support\Carbon;

class EpresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_users' => 1,
                'type' => Epresence::IN,
                'is_approve' => true,
                'waktu' => Carbon::createFromFormat('d/m/y H:i', '16/10/20 08:00'),
            ],
            [
                'id_users' => 1,
                'type' => Epresence::OUT,
                'is_approve' => false,
                'waktu' => Carbon::createFromFormat('d/m/y H:i', '16/10/20 17:00'),
            ],
        ];

        foreach ($data as $key => $item) {
            Epresence::create($item);
        }
    }
}