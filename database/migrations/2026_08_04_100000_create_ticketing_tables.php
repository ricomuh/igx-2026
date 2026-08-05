<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->unsignedInteger('capacity')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 32)->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 32)->nullable();
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->string('status', 24)->default('pending')->index();
            $table->string('payment_method', 24)->default('transfer');
            $table->timestamp('paid_at')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('ticket_name');
            $table->decimal('unit_price', 12, 2);
            $table->unsignedInteger('qty');
            $table->decimal('subtotal', 12, 2);
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('method', 24)->default('transfer');
            $table->string('reference_number', 64)->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('proof_path')->nullable();
            $table->string('status', 24)->default('pending');
            $table->timestamp('confirmed_at')->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('ticket_types');
    }
};
