<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    \App\Models\Service::create(['name' => 'Wash, dry & fold', 'price_per_unit' => 8000, 'unit' => 'kg']);
    \App\Models\Service::create(['name' => 'Express wash', 'price_per_unit' => 12000, 'unit' => 'kg']);
    \App\Models\Service::create(['name' => 'Ironing only', 'price_per_unit' => 6000, 'unit' => 'kg']);
    \App\Models\Service::create(['name' => 'Dry cleaning shirt', 'price_per_unit' => 20000, 'unit' => 'item']);

    \App\Models\Customer::create(['name' => 'Rina Wulandari', 'phone' => '081234567890', 'address' => 'Sukolilo, Surabaya']);
    \App\Models\Customer::create(['name' => 'Budi Santoso', 'phone' => '081298765432', 'address' => 'Keputih, Surabaya']);
}
}
