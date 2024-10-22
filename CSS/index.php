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
            color: #BFBFB8; /* Color de texto general */
            padding-bottom: 60px; /* Espacio para la barra de navegación */
        }
        header {
            text-align: center;
            padding: 20px;
        }
        /* Navbar Styles */
        #navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #35403A;
            padding: 15px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-nav {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .nav-item {
            margin-left: 20px;
        }
        .nav-link {
            color: #A4A69C;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav-link:hover {
            background-color: #4C594F; /* Color de hover */
        }
        /* Card Container and Card Styles */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .card {
            display: flex;
            flex-direction: column;
            background-color: #4C594F; /* Color de fondo de las tarjetas */
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
            color: #BFBFB8; /* Color del texto de la descripción */
        }
        .description h2 {
            margin: 0 0 10px 0;
        }
        .description p {
            margin: 0;
        }
        /* Responsiveness */
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
        /* Bottom Navigation Bar */
        nav.navbar-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #35403A;
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
            background-color: #A4A69C; /* Color de fondo del icono */
            color: #232625; /* Color del icono */
            font-size: 24px;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .menu-icon:hover {
            background-color: #BFBFB8; /* Color de hover del icono */
            color: #232625; /* Color del icono al hacer hover */
            transform: scale(1.1);
        }
        /* Search Menu Styles */
        .search-menu {
            display: none;
            position: fixed;
            bottom: 70px;
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0px -2px 5px rgba(0,0,0,0.2);
            z-index: 999;
        }
        .search-menu .categories {
            padding: 20px;
        }
        .search-menu .categories ul {
            list-style: none;
            padding: 0;
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
            color: #000;
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
            <li><a href="#">Mis gastos</a></li>
            <li><a href="#">Crear</a></li>
            <li><a href="#">Eliminar</a></li>
            <!-- Agrega más categorías aquí -->
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