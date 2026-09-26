<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmbassyCitizen extends Model
{
    use HasFactory;

    protected $table = 'embassy_citizens';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'nationality',
        'passport_number',
        'passport_expiry',
        'residence_card_number',
        'residence_card_expiry',
        'phone',
        'email',
        'address',
        'area_id',
        'occupation_id',
        'father_name',
        'mother_name',
        'marital_status',
        'photo_path',
    ];

    protected $appends = ['full_name', 'area_of_residence'];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'passport_expiry' => 'date',
            'residence_card_expiry' => 'date',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }

    public function getAreaOfResidenceAttribute(): string
    {
        return $this->area?->name ?? 'N/A';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(EmbassyArea::class, 'area_id');
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(EmbassyOccupation::class, 'occupation_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(EmbassyAppointment::class, 'citizen_id');
    }

    public function passports(): HasMany
    {
        return $this->hasMany(EmbassyPassport::class, 'citizen_id');
    }

    public function consulars(): HasMany
    {
        return $this->hasMany(EmbassyConsular::class, 'citizen_id');
    }

    public function socials(): HasMany
    {
        return $this->hasMany(EmbassySocial::class, 'citizen_id');
    }

    public function covid19(): HasMany
    {
        return $this->hasMany(EmbassyCovid19::class, 'citizen_id');
    }

    public function reissues(): HasMany
    {
        return $this->hasMany(EmbassyReissue::class, 'citizen_id');
    }
}
