<?php

namespace App\Models;

use App\Enums\TournamentFormat;
use App\Enums\TournamentGameMode;
use App\Enums\TournamentStageFormat;
use App\Enums\TournamentStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodeine\Metable\Metable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Tournament extends Model
{
    use Metable, HasFactory, SoftDeletes, HasSEO;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'format',
        'mode',
        'status'
    ];

    protected $casts = [
        'format' => TournamentFormat::class,
        'mode' => TournamentGameMode::class,
        'status' => TournamentStatus::class
    ];

    protected $with = ['metas'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function stages(): HasMany
    {
        return $this->hasMany(TournamentStage::class);
    }

    public function participants()
    {
        return $this->teams->flatMap->members;
    }

    public function staff(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tournament_staff')
            ->using(TournamentStaff::class)
            ->withPivot('staff_role')
            ->orderByPivot('staff_role');
    }

    public function staffApplications(): HasMany
    {
        return $this->hasMany(TournamentStaffApplication::class);
    }

    public function dates()
    {
        $key_name = sprintf("tournament_%s_dates", $this->id);

        return \Cache::remember($key_name, 60, function () {
            if($this->status !== TournamentStatus::Concluded) {
                $stage = $this->stages()->select(['id'])->where('stage_format', TournamentStageFormat::Registration)->first();
            } else {
                // Take last stage if tournament is concluded
                $stage = $this->stages()->select(['id'])->orderBy('index')->first();
            }

            if ($stage) {
                $round = TournamentStageRound::select(['starts_at', 'ends_at'])->where('tournament_stage_id', $stage->id)->first();

                if ($round) {
                    return $round;
                }
            }

            // Return something default if stage & round does not exist
            $round = new TournamentStageRound();
            $round->starts_at = Carbon::now();
            $round->ends_at = Carbon::now();

            return $round;
        });
    }

    public function clearDates()
    {
        $key_name = sprintf("tournament_%s_dates", $this->id);
        \Cache::forget($key_name);
        $this->dates();
    }

    public function getDynamicSEOData(): SEOData
    {
        $description = $this->getMeta('information') ?? null;

        return new SEOData(
            title: e($this->name),
            description: e($description),
            author: e($this->user->username)
        );
    }
}
