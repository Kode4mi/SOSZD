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
        Schema::create('tickets_files', static function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('tickets_id');
            $table->foreign('tickets_id')->references('id')->on('tickets');  // tworzenie klucza obcego do tabeli 'tickets'
            
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
        Schema::table('tickets_files',function (Blueprint $table){
            $table->dropForeign(['tickets_id']);
        });
        Schema::dropIfExists('tickets_files');
    }
};
