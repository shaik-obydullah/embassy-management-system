<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmbassySocial extends Model
{
    use HasFactory;

    protected $table = 'embassy_social';

    protected $fillable = [
        'citizen_id',
        'user_id',
        'service_type',
        'description',
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
}
