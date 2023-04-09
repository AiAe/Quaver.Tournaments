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
        Schema::table('tournament_stage_round_maps', function (Blueprint $table) {
            $table->float('modded_bpm')->nullable()->after('modded_difficulty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournament_stage_round_maps', function (Blueprint $table) {
            $table->dropColumn('modded_bpm');
        });
    }
};
