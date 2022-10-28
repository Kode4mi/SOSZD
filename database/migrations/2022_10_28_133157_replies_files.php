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
            $table->foreign('replies_id')->references('id')->on('replies')->onDelete('cascade')->onUpdate('cascade');;  // tworzenie klucza obcego do tabeli 'replies'
            $table->string('file_name');
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
        Schema::dropIfExists('replies_files');
    }
};
