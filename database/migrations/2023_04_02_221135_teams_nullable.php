<?php

use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tournament_matches', function (Blueprint $table) {
            $table->foreignIdFor(Team::class, 'team1_id')->nullable()->change();
            $table->foreignIdFor(Team::class, 'team2_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tournament_matches', function (Blueprint $table) {
            $table->foreignIdFor(Team::class, 'team1_id');
            $table->foreignIdFor(Team::class, 'team2_id');
        });
    }
};
