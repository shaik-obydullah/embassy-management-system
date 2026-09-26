<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmbassyReissue extends Model
{
    use HasFactory;

    protected $table = 'embassy_reissue';

    protected $fillable = [
        'citizen_id',
        'user_id',
        'passport_id',
        'reason',
        'reference_number',
        'status',
    ];

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(EmbassyCitizen::class, 'citizen_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function passport(): BelongsTo
    {
        return $this->belongsTo(EmbassyPassport::class, 'passport_id');
    }
}
