<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tournament_stage_rounds', function (Blueprint $table) {
            $table->text('round_text')->nullable()->after('index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournament_stage_rounds', function (Blueprint $table) {
           $table->dropColumn('round_text');
        });
    }
};
