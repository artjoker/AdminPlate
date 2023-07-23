<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role as RoleModel;

/**
 * Class Role.
 *
 * @property bool $active
 * @mixin IdeHelperRole
 */
class Role extends RoleModel
{
    use HasFactory;

    public string $guard_name = 'admin';
    protected $keyType        = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'guard_name',
        'active',
    ];

    /**
     * Find a role by its names and guard name.
     *
     * @param array<int, string> $names
     * @param null|string        $guardName
     *
     * @return \Illuminate\Support\Collection
     */
    public static function findByNames(
        array $names,
        string $guardName = null
    ): Collection {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        return static::whereIn('name', $names)
            ->where('guard_name', $guardName)
            ->get();
    }
}
