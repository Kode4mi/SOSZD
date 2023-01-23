<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tickets', static function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('deadline');
            $table->integer('priority');
            $table->unsignedbigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('files')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->string('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
