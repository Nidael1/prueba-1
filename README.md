Prueba Técnica – Ejercicio 1

Tecnologías utilizadas
- PHP 8.x
- Laravel 12
- HTML5
- Bootstrap 5
- JavaScript (AJAX / Fetch API)
- JSON

---

Estructura relevante del proyecto

/routes/web.php
/app/Http/Controllers/MensajeController.php
/public/index.html
/public/guardar_mensaje.php
/public/registros.html
/public/mensajes.json


Descripción funcional

->1. `index.html`
- Formulario de contacto con campos:
  - Nombre
  - Email
  - Mensaje
- Estilizado con Bootstrap.
- Validación en frontend usando JavaScript.
- Envío asíncrono (AJAX) hacia `guardar_mensaje.php` sin recargar la página.

-> 2. `guardar_mensaje.php`
- Endpoint PHP real, accesible directamente.
- Recibe datos vía **POST**.
- Valida campos obligatorios y formato de email.
- Guarda los mensajes en `mensajes.json`.
- Responde en formato JSON.
- Si se accede por GET, muestra una página informativa del endpoint.

-> 3. `registros.html`
- Página que muestra los mensajes almacenados.
- Consume los datos desde `GET /registros.json`.
- Muestra los registros en una tabla HTML con Bootstrap.

-> 4. Laravel
- Se utiliza Laravel como framework base del proyecto.
- Expone el endpoint `/registros.json` mediante un Controller.
- Permite levantar el proyecto fácilmente con el servidor embebido.

---
 Cómo ejecutar el proyecto

Clonar el repositorio

```bash
git clone https://github.com/Nidael1/prueba-1.git
cd prueba-1
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
http://localhost:8000



Formulario de contacto
    http://localhost:8000/index.html

Página de registros
    http://localhost:8000/registros.html

Endpoint de guardado (POST)
    http://localhost:8000/guardar_mensaje.php

Endpoint de lectura JSON
    http://localhost:8000/registros.json


nota:en caso de error asegúrese de que la carpeta /public tenga permisos de escritura para la generación del archivo JSON