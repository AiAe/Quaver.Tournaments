<?php

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();

            $table->string('name')->index();
            $table->foreignIdFor(User::class)->index();
            $table->integer('format')->default(TournamentFormat::Solo->value)->index();
            $table->integer('status')->default(TournamentStatus::Unlisted->value)->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
};
