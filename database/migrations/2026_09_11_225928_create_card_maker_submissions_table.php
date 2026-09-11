<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('card_maker_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 160)->nullable();
            $table->string('card_image_path'); // storage/app/public/cards/xxx.png
            $table->ipAddress('ip_address');
            $table->string('user_agent', 500)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('ip_address');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('card_maker_submissions');
    }
};
