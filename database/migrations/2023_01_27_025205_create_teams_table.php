<?php

use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->foreignIdFor(Tournament::class);
            $table->foreignIdFor(User::class);

            $table->timestamps();
        });

        Schema::create('team_user', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Team::class);
            $table->foreignIdFor(User::class);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('team_user');
        Schema::dropIfExists('teams');
    }
};
