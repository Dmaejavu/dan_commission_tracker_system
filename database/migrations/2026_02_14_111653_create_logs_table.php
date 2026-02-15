<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->integer('logID')->primary()->autoIncrement();
            $table->integer('userID');
            $table->string('action'); // 'created_user', 'deleted_user', 'approved_commission', etc.
            $table->string('model')->nullable(); // 'User', 'Commission', 'Agent'
            $table->integer('model_id')->nullable(); // ID of affected record
            $table->text('description')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->timestamps();
            
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};