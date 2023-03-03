<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("cedula");
            $table->string("telefono");
            $table->string("direccion");
            $table->string("correo");
            $table->string("imagenComprobante");
            $table->string("imagen");
            $table->string("precio");
            $table->string("categoria");
            $table->string("talla")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
};
