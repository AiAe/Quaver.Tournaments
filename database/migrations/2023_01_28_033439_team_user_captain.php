<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('team_user', function (Blueprint $table) {
            $table->boolean('is_captain')->default(false);
            $table->index(['team_id', 'is_captain']);
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }

    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->foreignIdFor(User::class);
        });

        Schema::table('team_user', function (Blueprint $table) {
            $table->dropIndex(['team_id', 'is_captain']);
            $table->dropColumn('is_captain');
        });
    }
};
