<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedTinyInteger('age')->nullable()->after('customer_phone');
            $table->string('gender', 32)->nullable()->after('age');
            $table->string('nationality', 128)->nullable()->after('gender');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['age', 'gender', 'nationality']);
        });
    }
};
