<?php

use App\Models\QuaverMap;
use App\Models\TournamentStageRound;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tournament_stage_round_maps', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(TournamentStageRound::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(QuaverMap::class)->constrained('quaver_maps', 'quaver_map_id');

            $table->unsignedInteger('index');

            $table->string('category');
            $table->string('sub_category')->default('');
            $table->string('mods')->nullable();
            $table->integer('offset')->default(0);
            $table->float('modded_difficulty')->nullable();

            $table->unique(['tournament_stage_round_id', 'index'], 'round_index_unique');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournament_stage_round_maps');
    }
};
