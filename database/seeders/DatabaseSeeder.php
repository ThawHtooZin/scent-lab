<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@scentlab.test'], [
            'name' => 'Scent Lab Admin',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $this->call([CategorySeeder::class, ProductSeeder::class]);
    }
}
