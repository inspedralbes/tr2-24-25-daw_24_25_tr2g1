# Comandos útils de Laravel Artisan

## Bases de Dades i Migracions
- `php artisan migrate:fresh`: Recrear totes les taules de la base de dades
- `php artisan make:model Nom --migrations`: Crear nou model amb migració
- `php artisan make:seeder Nom`: Crear un nou seeder

## Seeders
- `php artisan make:seeder UsuarisTableSeeder`: Crear seeder específic
- `php artisan db:seed`: Executar tots els seeders
- `php artisan db:seed --class=NomDeLaClasse`: Executar un seeder específic

## Generació de Claus
- `php artisan key:generate`: Generar clau d'aplicació

## Importació i Dades
- `php artisan import:users`: Importar usuaris

## Neteja de Caché
- `php artisan cache:clear`: Netejar caché
- `php artisan route:clear`: Netejar rutes
- `php artisan config:clear`: Netejar configuració
- `php artisan view:clear`: Netejar vistes

