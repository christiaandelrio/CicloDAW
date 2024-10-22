<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            padding-bottom: 60px; /* Espacio para la barra de navegación */
        }

        .navbar {
            position: fixed;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #000;
            color: #fff;
            padding: 10px 0;
            z-index: 1000;
        }

        .menu-icon {
            cursor: pointer;
            font-size: 24px;
            color: #fff;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .menu-icon:hover {
            color: #ccc;
            transform: scale(1.1);
        }

        .search-menu {
            display: none;
            position: fixed;
            bottom: 60px; /* Ajustar para que aparezca justo encima de la barra de navegación */
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
<div class="navbar">
    <div class="menu-icon" id="home-icon"><i class="fas fa-home"></i></div>
    <div class="menu-icon" id="search-icon"><i class="fas fa-search"></i></div>
    <div class="menu-icon" id="user-icon"><i class="fas fa-user"></i></div>
</div>
<div class="search-menu" id="search-menu">
    <div class="categories">
        <ul>
            <li><a href="#">Categoría 1</a></li>
            <li><a href="#">Categoría 2</a></li>
            <li><a href="#">Categoría 3</a></li>
            <!-- Agrega más categorías aquí -->
        </ul>
    </div>
</div>
<script>
    document.getElementById("search-icon").addEventListener("click", function() {
        var searchMenu = document.getElementById("search-menu");
        if (searchMenu.style.display === "block") {
            searchMenu.style.display = "none";
        } else {
            searchMenu.style.display = "block";
        }
    });
</script>
</body>
</html>
