<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Control de Gastos')</title>

    <!-- CSS Compilado -->
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">

    <!-- Script Estilos Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">

    <!-- CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- JS de jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JS de DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Muli:wght@300;400;600&family=Habibi&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="@yield('body-class') {{ $darkMode ? 'dark' : '' }}">
    @if(session('mensaje_popup'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            mostrarPopup("{{ session('mensaje_popup') }}");
        });
    </script>
    @endif

    <div id="popup-alerta" class="popup-alerta">
        <p id="mensaje-popup"></p>
    </div>

    <!-- Inclusión de la plantilla de la barra de navegación-->
    @include('layouts.navbar')

    <!-- Aquí va el contenido de la propia página -->
    <div class="contenedor-principal">
        @yield('content')
    </div>

    <!-- Archivos JavaScript compilados -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/datatable.js') }}"></script>
    <script src="{{ mix('js/modal.js') }}"></script>
    <script src="{{ mix('js/primerospasos.js') }}"></script>
    <script src="{{ mix('js/options-menu.js') }}"></script>
    <script src="{{ mix('js/scroll.js') }}"></script>
    <script src="{{ mix('js/graficas.js') }}"></script>
    <script src="{{ mix('js/popup.js') }}"></script>
</body>
</html>
