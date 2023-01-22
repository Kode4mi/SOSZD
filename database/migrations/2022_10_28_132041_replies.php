<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('replies', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('redirect_id');
            $table->foreign('redirect_id')->references('id')->on('redirects')->onDelete('cascade')->onUpdate('cascade');       // tworzenie klucza obcego do tabeli 'users'
            $table->text('message');
            $table->string('files')->nullable();
            $table->timestamps();
            $table->string('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
