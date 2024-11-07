<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

public function up()
{
    Schema::table('gastos', function (Blueprint $table) {
        $table->string('categoria')->after('descripcion'); // Añade la columna 'categoria'
    });
}

public function down()
{
    Schema::table('gastos', function (Blueprint $table) {
        $table->dropColumn('categoria'); // Elimina la columna en caso de rollback
    });
}

