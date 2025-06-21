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
        Schema::create('tags_trip_expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnDelete();

            $table->unsignedBigInteger('trip_expense_id');
            $table->foreign('trip_expense_id')->references('id')->on('trip_expenses')->cascadeOnDelete();

            $table->unique(['tag_id', 'trip_expense_id'], 'tag_trip_expense_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags_trip_expenses');
    }
};
