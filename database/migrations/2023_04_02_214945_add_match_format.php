<?php

use App\Enums\MatchFormat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tournament_matches', function (Blueprint $table) {
            $table->unsignedInteger('match_format')->default(MatchFormat::OneVsOne->value);
        });
    }

    public function down(): void
    {
        Schema::table('tournament_matches', function (Blueprint $table) {
            $table->removeColumn('match_format');
        });
    }
};
