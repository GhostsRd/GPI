<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class, // Si vous avez un seeder pour les users
            OrdinateurSeeder::class,
            MoniteurSeeder::class,
            logicielSeeder::class,
            PeripheriqueSeeder::class,

        ]);
    }
}
