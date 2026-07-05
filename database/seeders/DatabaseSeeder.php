<?php

namespace Database\Seeders;

use App\Models\{User, Supplier, Warehouse, Item};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'admin@test.com'],
            ['name' => 'Admin Utama', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        // 2. Data Gudang (Warehouse)
        $wh1 = Warehouse::updateOrCreate(['name' => 'Gudang Utama'], ['location' => 'Plesungan, Karanganyar']);
        
        // 3. Data Supplier
        $sup1 = Supplier::updateOrCreate(['name' => 'PT. SIAP KANGMAS'], ['phone' => '081234567', 'address' => 'Solo']);

        // 4. Data Barang (Items)
        Item::updateOrCreate(
            ['barcode' => 'BRX-001'],
            [
                'name' => 'T-SHIRT FEETED TEE BLACK',
                'supplier_id' => $sup1->id,
                'stock' => 17,
                'min_stock' => 5
            ]
        );
    }
}
