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
        Schema::table('types', function (Blueprint $table): void {
            $table->enum('contains_animal_products', ['YES', 'NO', 'SOMETIMES'])->default('YES');
            $table->enum('contains_gluten', ['YES', 'NO', 'SOMETIMES'])->default('NO');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('types', function (Blueprint $table): void {
            $table->dropColumn(['contains_animal_products', 'contains_gluten']);
        });
    }
};
