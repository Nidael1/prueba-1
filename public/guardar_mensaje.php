<?php
/**
 * guardar_mensaje.php
 * Endpoint para guardar mensajes enviados desde index.html
 * Guarda en: public/mensajes.json
 */

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>guardar_mensaje.php</title>
        <style>
            body { font-family: Arial, sans-serif; background:#f4f4f4; padding:40px; }
            .box { background:#fff; padding:20px; max-width:650px; margin:auto; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,.1); }
            code { background:#eee; padding:2px 6px; border-radius:4px; }
        </style>
    </head>
    <body>
        <div class="box">
            <h2>guardar_mensaje.php</h2>
            <p>Este archivo es un <b>endpoint de guardado</b>.</p>
            <p>Debe ser llamado mediante <code>POST</code> desde <code>index.html</code> usando AJAX.</p>
            <p>No se debe acceder directamente desde el navegador.</p>
        </div>
    </body>
    </html>
    <?php
    exit;
}

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$nombre  = trim($_POST['nombre']  ?? '');
$email   = trim($_POST['email']   ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

if ($nombre === '' || $email === '' || $mensaje === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.'], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email no válido.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$nuevo = [
    'fecha'   => date('Y-m-d H:i:s'),
    'nombre'  => $nombre,
    'email'   => $email,
    'mensaje' => $mensaje,
];

$archivo = __DIR__ . '/mensajes.json';
$mensajes = [];

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $mensajes = json_decode($contenido, true);
    if (!is_array($mensajes)) {
        $mensajes = [];
    }
}

$mensajes[] = $nuevo;

file_put_contents(
    $archivo,
    json_encode($mensajes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo json_encode(['success' => true, 'message' => 'Mensaje guardado correctamente.'], JSON_UNESCAPED_UNICODE);
