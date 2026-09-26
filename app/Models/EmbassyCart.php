<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmbassyCart extends Model
{
    use HasFactory;

    protected $table = 'embassy_cart';

    protected $fillable = [
        'user_id',
        'service_id',
        'quantity',
        'total_fee',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'total_fee' => 'decimal:2',
        ];
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
