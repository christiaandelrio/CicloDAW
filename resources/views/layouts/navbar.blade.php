<nav class="navbar-bottom">
    @auth
        <!-- Icono para el home -->
        <div class="menu-icon" id="home-icon">
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-simple"></i></i></a>
        </div>

        <!-- Icono para búsqueda con menú desplegable -->
        <div class="menu-icon" id="search-icon">
        <i class="fa-solid fa-plus"></i>
        </div>

        <!-- Icono para el usuario -->
        <div class="menu-icon" id="user-icon">
                <i class="fas fa-user"></i>
        </div>

        <!-- Menú de búsqueda -->
        <div class="search-menu" id="search-menu">
            <div class="categories">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Mis Gastos</a></li>
                    <li><a href="{{ route('gastos.create') }}">Crear</a></li>
                    <!-- Opción de gráfica -->
                    <li><a href="{{ route('gastos.generargrafica') }}"><i class="fas fa-chart-bar"></i> Generar Gráfica</a></li>
                </ul>
            </div>
        </div>


        <!-- Menú de usuario -->
        <div class="search-menu" id="user-menu">
            <div class="categories">
                <ul>
                    <li><a href="{{ route('perfil') }}">Mi perfil</a></li>
                    
                    <!-- Enlace de cerrar sesión -->
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <li><a href="#">Configuración</a></li>
                </ul>
            </div>
        </div>

    @endauth

    @guest

        <!-- Opciones de usuario no autenticado -->
        <div class="menu-icon" id="login-icon">
            <a href="{{ route('login') }}"><i class="fas fa-user"></i> </a>
        </div>
        
        <div class="menu-icon" id="register-icon">
            <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i></a>
        </div>

    @endguest
    </div>

</nav>

<script>

    let searchMenu = document.getElementById("search-menu");
    let userMenu = document.getElementById("user-menu");

    document.getElementById("search-icon").addEventListener("click", function() {
        // Alternar la visibilidad de searchMenu
        if (searchMenu.style.display === "block") {
            searchMenu.style.display = "none"; // Oculta searchMenu si está visible
        } else {
            searchMenu.style.display = "block"; // Muestra searchMenu si está oculto
            userMenu.style.display = "none";    // Oculta userMenu si searchMenu se muestra
        }
    });

    document.getElementById("user-icon").addEventListener("click", function() {
        // Alternar la visibilidad de userMenu
        if (userMenu.style.display === "block") {
            userMenu.style.display = "none"; // Oculta userMenu si está visible
        } else {
            userMenu.style.display = "block"; // Muestra userMenu si está oculto
            searchMenu.style.display = "none"; // Oculta searchMenu si userMenu se muestra
        }
    });

</script>


