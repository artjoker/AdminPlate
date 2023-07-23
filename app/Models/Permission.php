<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as PermissionVendor;

/**
 * Class Permission.
 *
 * @mixin IdeHelperPermission
 */
class Permission extends PermissionVendor
{
    use HasFactory;

    /**
     * @var string
     */
    public string $guard_name = 'admin';
    /**
     * @var string
     */
    protected $keyType = 'string';
}
