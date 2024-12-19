const mix = require('laravel-mix');

// Aquí estamos combinando varios archivos CSS en un solo archivo
mix.styles([
    'resources/css/app.css',
    'resources/css/footer.css',
    'resources/css/navbar.css',
    'resources/css/index.css',
    'resources/css/estilosmoviles.css',
    'resources/css/dashboard.css',
    'resources/css/register.css',
    'resources/css/compartidos.css',
    'resources/css/perfil.css',
    'resources/css/darkmode.css',
    'resources/css/modales.css',
    'resources/css/create.css',
    'resources/css/configuracion.css',
    'resources/css/generargraficas.css',
    'resources/css/editar.css',
    'resources/css/escanearRecibo.css'
], 'public/css/all.css');

// Configuración para el archivo JS (si es necesario)
mix.js('resources/js/app.js', 'public/js')
    .version();  // Para evitar problemas con el caché
