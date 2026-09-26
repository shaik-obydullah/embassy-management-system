<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmbassyConsular extends Model
{
    use HasFactory;

    protected $table = 'embassy_consulars';

    protected $fillable = [
        'citizen_id',
        'user_id',
        'service_id',
        'reference_number',
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

    public function service(): BelongsTo
    {
        return $this->belongsTo(EmbassyService::class, 'service_id');
    }
}
