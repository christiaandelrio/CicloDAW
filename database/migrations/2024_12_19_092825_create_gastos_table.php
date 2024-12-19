<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre_gasto');
            $table->string('tipo');
            $table->decimal('valor', 10);
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->string('categoria')->nullable();
            $table->unsignedBigInteger('shared_with_user_id')->nullable()->index('shared_with_user_id');
            $table->boolean('es_compartido')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos');
    }
};
