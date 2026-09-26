<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EmbassyAppointmentSlot extends Model
{
    use HasFactory;

    protected $table = 'embassy_appointment_slots';

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'max_appointments',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function status(): HasOne
    {
        return $this->hasOne(EmbassyAppointmentStatus::class, 'slot_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(EmbassyAppointment::class, 'slot_id');
    }
}
