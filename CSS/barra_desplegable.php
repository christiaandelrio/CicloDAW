<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #000;
        color: #fff;
        padding: 10px 20px;
    }

    .logo {
        font-size: 24px;
    }

    .search-icon {
        cursor: pointer;
        font-size: 24px;
        color: #fff;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .search-icon:hover {
        color: #ccc;
        transform: scale(1.1);
    }

    .search-menu {
        display: none;
        position: absolute;
        top: 60px;
        left: 0;
        width: 100%;
        background-color: #fff;
        box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
        z-index: 1000;
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


<div class="navbar">
    <div class="logo">App de Control de Gastos</div>
    <div class="search-icon" id="search-icon">&#128269;</div>
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