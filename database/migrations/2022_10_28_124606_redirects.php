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
        Schema::create('redirects', static function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('tickets_id');
            $table->foreign('tickets_id')->references('id')->on('tickets')->onDelete('cascade')->onUpdate('cascade');;  // tworzenie klucza obcego do tabeli 'tickets'
            $table->unsignedbigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');  // tworzenie klucza obcego do tabeli 'users'
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
        Schema::dropIfExists('redirects');
    }
};
