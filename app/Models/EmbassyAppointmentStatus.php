<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmbassyAppointmentStatus extends Model
{
    use HasFactory;

    protected $table = 'embassy_appointment_status';

    protected $fillable = [
        'slot_id',
        'current_bookings',
        'is_full',
    ];

    protected function casts(): array
    {
        return [
            'is_full' => 'boolean',
        ];
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(EmbassyAppointmentSlot::class, 'slot_id');
    }
}
