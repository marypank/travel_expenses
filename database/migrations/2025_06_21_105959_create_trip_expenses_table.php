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
        Schema::create('trip_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id');
            $table->foreign('trip_id')->references('id')->on('trips')->cascadeOnDelete();
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->unsignedTinyInteger('source')->default(0); // cash, card or smth else
            $table->unsignedMediumInteger('currency_id'); // api
            $table->decimal('currency_exchange_rate', 8, 2);
            $table->date('pay_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_expenses');
    }
};
