<?php

use App\Models\Team;
use App\Models\TournamentMatch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tournament_match_ffa_participants', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(TournamentMatch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();

            $table->unique(['tournament_match_id', 'team_id'], 'ffa_unique');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournament_match_ffa_participants');
    }
};
