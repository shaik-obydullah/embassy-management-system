<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmbassyArea extends Model
{
    use HasFactory;

    protected $table = 'embassy_areas';

    protected $fillable = [
        'name',
        'district',
        'region',
        'postal_code',
    ];

    public function citizens(): HasMany
    {
        return $this->hasMany(EmbassyCitizen::class, 'area_id');
    }
}
