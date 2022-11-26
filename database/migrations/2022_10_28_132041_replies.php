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
        Schema::create('replies', static function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('tickets_id');
            $table->foreign('tickets_id')->references('id')->on('tickets')->onDelete('cascade')->onUpdate('cascade');  // tworzenie klucza obcego do tabeli 'tickets'
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');       // tworzenie klucza obcego do tabeli 'users'
            $table->text('message');
            $table->string('files')->nullable();
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
        Schema::dropIfExists('replies');
    }
};
