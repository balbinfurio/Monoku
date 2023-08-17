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
        Schema::table('daily_emotions', function (Blueprint $table) {
            $table->text('journal_entry', 256)->after('emotion_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_emotions', function (Blueprint $table) {
            $table->dropColumn('journal_entry');
        });
    }
};
