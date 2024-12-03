# Para crear de nuevo las tablas de la base de datos es

    php artisan migrate:fresh

# Para crear un nuevo model con la migration

    php artisan make:model Nombre --migrations

# Parar crear un nuevo controlador

    php artisan make:controller Nombre

# Para crear un Seeder es el comando 

    php artisan make:seeder Nombre

# Para ejecutar el seeder y lo hago

    php artisan db:seed --class=NombreDeLaClase

# Para ejecutar todos los seeder de golpe seria con el comando

    php artisan db:seed

# Para generar una clave de aplicación

    php artisan key:generate

# Para insertar datos en la base de datos
    php artisan import:users
