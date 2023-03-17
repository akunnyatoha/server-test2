<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_product' => "A00001",
                'title' => 'Saus Botol',
                'quantity' => 20,
                'price' => 15000
            ]
        ];

        foreach ($data as $item) {
            Product::create($item);
        }
    }
}
