<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Gasto;

class GastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creado con php artisan make:seeder GastoSeeder con el objetivo de crear 20 gastos aleatorios 
     * para cada uno de los usuarios. Una vez hecho llamamos al seeder desde DatabaseSeeder.php.
     * Por último se ejecutan los seeders desde php artisan db:seed
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            // Generar 20 gastos para cada usuario
            Gasto::factory()->count(20)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
