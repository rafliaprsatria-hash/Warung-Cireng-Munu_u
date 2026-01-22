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
        Schema::table('cirengs', function (Blueprint $table) {
            // Change link_img column from string to text to accommodate longer URLs
            $table->text('link_img')->nullable()->change();
            // Also change link_wa to text for consistency
            $table->text('link_wa')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cirengs', function (Blueprint $table) {
            $table->string('link_img')->nullable()->change();
            $table->string('link_wa')->nullable()->change();
        });
    }
};
