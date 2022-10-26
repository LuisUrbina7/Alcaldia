<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
             $table->string('titulo',100);
            $table->string('sinopsis');             
            $table->longText('detalles');             
            $table->string('img',100);             
            $table->date('fecha');             
            $table->foreignId('categoria')->constrained('categorias')->cascadeOnUpdate()->cascadeOnDelete();             
            $table->foreignId('idUsuario')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();    
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
        Schema::dropIfExists('publicaciones');
    }
}
