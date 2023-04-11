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
        Schema::table('tournament_match_ffa_participants', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\TournamentStageRound::class)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournament_match_ffa_participants', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\TournamentStageRound::class);
        });
    }
};
