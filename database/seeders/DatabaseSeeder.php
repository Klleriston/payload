<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Usuario::create([
                'nome' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'saldo' => $faker->randomNumber(4),
                'tipoUsuario' => $faker->randomElement(['PF', 'PJ']),
                'cpf' => $faker->numerify('###########'),
                'cnpj' => $faker->numerify('##############'),
                'empresa' => $faker->domainName(),
            ]);
        }
    }
}
