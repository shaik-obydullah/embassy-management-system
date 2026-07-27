<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function citizen(): HasOne
    {
        return $this->hasOne(EmbassyCitizen::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(EmbassyAppointment::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(EmbassyActivity::class);
    }

    public function cart(): HasMany
    {
        return $this->hasMany(EmbassyCart::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(EmbassyComment::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(EmbassyContent::class, 'created_by');
    }

    public function consulars(): HasMany
    {
        return $this->hasMany(EmbassyConsular::class);
    }

    public function passports(): HasMany
    {
        return $this->hasMany(EmbassyPassport::class);
    }

    public function socials(): HasMany
    {
        return $this->hasMany(EmbassySocial::class);
    }

    public function reissues(): HasMany
    {
        return $this->hasMany(EmbassyReissue::class);
    }
}
