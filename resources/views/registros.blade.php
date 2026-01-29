<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h3 mb-0">Registros</h1>
      <a href="{{ route('contacto.form') }}" class="btn btn-outline-secondary btn-sm">Volver</a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        @if(empty($registros))
          <div class="alert alert-warning mb-0">No hay registros aún.</div>
        @else
          <div class="table-responsive">
            <table class="table table-striped align-middle">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Mensaje</th>
                </tr>
              </thead>
              <tbody>
                @foreach($registros as $r)
                  <tr>
                    <td style="white-space:nowrap;">{{ $r['fecha'] ?? '-' }}</td>
                    <td>{{ $r['nombre'] ?? '-' }}</td>
                    <td>{{ $r['email'] ?? '-' }}</td>
                    <td style="min-width: 320px;">{{ $r['mensaje'] ?? '-' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
</body>
</html>
