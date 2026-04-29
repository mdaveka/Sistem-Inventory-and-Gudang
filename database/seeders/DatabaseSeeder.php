<?php

namespace Database\Seeders;

use App\models\user;
use Illuminate\Database\Console\Sead\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   use WithoutModelEvents;
  
 public function run(): void
    {
        // User::factory(10)->create(); memanggil class pada user
        $this->call([
            User::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}