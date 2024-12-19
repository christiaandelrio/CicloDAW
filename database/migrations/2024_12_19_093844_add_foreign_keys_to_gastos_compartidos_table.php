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
        Schema::table('gastos_compartidos', function (Blueprint $table) {
            $table->foreign(['gasto_id'], 'gastos_compartidos_ibfk_1')->references(['id'])->on('gastos')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'gastos_compartidos_ibfk_2')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gastos_compartidos', function (Blueprint $table) {
            $table->dropForeign('gastos_compartidos_ibfk_1');
            $table->dropForeign('gastos_compartidos_ibfk_2');
        });
    }
};
