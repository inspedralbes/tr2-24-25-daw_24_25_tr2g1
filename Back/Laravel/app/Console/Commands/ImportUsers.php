<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa els usuaris del fitxer JSON al BBD';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jsonFilePath = public_path('data.json');
        if (!file_exists($jsonFilePath)) {
            $this->error('NO s\'ha trobat el fitxer JSON.');
            return;
        }

        $json = file_get_contents($jsonFilePath);
        $data = json_decode($json, true);

        //verificacion d'error
        if (!isset($data['users']) || empty($data['users'])) {
            $this->error('NO s\'han trobat usuaris en el fitxer JSON.');
            return;
        }

        //Inserta categorias solo si no existen
        $categories = [
            ['id_categoria' => '1', 'nom_categoria' => 'Xarxes i Comunicacions'],
            ['id_categoria' => '2', 'nom_categoria' => 'Sistemes Operatius'],
            ['id_categoria' => '3', 'nom_categoria' => 'Seguretat Informàtica'],
            ['id_categoria' => '4', 'nom_categoria' => 'Maquinari i Perifèrics'],
            ['id_categoria' => '5', 'nom_categoria' => 'Bases de Dades'],
            ['id_categoria' => '6', 'nom_categoria' => 'Programació Bàsica'],
            ['id_categoria' => '7', 'nom_categoria' => 'Disseny Web'],
            ['id_categoria' => '8', 'nom_categoria' => 'Entorns de Desenvolupament'],
            ['id_categoria' => '9', 'nom_categoria' => 'Virtualització i Sistemes Cloud'],
            ['id_categoria' => '10', 'nom_categoria' => 'Atenció a l’Usuari'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['id_categoria' => $category['id_categoria']],
                ['id_categoria' => $category['id_categoria'], 'nom_categoria' => $category['nom_categoria']]
            );
        }


        //Inserta usuaris
        foreach ($data['users'] as $user) {
            // $id_categoria = DB::table('table_categories')->where('nom_categoria', $user['nom_categoria'])->value('id_categoria');
            DB::table('usuaris')->updateOrInsert(['id' => $user['id']], [
                'nom' => $user['nom'],
                'cognom1' => $user['cognom1'],
                'cognom2' => $user['cognom2'],
                'email' => $user['email'],
                'password' => $user['password'],
                'rol' => $user['rol'],
                'data_naixement' => $user['data_naixement'],
                'telefon' => $user['telefon'],
                'foto_profile' => $user['foto_profile'],
                'biografia' => $user['biografia'],
                'major' => $user['major'],
            ]);
        }

        $this->info('Usuaris afegits correctament.');
    }
}
