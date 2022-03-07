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
        Schema::create('ingredient_shopping_list', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('ingredient_id');
            $table->foreignId('shopping_list_id');
            $table->foreignId('unit_id');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_shopping_list');
    }
};
