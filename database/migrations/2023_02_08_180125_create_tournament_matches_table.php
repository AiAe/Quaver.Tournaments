<?php

use App\Models\Team;
use App\Models\TournamentMatch;
use App\Models\TournamentStageRound;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tournament_matches', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(TournamentStageRound::class)->constrained()->cascadeOnDelete();

            $table->string('label');
            $table->dateTime('timestamp');
            $table->integer('quaver_mp_id')->nullable();

            $table->foreignIdFor(Team::class, 'team1_id');
            $table->foreignIdFor(Team::class, 'team2_id');

            $table->integer('score1')->nullable();
            $table->integer('score2')->nullable();

            $table->foreignIdFor(TournamentMatch::class, 'preceding_match1_id')->nullable();
            $table->foreignIdFor(TournamentMatch::class, 'preceding_match2_id')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournament_matches');
    }
};
