<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id_message');
            $table->text('messageText');
            $table->unsignedBigInteger('id_sender');
            $table->unsignedBigInteger('id_receiver');
            $table->foreign('id_sender')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_receiver')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
