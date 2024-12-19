const mix = require('laravel-mix');

// Para CSS
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

// Para JavaScript (Si tienes archivo JS)
mix.js('resources/js/app.js', 'public/js')
    .version();  // Para evitar problemas de cache
