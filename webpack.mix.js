const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/datatable.js', 'public/js')
   .js('resources/js/modal.js', 'public/js')
   .js('resources/js/primerospasos.js', 'public/js')
   .js('resources/js/options-menu.js', 'public/js')
   .js('resources/js/scroll.js', 'public/js')
   .js('resources/js/graficas.js', 'public/js')
   .js('resources/js/popup.js', 'public/js')
   .version();
