<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huchapp</title>
    <!-- Importar la tipografía Roboto desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Importar FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos generales para el footer */
        footer {
            background-color: #363535; //Cambio a gris más oscuro para que destaque la sombra de la línea <hr>
            color: #fff;
            font-size: 0.9em;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 100;
            font-family: 'Roboto', sans-serif; /* Aplicar la tipografía Roboto */
            box-sizing: border-box; /* Asegura que el padding no afecte el tamaño */
        }

        /* Encabezado del footer con información y redes sociales */
        .footer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap; /* Permitir que los elementos se ajusten */
        }

        .footer-header .brand-info {
            font-size: 1em;
        }

        .social-icons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap; /* Los iconos se ajustarán en pantallas más pequeñas */
            justify-content: flex-end;
            margin-top: 5px;
        }

        .social-icons a {
            color: #fff;
            font-size: 24px; /* Reducir el tamaño de los iconos */
            text-decoration: none;
        }

        .social-icons a .fa {
            display: block;
            height: 24px;
            line-height: 24px;
        }

        /* Línea divisoria */
        hr {
            border: 0;
            height: 2px;
            background-color: #fff; /* Cambiar el color de la línea */
            margin: 20px 0; /* Ajustar el margen */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); /* Añadir sombra */
        }

        /* Sección de enlaces */
        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            font-size: 0.9em;
        }

        .footer-content div {
            flex: 1;
            min-width: 150px;
            margin-bottom: 10px;
        }

        .footer-content h4 {
            font-size: 1em;
            margin-bottom: 10px;
        }

        .footer-content ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .footer-content ul li {
            margin: 5px 0;
        }

        .footer-content ul li a {
            color: #fff;
            text-decoration: none;
        }

        .footer-content ul li a:hover {
            text-decoration: underline;
        }

        /* Sección de copyright */
        .copyright {
            text-align: center;
            font-size: 0.8em;
            color: #999;
            margin-top: 10px;
        }
    </style>
</head>
<body style="margin: 0; padding-bottom: 100px; font-family: 'Roboto', sans-serif;"> <!-- Aplicar la tipografía Roboto a todo el cuerpo -->

    <!-- Contenido de la página -->

    <!-- Footer -->
    <footer>
        <!-- Encabezado del footer -->
        <div class="footer-header">
            <!-- Información de marca a la izquierda -->
            <div class="brand-info">
                <strong>Huchapp</strong> | ES | España | Español
            </div>

            <!-- Redes sociales a la derecha -->
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a> <!-- Icono de TikTok añadido -->
            </div>
        </div>

        <!-- Línea divisoria -->
        <hr>

        <!-- Contenido principal del footer -->
        <div class="footer-content">
            <!-- Enlaces legales y de políticas -->
            <div>
                <h4>Información Legal</h4>
                <ul>
                    <li><a href="#">Términos del sitio web</a></li>
                    <li><a href="#">Acuerdos legales</a></li>
                    <li><a href="#">Reclamaciones</a></li>
                    <li><a href="#">Política de denuncia de irregularidades</a></li>
                    <li><a href="#">Vulnerabilidad del cliente</a></li>
                </ul>
            </div>

            <!-- Ayuda -->
            <div>
                <h4>Ayuda</h4>
                <ul>
                    <li><a href="#">Centro de ayuda</a></li>
                    <li><a href="#">Habla con nosotros</a></li>
                    <li><a href="#">Estado del sistema</a></li>
                    <li><a href="#">API para desarrolladores</a></li>
                </ul>
            </div>

            <!-- Sostenibilidad -->
            <div>
                <h4>Sostenibilidad</h4>
                <ul>
                    <li><a href="#">Código de conducta</a></li>
                    <li><a href="#">Sostenibilidad</a></li>
                </ul>
            </div>
        </div>

        <!-- Sección de copyright -->
        <div class="copyright">
            © 2024 Huchapp. Todos los derechos reservados.
        </div>
    </footer>

</body>
</html>
