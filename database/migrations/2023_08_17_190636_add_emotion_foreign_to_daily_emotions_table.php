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
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('emotion_id')->references('id')->on('emotions');
            $table->foreign('journal_entry_id')->references('id')->on('journal_entries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_emotions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['emotion_id']);
            $table->dropForeign(['journal_entry_id']);
        });
    }
};
