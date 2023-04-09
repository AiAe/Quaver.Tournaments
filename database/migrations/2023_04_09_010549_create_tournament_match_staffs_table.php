<?php

use App\Models\TournamentMatch;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tournament_match_staff', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(TournamentMatch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->integer('role');

            $table->unique(['tournament_match_id', 'user_id', 'role'], 'unique');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournament_match_staff');
    }
};
