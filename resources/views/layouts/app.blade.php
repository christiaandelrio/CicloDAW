<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Control de Gastos')</title>

    <!-- Script Estilos Bootstrap-->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Incluye Chart.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">

    <!-- CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- JS de jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JS de DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Tu archivo JavaScript -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/primerospasos.js') }}"></script>
    <script src="{{ asset('js/options-menu.js') }}"></script>
    <script src="{{ asset('js/scroll.js') }}"></script>
    <script src="{{ asset('js/graficas.js') }}"></script>
    <script src="{{ asset('js/popup.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilosmoviles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/compartidos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/darkmode.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/configuracion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/generargraficas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/escanearRecibo.css') }}">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Muli:wght@300;400;600&family=Habibi&display=swap" rel="stylesheet">

</head>

<body class="@yield('body-class') {{ $darkMode ? 'dark' : '' }}">
    <!-- <div class="logo-container">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/Logo_Proyecto.png') }}" alt="Logo" class="logo">
        </a>
   </div> -->
    <!-- Popup de alerta -->
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


</body>

</html>