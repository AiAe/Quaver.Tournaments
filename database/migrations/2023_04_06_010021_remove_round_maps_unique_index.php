<?php

use App\Models\TournamentStageRound;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tournament_stage_round_maps', function (Blueprint $table) {
            $table->dropForeignIdFor(TournamentStageRound::class);
            $table->dropUnique('round_index_unique');
            $table->index(['tournament_stage_round_id', 'index'], 'round_id_index');
        });
    }

    public function down(): void
    {
        Schema::table('tournament_stage_round_maps', function (Blueprint $table) {
            $table->foreignIdFor(TournamentStageRound::class)->constrained()->cascadeOnDelete();
            $table->unique(['tournament_stage_round_id', 'index'], 'round_index_unique');
            $table->dropIndex('round_id_index');
        });
    }
};
