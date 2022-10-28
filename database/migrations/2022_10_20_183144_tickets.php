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
        Schema::create('tickets', static function (Blueprint $table) {
            $table->id();
            $table->string('temat');
            $table->text('opis');
            $table->dateTime('termin');
            $table->integer('priorytet');

            $table->unsignedbigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users');  // tworzenie klucza obcego do tabeli 'users'

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
        // tu trzeba zobaczyć czy ma być to czy dropIfExists
        //
        // Schema::table('tickets',function (Blueprint $table){
        //     $table->dropForeign(['sender_id']);
        // });

        Schema::dropIfExists('tickets');
    }
};
