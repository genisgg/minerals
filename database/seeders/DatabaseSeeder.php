<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //usuaris
        User::factory(11)->create();

        User::factory()->create([
            'name' => 'usuari1',
            'email' => 'usuari1@uvic.cat',
            'password' => bcrypt('123456'),
        ]);

        User::factory()->create([
            'name' => 'usuari2',
            'email' => 'usuari2@uvic.cat',
            'password' => bcrypt('123456'),
            'admin' => true,
        ]);

        //categories
        $categories = ['Or', 'Plata', 'Coure', 'Ferro', 'Diamant'];

        foreach ($categories as $categoria) {
            DB::table('categoria')->insert([
                'nom_categoria' => $categoria,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //comandes
        for ($i = 0; $i < 11; $i++) {
            DB::table('comanda')->insert([
                'usuari_id' => random_int(1, 11),
                'data_comanda' => now()->subDays(random_int(1, 30))->toDateTimeString(),
            ]);
        }

        //minerals
        for ($i = 0; $i < 11; $i++) {
            DB::table('minerals')->insert([
                'categoria_id' => random_int(1, count($categories)),
                'nom' => 'Mineral ' . $i,
                'descripcio' => 'Descripció del mineral ' . $i,
                'preu' => random_int(5, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //comanda_mineral (N:M)
        for ($i = 0; $i < 11; $i++) {
            DB::table('comanda_mineral')->insert([
                'usuari_id' => random_int(1, 11),
                'comanda_id' => random_int(1, 11),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
