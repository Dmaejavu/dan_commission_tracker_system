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
            $table->integer('userID')->primary()->autoIncrement(); 
            $table->string('username', 16);
            $table->string('password', 60);
            $table->enum('position', ['Admin', 'Owner', 'UnitManager']);
        });

        // Agent table
        Schema::create('agents', function (Blueprint $table) {
            $table->integer('agentID')->primary()->autoIncrement();
            $table->string('agentname', 50);
            $table->float('comrate');
            $table->string('area', 50);
            $table->timestamps(); // Adds `created_at` and `updated_at` columns
        });

        // Commission table
        Schema::create('commissions', function (Blueprint $table) {
            $table->integer('comID')->primary()->autoIncrement();
            $table->integer('userID');
            $table->integer('agentID');
            $table->float('totalcom');
            $table->string('clientname', 50);
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Canceled']);
            $table->timestamps(); // Adds `created_at` and `updated_at` columns

            // Foreign keys
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->foreign('agentID')->references('agentID')->on('agents')->onDelete('cascade');
        });

        // Card table
        Schema::create('cards', function (Blueprint $table) {
            $table->integer('cardID')->primary(); 
            $table->enum('banktype', ['BDO', 'BPI', 'CBC']);
            $table->enum('cardtype', ['Silver', 'Gold', 'Platinum']);
            $table->float('prices')->nullable()->after('cardtype');
        });

        // Add cardID to commissions table
        Schema::table('commissions', function (Blueprint $table) {
            $table->integer('cardID')->nullable()->after('status'); // Use integer instead of unsignedBigInteger
            $table->foreign('cardID')->references('cardID')->on('cards')->onDelete('cascade'); // Set as foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commissions', function (Blueprint $table) {
            if (Schema::hasColumn('commissions', 'cardID')) {
                $table->dropForeign(['cardID']); // Drop foreign key
                $table->dropColumn('cardID'); // Drop column
            }
        });
        
        Schema::dropIfExists('cards');
        Schema::dropIfExists('commissions');
        Schema::dropIfExists('agents');
        Schema::dropIfExists('users');
    }
};
