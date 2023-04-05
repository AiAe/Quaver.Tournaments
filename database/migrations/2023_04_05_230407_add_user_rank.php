<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('quaver_4k_rank')->nullable();
            $table->unsignedInteger('quaver_7k_rank')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('quaver_4k_rank');
            $table->dropColumn('quaver_7k_rank');
        });
    }
};
