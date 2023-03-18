<?php

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tournament_staff_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Tournament::class);

            $table->longText('message');
            $table->unsignedInteger('status');

            $table->unique(['user_id', 'tournament_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournament_staff_applications');
    }
};
