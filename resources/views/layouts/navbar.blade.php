<!-- Barra de navegación superior solo para usuarios no autenticados -->
@guest
<nav class="navbar-top">
    <div class="logo-container">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>
    <div class="menu">
        <div class="menu-item">
            <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
        </div>
        <div class="menu-item">
            <a href="{{ route('register') }}" class="nav-link register-button">Registrarse</a>
        </div>
    </div>
</nav>
@endguest

<!-- Barra de navegación inferior solo para usuarios autenticados -->
@auth
<nav class="navbar-bottom">
    <div class="menu-icons">
        <!-- Icono de Home -->
        <div class="menu-icon" title="Inicio">
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-simple"></i></a>
        </div>

        <!-- Icono para crear un gasto -->
        <div class="menu-icon" id="search-icon" title="Menú de navegación">
            <i class="fa-solid fa-plus"></i>
        </div>

        <div class="menu-icon" id="user-icon" title="Mi perfil" style="position: relative;">
            <i class="fas fa-user"></i>

            <!-- Indicador de notificaciones -->
            @if($invitacionesCount > 0) <!-- Cambiar $invitacionesPendientes a $invitacionesCount -->
            <span class="notificacion-badge">{{ $invitacionesCount }}</span>
            @endif
        </div>

    </div>

    <!-- Menú desplegable para Crear y opciones adicionales -->
    <div class="search-menu" id="search-menu">
        <ul>
            <li><a href="{{ route('gastos.create') }}">Crear</a></li>
            <li><a href="{{ route('gastos.generargrafica') }}">Generar Gráfica</a></li>
            <li><a href="{{ route('gastos.escanearRecibo') }}">Escanear Ticket</a></li>
            <li><a href="{{ route('gastos.compartidos') }}">Gastos Compartidos</a></li>
        </ul>
    </div>

    <!-- Menú de usuario -->
    <div class="user-menu" id="user-menu">
        <ul>
            <li><a href="{{ route('perfil') }}">Mi perfil</a></li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <li><a href="{{ route('perfil.configuracion') }}">Configuración</a></li>
        </ul>
    </div>
</nav>
@endauth


<script>
    let searchMenu = document.getElementById("search-menu");
    let userMenu = document.getElementById("user-menu");

    document.getElementById("search-icon").addEventListener("click", function() {
        if (searchMenu.style.display === "block") {
            searchMenu.style.display = "none";
        } else {
            searchMenu.style.display = "block";
            userMenu.style.display = "none";
        }
    });

    document.getElementById("user-icon").addEventListener("click", function() {
        if (userMenu.style.display === "block") {
            userMenu.style.display = "none";
        } else {
            userMenu.style.display = "block";
            searchMenu.style.display = "none";
        }
    });
</script>



<style>
    .notificacion-badge {
        position: absolute;
        top: -5px;
        right: -10px;
        background-color: #FF5722;
        /* Color del badge */
        color: white;
        font-size: 0.8rem;
        font-weight: bold;
        border-radius: 50%;
        padding: 5px 8px;
        min-width: 20px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
</style>