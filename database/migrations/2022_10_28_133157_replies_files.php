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
        Schema::create('replies_files', static function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('replies_id');
            $table->foreign('replies_id')->references('id')->on('replies');  // tworzenie klucza obcego do tabeli 'replies'
            
            $table->string('file_name');
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
        // Schema::table('replies_files',function (Blueprint $table){
        //     $table->dropForeign(['replies_id']);
        // });
        
        Schema::dropIfExists('replies_files');
    }
};
