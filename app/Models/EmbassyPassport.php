<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmbassyPassport extends Model
{
    use HasFactory;

    protected $table = 'embassy_passports';

    protected $fillable = [
        'citizen_id',
        'user_id',
        'application_type',
        'reference_number',
        'old_passport_number',
        'status',
        'delivery_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'delivery_date' => 'date',
        ];
    }

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(EmbassyCitizen::class, 'citizen_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reissues(): HasMany
    {
        return $this->hasMany(EmbassyReissue::class, 'passport_id');
    }
}
