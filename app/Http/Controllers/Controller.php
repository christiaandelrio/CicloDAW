<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controlador base de Laravel del cual heredan todos los demás
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
