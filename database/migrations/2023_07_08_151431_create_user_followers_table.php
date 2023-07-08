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
        Schema::create('user_followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users', 'id'); // user who is following
            $table->foreignId('followed_id')->constrained('users', 'id'); // user being followed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_followers');
    }
};
