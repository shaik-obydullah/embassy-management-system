<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmbassyAppointment extends Model
{
    use HasFactory;

    protected $table = 'embassy_appointments';

    protected $fillable = [
        'user_id',
        'citizen_id',
        'slot_id',
        'service_id',
        'reference_number',
        'status',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(EmbassyCitizen::class, 'citizen_id');
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(EmbassyAppointmentSlot::class, 'slot_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(EmbassyService::class, 'service_id');
    }
}
