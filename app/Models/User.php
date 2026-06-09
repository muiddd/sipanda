<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'foto_profile',
    ];

    public function favoriteMateris()
    {
        return $this->belongsToMany(Materi::class, 'user_favorite_materis', 'user_id', 'materi_id', 'id', 'materi_id')->withTimestamps();
    }

    public function streak()
    {
        return $this->hasOne(UserStreak::class, 'user_id', 'id');
    }

    public function calculateStreak()
    {
        $learningDates = \App\Models\LearningSession::where('user_id', $this->id)
            ->where('status', 'completed')
            ->pluck('start_time')
            ->map(fn($dt) => $dt instanceof \Carbon\Carbon ? $dt->toDateString() : \Carbon\Carbon::parse($dt)->toDateString())
            ->toArray();

        $studyDates = \App\Models\StudySession::where('user_id', $this->id)
            ->pluck('started_at')
            ->map(fn($dt) => $dt instanceof \Carbon\Carbon ? $dt->toDateString() : \Carbon\Carbon::parse($dt)->toDateString())
            ->toArray();

        $allDates = array_unique(array_merge($learningDates, $studyDates));
        rsort($allDates);

        $dates = array_map(fn($date) => \Carbon\Carbon::parse($date)->startOfDay(), $allDates);

        if (empty($dates)) {
            return [
                'current_streak' => 0,
                'longest_streak' => 0,
            ];
        }

        $today = \Carbon\Carbon::today()->startOfDay();
        $yesterday = \Carbon\Carbon::yesterday()->startOfDay();

        $hasSessionToday = false;
        $hasSessionYesterday = false;
        
        foreach ($dates as $d) {
            if ($d->eq($today)) {
                $hasSessionToday = true;
            }
            if ($d->eq($yesterday)) {
                $hasSessionYesterday = true;
            }
        }

        $currentStreak = 0;
        if ($hasSessionToday || $hasSessionYesterday) {
            $checkDate = $hasSessionToday ? $today : $yesterday;
            
            foreach ($dates as $d) {
                if ($d->eq($checkDate)) {
                    $currentStreak++;
                    $checkDate = $checkDate->copy()->subDay();
                } elseif ($d->lt($checkDate)) {
                    break;
                }
            }
        }

        $longestStreak = 0;
        $tempStreak = 0;
        $expectedDate = null;

        $ascDates = array_reverse($dates);
        foreach ($ascDates as $d) {
            if ($expectedDate === null) {
                $tempStreak = 1;
            } else {
                if ($d->eq($expectedDate)) {
                    $tempStreak++;
                } elseif ($d->gt($expectedDate)) {
                    $longestStreak = max($longestStreak, $tempStreak);
                    $tempStreak = 1;
                } else {
                    continue;
                }
            }
            $expectedDate = $d->copy()->addDay();
        }
        $longestStreak = max($longestStreak, $tempStreak);

        return [
            'current_streak' => $currentStreak,
            'longest_streak' => $longestStreak,
        ];
    }

    public function updateStreak()
    {
        $calculated = $this->calculateStreak();
        
        $streak = $this->streak()->updateOrCreate(
            ['user_id' => $this->id],
            [
                'current_streak' => $calculated['current_streak'],
                'longest_streak' => $calculated['longest_streak'],
                'last_activity_date' => \Carbon\Carbon::today()->toDateString(),
            ]
        );

        return $streak;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}
