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
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('token', 64)->unique();
            $table->boolean('is_demo')->default(false);
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index('expires_at');
            $table->index('used_at');
            $table->index(['token', 'used_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_sessions');
    }
};
