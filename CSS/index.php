<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Gastos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #232625;
            color: #BFBFB8;
            padding-bottom: 60px; /* Espacio para la barra de navegación */
        }
        header {
            text-align: center;
            padding: 20px;
        }

        /* Estilos de la tarjeta y contenedor */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .card {
            display: flex;
            flex-direction: column;
            background-color: #4C594F;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            overflow: hidden;
            width: 300px;
            transition: transform 0.2s ease;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .description {
            padding: 20px;
            text-align: center;
            color: #BFBFB8;
        }
        .description h2 {
            margin-bottom: 10px;
        }
        .description p {
            margin: 0;
        }

        /* Barra de navegación inferior */
        nav.navbar-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            z-index: 1000;
        }
        .menu-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #A4A69C;
            color: #232625;
            font-size: 24px;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .menu-icon:hover {
            background-color: #BFBFB8;
            transform: scale(1.1);
        }

        /* Estilos del menú de búsqueda */
        .search-menu {
            display: none;
            position: fixed;
            bottom: 70px;
            left: 5%;
            right: 5%;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px -2px 5px rgba(0,0,0,0.2);
            z-index: 999;
            opacity: 0.7;
        }
        .search-menu .categories {
            padding: 30px;
            text-align: center;
        }
        .search-menu .categories ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .search-menu .categories ul li {
            margin-bottom: 10px;
        }
        .search-menu .categories ul li a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            transition: color 0.3s ease;
        }
        .search-menu .categories ul li a:hover {
            color: #A6A4A5;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .navbar-nav {
                flex-direction: column;
                align-items: center;
            }
            .nav-item {
                margin-left: 0;
                margin-top: 10px;
            }
            .card-container {
                flex-direction: column;
                align-items: center;
            }
            .card {
                width: 90%;
            }
        }
        @media (max-width: 480px) {
            #navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .nav-item {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Control de Gastos</h1>
    </header>

    <main>
        <section class="card-container">
            <div class="card">
                <img src="https://via.placeholder.com/300" alt="Imagen 1">
                <div class="description">
                    <h2>Gráfica 1</h2>
                    <p>Descripción del contenido de la tarjeta 1.</p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/300" alt="Imagen 2">
                <div class="description">
                    <h2>Gráfica 2</h2>
                    <p>Descripción del contenido de la tarjeta 2.</p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/300" alt="Imagen 3">
                <div class="description">
                    <h2>Gráfica 3</h2>
                    <p>Descripción del contenido de la tarjeta 3.</p>
                </div>
            </div>
        </section>
    </main>

    <nav class="navbar-bottom">
        <div class="menu-icon" id="home-icon"><i class="fas fa-home"></i></div>
        <div class="menu-icon" id="search-icon"><i class="fas fa-search"></i></div>
        <div class="menu-icon" id="user-icon"><i class="fas fa-user"></i></div>
    </nav>
    <div class="search-menu" id="search-menu">
        <div class="categories">
            <ul>
                <li><a href="#">Mis Gastos</a></li>
                <li><a href="#">Crear</a></li>
                <li><a href="#">Eliminar</a></li>
            </ul>
        </div>
    </div>

    <script>
        document.getElementById("search-icon").addEventListener("click", function() {
            var searchMenu = document.getElementById("search-menu");
            searchMenu.style.display = searchMenu.style.display === "block" ? "none" : "block";
        });
    </script>
</body>
</html>
