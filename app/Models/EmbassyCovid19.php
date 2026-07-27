<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmbassyCovid19 extends Model
{
    use HasFactory;

    protected $table = 'embassy_covid19';

    protected $fillable = [
        'citizen_id',
        'vaccination_status',
        'last_test_date',
        'test_result',
        'certificate_path',
    ];

    protected function casts(): array
    {
        return [
            'last_test_date' => 'date',
        ];
    }

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(EmbassyCitizen::class, 'citizen_id');
    }
}
