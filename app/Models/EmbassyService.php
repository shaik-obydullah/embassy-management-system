<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmbassyService extends Model
{
    use HasFactory;

    protected $table = 'embassy_services';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'fee',
        'is_active',
        'category',
        'required_documents',
        'estimated_days',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'fee' => 'decimal:2',
            'required_documents' => 'array',
        ];
    }

    public function wservices(): HasMany
    {
        return $this->hasMany(EmbassyWservice::class, 'service_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(EmbassyAppointment::class, 'service_id');
    }

    public function passports(): HasMany
    {
        return $this->hasMany(EmbassyPassport::class, 'service_id');
    }

    public function consulars(): HasMany
    {
        return $this->hasMany(EmbassyConsular::class, 'service_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(EmbassyCart::class, 'service_id');
    }
}
