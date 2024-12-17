

# Comandos útiles de Laravel Artisan

## Bases de Datos y Migraciones
- `php artisan migrate:fresh`: Recrear todas las tablas de la base de datos
- `php artisan make:model Nombre --migrations`: Crear nuevo modelo con migración
- `php artisan make:seeder Nombre`: Crear un nuevo seeder

## Seeders
- `php artisan make:seeder UsuarisTableSeeder`: Crear seeder específico
- `php artisan db:seed`: Ejecutar todos los seeders
- `php artisan db:seed --class=NombreDeLaClase`: Ejecutar un seeder específico

## Generación de Claves
- `php artisan key:generate`: Generar clave de aplicación

## Importación y Datos
- `php artisan import:users`: Importar usuarios

## Limpieza de Caché
- `php artisan cache:clear`: Limpiar caché
- `php artisan route:clear`: Limpiar rutas
- `php artisan config:clear`: Limpiar configuración
- `php artisan view:clear`: Limpiar vistas

Este formato es más legible, organizado por categorías y con descripciones breves de cada comando.