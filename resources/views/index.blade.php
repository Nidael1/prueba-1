<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contacto - Efectivale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Formulario de Contacto</h4>
                    </div>
                    <div class="card-body">
                        <form id="formContacto" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mensaje</label>
                                <textarea id="mensaje" name="mensaje" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100" id="btnEnviar">Enviar</button>
                        </form>
                        <div id="respuesta" class="mt-3 d-none alert"></div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('contacto.registros') }}">Ver mensajes almacenados (registros.html)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('formContacto');
        const btn = document.getElementById('btnEnviar');
        const respuesta = document.getElementById('respuesta');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Validación JavaScript (Requisito 2)
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            btn.disabled = true;
            btn.innerText = 'Enviando...';

            // Envío Asíncrono AJAX (Requisito 3)
            try {
                const formData = new FormData(form);
                const res = await fetch("{{ route('contacto.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await res.json();
                if (!res.ok) throw data;
                
                respuesta.classList.remove('d-none', 'alert-danger');
                respuesta.classList.add('alert-success');
                respuesta.innerText = data.message;
                form.reset();
                form.classList.remove('was-validated');

            } catch (error) {
                respuesta.classList.remove('d-none', 'alert-success');
                respuesta.classList.add('alert-danger');
                respuesta.innerText = 'Error al enviar el mensaje.';
            } finally {
                btn.disabled = false;
                btn.innerText = 'Enviar';
            }
        });
    </script>
</body>
</html>