<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EmbassyServiceStatus extends Model
{
    use HasFactory;

    protected $table = 'embassy_service_status';

    protected $fillable = [
        'status',
        'notes',
        'processed_by',
        'serviceable_type',
        'serviceable_id',
    ];

    public function serviceable(): MorphTo
    {
        return $this->morphTo();
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
