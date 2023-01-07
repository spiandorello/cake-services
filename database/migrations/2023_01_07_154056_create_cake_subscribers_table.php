<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cake_subscribers', function (Blueprint $table) {
            $table->uuid(column: 'id')->primary();
            $table->foreignUuid(column: 'user_id')->constrained();
            $table->foreignUuid(column: 'cake_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cake_subscribers');
    }
};
