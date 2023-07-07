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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title')->unique();
            $table->longText('content');
            $table->string('excerpt')->nullable();
            $table->string('slug');
            $table->unsignedInteger('word_count')->default(0)->nullable();
            $table->unsignedTinyInteger('minutes')->default(0)->nullable();
            $table->timestamps();
            $table->dateTime('published_at')->nullable();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
