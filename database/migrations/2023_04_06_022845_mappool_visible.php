<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tournament_stage_rounds', function (Blueprint $table) {
            $table->integer('mappool_visible')->default(0)->nullable()->after('round_text');
        });
    }

    public function down(): void
    {
        Schema::table('tournament_stage_rounds', function (Blueprint $table) {
            $table->dropColumn('mappool_visible');
        });
    }
};
