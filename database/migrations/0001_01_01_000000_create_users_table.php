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
        // User table
        Schema::create('users', function (Blueprint $table) {
            $table->integer('userID', 6)->primary();
            $table->string('username', 16);
            $table->string('password', 50);
            $table->enum('position', ['Admin', 'Owner']);
        });

        // Agent table
        Schema::create('agents', function (Blueprint $table) {
            $table->integer('agentID', 6)->primary();
            $table->string('agentname', 50);
            $table->float('comrate');
            $table->string('area', 20);
        });

        // Commission table
        Schema::create('commissions', function (Blueprint $table) {
            $table->integer('comID', 6)->primary();
            $table->integer('userID', 6);
            $table->integer('agentID', 6);
            $table->float('totalcom');
            $table->string('clientname', 50);

            // Foreign keys
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->foreign('agentID')->references('agentID')->on('agents')->onDelete('cascade');
        });

        // Card table
        Schema::create('cards', function (Blueprint $table) {
            $table->integer('cardID', 6)->primary();
            $table->enum('banktype', ['BDO', 'BPI', 'CBC']);
            $table->enum('cardtype', ['Silver', 'Gold', 'Platinum']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
        Schema::dropIfExists('commissions');
        Schema::dropIfExists('agents');
        Schema::dropIfExists('users');
    }
};
