<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Ananda Bayu',
                'email' => 'bayu@email.com',
                'password' => 'bayu1234',
                'npp' => '12345',
                'npp_supervisor' => '11111',
            ],
            [
                'nama' => 'Supervisor',
                'email' => 'spv@email.com',
                'password' => 'spv12345',
                'npp' => '11111',
                'npp_supervisor' => null,
            ],
        ];

        foreach ($data as $key => $item) {
            User::create($item);
        }
    }
}