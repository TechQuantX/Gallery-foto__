<?php
// database/seeders/UserSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan UserFactory untuk membuat 10 data palsu pengguna
        User::factory()->count(10)->create();
    }
}
