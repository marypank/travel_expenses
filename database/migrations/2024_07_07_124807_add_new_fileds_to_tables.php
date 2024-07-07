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
        Schema::table('trip_details', function (Blueprint $table) {
            $table->string('title')->after('trip_id');
            $table->string('slug')->after('title');
            $table->mediumText('description')->nullable()->after('date_from');
        });

        Schema::table('trip_expenses', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trip_details', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('slug');
            $table->dropColumn('description');
        });

        Schema::table('trip_expenses', function (Blueprint $table) {
            $table->string('slug')->after('title');
        });
    }
};
