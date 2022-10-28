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
            $table->foreign('tickets_id')->references('id')->on('tickets');  // tworzenie klucza obcego do tabeli 'tickets'
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');       // tworzenie klucza obcego do tabeli 'users'
            
            $table->text('reply_content');
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
        // Schema::table('replies',function (Blueprint $table){
        //     $table->dropForeign(['tickets_id']);
        //     $table->dropForeign(['users_id']);
        // });
        
        Schema::dropIfExists('replies');
    }
};
