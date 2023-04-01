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
        Schema::table('tournaments', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tournament_stages', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tournament_stage_rounds', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tournament_stage_round_maps', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tournament_matches', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
