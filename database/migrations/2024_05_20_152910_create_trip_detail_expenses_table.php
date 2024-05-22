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
            $table->unsignedBigInteger('trip_detail_id');
            $table->foreign('trip_detail_id')->references('id')->on('trip_details')->cascadeOnDelete();

            $table->unsignedMediumInteger('currency_id'); // api
            $table->decimal('current_currency_exchange', 8, 2);
            $table->unsignedTinyInteger('source')->default(0); // cash, card or smth else
            $table->string('title');
            $table->string('slug');
            $table->mediumText('description')->nullable();
            // $table->boolean('is_complex')->default(0);
            
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('trip_expenses')->cascadeOnDelete();
            
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('created_at')->useCurrent();
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
