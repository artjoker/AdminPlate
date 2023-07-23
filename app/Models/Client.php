<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Client.
 *
 * @mixin IdeHelperClient
 */
class Client extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasUuids;

    public $incrementing = false;
    protected $keyType   = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope filter by active.
     *
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeOnlyActive(Builder $query): Builder
    {
        return $query->where('active', '=', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function fulName(): Attribute
    {
        return Attribute::make(
            get: fn (
                mixed $value,
                mixed $attributes
            ) => "{$this->first_name} {$this->last_name}",
        );
    }
}
