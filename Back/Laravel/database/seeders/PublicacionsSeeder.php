<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Publicacio;

class PublicacionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('publicacions')->truncate();

        $archivo_json = base_path('./resources/json/publicacions.json');

        if (!file_exists($archivo_json)) {
            $this->command->error('El archivo JSON no existe');
            return;
        }

        // Leer el archivo JSON
        $json_data = file_get_contents($archivo_json);
        $data = json_decode($json_data, true);

        // Validar la estructura del JSON
        if (!isset($data['publicacions']) || !is_array($data['publicacions'])) {
            $this->command->error('Estructura de JSON inválida');
            return;
        }

        // Enviar los datos a la base de datos
        foreach($data['publicacions'] as $publicacio){
            try {
                Publicacio::create([
                    'titol' => $publicacio['titol'],
                    'contingut' => $publicacio['contingut'],
                    // 'imatge' => $publicacio['imatge'],
                    'id_usuari' => $publicacio['id_usuari'],
                    'estat' => $publicacio['estat']
                ]);
            } catch (\Exception $e) {
                $this->command->error('Error al crear publicació: ' . $e->getMessage());
            }
        }
        $this->command->info('Publicacions creades correctament');
    }
}
