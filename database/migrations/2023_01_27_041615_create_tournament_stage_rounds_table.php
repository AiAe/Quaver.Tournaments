<?php

use App\Models\TournamentStage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tournament_stage_rounds', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(TournamentStage::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('index');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');

            $table->unique(['tournament_stage_id', 'index']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournament_stage_rounds');
    }
};
