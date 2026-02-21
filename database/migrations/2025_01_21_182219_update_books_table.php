<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable()->after('year'); // Додаємо поле ціни
            $table->dropColumn('average_rating'); // Видаляємо поле рейтингу
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('price'); // Видаляємо поле ціни при відкаті
            $table->decimal('average_rating', 3, 2)->nullable(); // Повертаємо рейтинг
        });
    }
};
