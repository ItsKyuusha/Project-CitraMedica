<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        Obat::insert([
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet 500mg',
                'harga' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Kapsul 250mg',
                'harga' => 8000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Antasida',
                'kemasan' => 'Sirup 60ml',
                'harga' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Bodrexin',
                'kemasan' => 'Tablet 500mg',
                'harga' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Asam Mefenamat',
                'kemasan' => 'Tablet 500mg',
                'harga' => 6500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Metronidazole',
                'kemasan' => 'Tablet 500mg',
                'harga' => 4500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Chlorhexidine',
                'kemasan' => 'Botol 150ml',
                'harga' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Dexamethasone',
                'kemasan' => 'Tablet 0.5mg',
                'harga' => 2500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Clindamycin',
                'kemasan' => 'Kapsul 300mg',
                'harga' => 18000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Benzocaine Gel',
                'kemasan' => 'Tube 5 gram',
                'harga' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
