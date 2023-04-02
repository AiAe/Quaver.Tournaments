<?php

namespace App\Models;

use App\Enums\TournamentFormat;
use App\Enums\TournamentGameMode;
use App\Enums\TournamentStatus;
use Cache;
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

    public function startsAt(): ?Carbon
    {
        return $this->getDate('starts_at');
    }

    public function registrationEndsAt(): ?Carbon
    {
        return $this->getDate('reg_ends_at');
    }

    public function endsAt(): ?Carbon
    {
        return $this->getDate('ends_at');
    }

    private function getDateCacheKey(): string
    {
        return sprintf("tournament_%s_dates", $this->id);
    }

    private function getDate(string $attr): ?Carbon
    {
        $this->load('stages.rounds');
        $dates = Cache::remember($this->getDateCacheKey(), 60, fn() => [
            'starts_at' => $this->stages->first()?->rounds->first()?->starts_at,
            'reg_ends_at' => $this->stages->first()?->rounds->first()?->ends_at,
            'ends_at' => $this->stages->last()?->rounds->last()?->ends_at,
        ]);

        return $dates[$attr];
    }

    public function clearDates()
    {
        Cache::forget($this->getDateCacheKey());
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
