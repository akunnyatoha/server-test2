<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => "yanto",
                'no_telepon' => '084567834',
                'email' => 'yanto@email.com',
                'alamat' => 'Bandung'
            ],
            [
                'nama' => "yanti",
                'no_telepon' => '0823453456',
                'email' => 'yanto@email.com',
                'alamat' => 'Surabaya'
            ],
            [
                'nama' => "yani",
                'no_telepon' => '081234567',
                'email' => 'yanto@email.com',
                'alamat' => 'Jakarta'
            ],
        ];

        foreach ($data as $item) {
            Customer::create($item);
        }
    }
}
