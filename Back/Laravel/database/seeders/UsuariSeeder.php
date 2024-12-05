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

        if (!file_exists($archivo_json)) {
            $this->command->error('El archivo JSON no existe');
            return;
        }

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
                'nom' => $user['nom'],
                'cognom1' => $user['cognom1'],
                'cognom2' => $user['cognom2'],
                'email' => $user['email'],
                'password' => $user['password'],
                'rol' => $user['rol'],
                'data_naixement' => $user['data_naixement'],
                'telefon' => $user['telefon'],
                'foto_profile' => $user['foto_profile'] ?? null,
                'biografia' => $user['biografia'] ?? null,
                'major' => $user['major'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at']
            ]);
        }
        $this->command->info('Usuarios creados correctamente');
    }
}
