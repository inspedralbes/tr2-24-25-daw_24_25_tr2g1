<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Usuari;

class UsuariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $archivo_json = base_path('./resources/json/user.json');

         // Clear existing data
         DB::table('publicacions')->truncate();

        // Leer el archivo JSON
        $json_data = file_get_contents($archivo_json);
        $data = json_decode($json_data, true);

        // Validar la estructura del JSON
        if (!isset($data['users']) || !is_array($data['users'])) {
            $this->command->error('Estructura de JSON inválida');
            return;
        }

        // enviar los datos a la base de datos
        foreach ($data['users'] as $user) {
            Usuari::create([
                'id' => $user['id'],
                'correu' => $user['correu'],
                'correualternatiu' => $user['correualternatiu'],
                'password' => $user['password'],
                'pregunta_secreta' => $user['pregunta_secreta'],
                'resposta_secreta' => $user['resposta_secreta'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at']
            ]);
        }
        $this->command->info('Usuarios creados correctamente');
    }
}
