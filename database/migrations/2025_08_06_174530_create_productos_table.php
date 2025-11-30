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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            // crear FK
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->string('codigo',50)->unique();
            $table->string('nombre',50);
            $table->text('descripcion',500)->nullable();
            $table->integer('cantidad')->default(0);
            $table->float('precio_compra')->default(0);
            $table->float('precio_venta')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
