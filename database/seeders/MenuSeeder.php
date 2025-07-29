<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Minuman
            [
                'nama' => 'Kopi Americano',
                'resep' => 'Espresso shot dicampur dengan air panas. Rasio 1:2 untuk rasa yang seimbang.',
                'harga' => 25000,
                'kategori' => 'minuman'
            ],
            [
                'nama' => 'Cappuccino',
                'resep' => 'Espresso shot, steamed milk, dan milk foam. Rasio 1:1:1 untuk tekstur creamy.',
                'harga' => 30000,
                'kategori' => 'minuman'
            ],
            [
                'nama' => 'Latte',
                'resep' => 'Espresso shot dengan steamed milk dan sedikit foam. Rasio 1:3 milk.',
                'harga' => 35000,
                'kategori' => 'minuman'
            ],
            [
                'nama' => 'Iced Coffee',
                'resep' => 'Cold brew coffee dengan es batu, bisa ditambah simple syrup sesuai selera.',
                'harga' => 22000,
                'kategori' => 'minuman'
            ],
            [
                'nama' => 'Teh Tarik',
                'resep' => 'Teh hitam yang diseduh kental, dicampur susu kental manis dan ditarik hingga berbusa.',
                'harga' => 18000,
                'kategori' => 'minuman'
            ],

            // Makanan
            [
                'nama' => 'Nasi Goreng Spesial',
                'resep' => 'Nasi goreng dengan telur, ayam suwir, udang, dan sayuran. Disajikan dengan kerupuk.',
                'harga' => 45000,
                'kategori' => 'makanan'
            ],
            [
                'nama' => 'Sandwich Club',
                'resep' => 'Roti tawar dengan isian ayam grilled, lettuce, tomat, keju, dan mayo.',
                'harga' => 38000,
                'kategori' => 'makanan'
            ],
            [
                'nama' => 'Pasta Carbonara',
                'resep' => 'Spaghetti dengan saus carbonara, bacon bits, parmesan cheese, dan black pepper.',
                'harga' => 55000,
                'kategori' => 'makanan'
            ],
            [
                'nama' => 'French Fries',
                'resep' => 'Kentang goreng crispy dengan bumbu garam dan herbs. Disajikan dengan saus sambal.',
                'harga' => 25000,
                'kategori' => 'makanan'
            ],
            [
                'nama' => 'Croissant',
                'resep' => 'Pastry berlapis mentega yang dipanggang hingga golden brown. Tekstur flaky dan buttery.',
                'harga' => 20000,
                'kategori' => 'makanan'
            ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
