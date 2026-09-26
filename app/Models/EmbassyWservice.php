<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmbassyWservice extends Model
{
    use HasFactory;

    protected $table = 'embassy_wservices';

    protected $fillable = [
        'service_id',
        'name',
        'description',
        'fee',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'fee' => 'decimal:2',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(EmbassyService::class, 'service_id');
    }
}
