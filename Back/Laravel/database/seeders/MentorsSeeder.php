<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mentor;

class MentorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('mentors')->truncate();

        $archivo_json = base_path('./resources/json/mentors.json');

        if (!file_exists($archivo_json)) {
            $this->command->error('El archivo JSON no existe');
            return;
        }

        // Leer el archivo JSON
        $json_data = file_get_contents($archivo_json);
        $data = json_decode($json_data, true);

        // Validar la estructura del JSON
        if (!isset($data['mentors']) || !is_array($data['mentors'])) {
            $this->command->error('Estructura de JSON inválida');
            return;
        }

        // Enviar los datos a la base de datos
        foreach($data['mentors'] as $mentor){
            try {
                Mentor::create([
                    'nom' => $mentor['nom'],
                    'cognom'=> $mentor['cognom'],
                    'correu'=> $mentor['correu'],
                    'especialitat'=> $mentor['especialitat'],
                    'curs'=> $mentor['curs'],

                    

                ]);
            } catch (\Exception $e) {
                $this->command->error('Error al crear publicació: ' . $e->getMessage());
            }
        }
        $this->command->info('Mentors creades correctament');
    }
}
