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
        Schema::table('campgrounds', function (Blueprint $table) {
            $table->decimal('distance_to_home_center', 5, 2)->nullable();
            $table->decimal('distance_to_supermarket', 5, 2)->nullable();
            $table->decimal('distance_to_convenience_store', 5, 2)->nullable();
            $table->decimal('distance_to_onsen', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campgrounds', function (Blueprint $table) {
            //
        });
    }
};
