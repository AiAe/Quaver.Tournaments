<?php

use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('team_ranks', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tournament::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quaver_4k_rank');
            $table->unsignedInteger('quaver_7k_rank');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_ranks');
    }
};
