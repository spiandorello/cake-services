<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: 'cakes', callback: function (Blueprint $table) {
            $table->uuid(column: 'id')->primary();
            $table->string(column: 'name')->nullable(value: false);
            $table->text(column: 'description')->default(value: null);
            $table->float(column: 'weight')->nullable(value: false);
            $table->float(column: 'price')->nullable(value: false);
            $table->integer(column: 'available_quantity')->nullable(value: false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cakes');
    }
};
