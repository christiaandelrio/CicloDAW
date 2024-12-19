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
        Schema::create('gastos_compartidos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('gasto_id')->index('gasto_id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->unsignedBigInteger('shared_with')->nullable();
            $table->decimal('porcentaje', 5)->nullable()->default(100);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_compartidos');
    }
};
