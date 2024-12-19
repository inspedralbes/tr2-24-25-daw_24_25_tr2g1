# AlumNet - Plataforma d'Aprenentatge i Connexió

AlumNet és una plataforma dissenyada per ajudar als estudiants i mentors a organitzar el seu aprenentatge i connectar-se amb companys per a classes particulars. Aquesta aplicació inclou funcionalitats d'autenticació, gestió de comptes, publicació d'ofertes i accés a fòrums de discussió.

## Arquitectura Bàsica

L'aplicació està desenvolupada amb una arquitectura **MVC** (Model-View-Controller) que separa clarament les responsabilitats en la gestió de dades, la lògica de negoci i la presentació d'informació. El projecte està basat en el **framework Laravel** per al back-end i **Vue.js** per al front-end, amb una arquitectura orientada a components.

### Components Principals:
- **Back-end**: Laravel (PHP) - API RESTful per a la gestió d'usuaris, autenticació, i manipulació de dades.
- **Front-end**: Vue.js (JavaScript) - UI interactiva amb components reutilitzables.
- **Base de dades**: MySQL o MariaDB per emmagatzemar informació dels usuaris, ofertes, missatges i més.

## Tecnologies Utilitzades

### **Back-end:**
- **Laravel**: Framework PHP per al desenvolupament ràpid d'aplicacions web.
- **MySQL/MariaDB**: Sistema de gestió de base de dades relacional per emmagatzemar informació.
- **JWT (JSON Web Token)**: Mètode per a la gestió de sessions segures i autenticació d'usuaris.
- **Bcrypt**: Algoritme per encriptar les contrasenyes d'usuaris.
- **Composer**: Gestor de dependències de PHP.

### **Front-end:**
- **Vue.js**: Framework JavaScript per crear interfícies d'usuari interactives i reactivas.
- **Vue Router**: Per gestionar les rutes i la navegació de l'aplicació.
- **Vite**: Build tool per a desenvolupament frontend ràpid.
- **Tailwind CSS**: Framework CSS per a disseny ràpid i personalitzable.

### **Altres Plugins:**
- **Vuex**: Per a la gestió de l'estat de l'aplicació a través de la reactivitat de Vue.
- **FontAwesome**: Per a la gestió d'icones al disseny de la UI.

## Configuració i Inici del Projecte

**Instal·lació de Dependències**:
   * Accedeix al directori `Back` i executa `composer install` per instal·lar totes les dependències necessàries per a Laravel.

**Configuració de l'Arxiu `.env`**:
   * Crea una còpia de l'arxiu `.env.example` i anomena'l `.env`.
   * Dins del `.env`, defineix les configuracions de la base de dades descomentant i ajustant les següents línies:
     ```env
     DB_HOST=el_teu_host
     DB_PORT=el_teu_port
     DB_DATABASE=el_nom_de_la_teva_base_de_dades
     DB_USERNAME=el_teu_usuari
     DB_PASSWORD=la_teva_contrassenya
     ```
   * Substitueix `el_teu_host`, `el_teu_port`, `el_nom_de_la_teva_base_de_dades`, `el_teu_usuari` i `la_teva_contrassenya` pels valors corresponents del teu entorn.

**Iniciar el Servei del Servidor de Base de Dades**:
   * Assegura't que el servei de la base de dades (per exemple, MySQL o MariaDB) estigui en funcionament i crea la base de dades especificada al fitxer `.env`.

**Migracions, Generació de Clau i Inserció de Dades**:
   * Per configurar les taules a la base de dades, genera la clau de l'aplicació i insereix dades de mostra:
     * `php artisan key:generate`: Genera una clau única per a l'aplicació en l'arxiu `.env`, necessària per a la seguretat.
     * `php artisan migrate:rollback`: Esborrarà totes les taules existents si n'hi ha, preparant la base de dades per començar de nou.
     * `php artisan migrate:reset`: Alternativa a `rollback` que elimina les migracions aplicades i deixa la base de dades com si fos nova.
     * `php artisan migrate`: Crea les taules a la base de dades segons les migracions definides.
     
**Neteja de Caché**:
   * Per evitar problemes de configuració i garantir que es carreguin els últims canvis, neteja el caché amb aquests camandes:
     * `php artisan config:clear`: Neteja la caché de la configuració.
     * `php artisan view:clear`: Neteja la caché de les vistes de Blade.
     * `php artisan cache:clear`: Neteja la caché general de l'aplicació.
       
**Iniciar el Servidor de Laravel**:
   * Per executar l'aplicació i accedir a ella des del teu navegador, inicia el servidor de desenvolupament de Laravel amb:
     ```bash
     php artisan serve
     ```
   * Per producció, pot ser més adient configurar un servidor web com Nginx o Apache.

