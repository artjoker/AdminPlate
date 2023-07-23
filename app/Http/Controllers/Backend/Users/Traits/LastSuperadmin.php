<?php

namespace App\Http\Controllers\Backend\Users\Traits;

use App\Models\User;

/**
 * Trait LastSuperadmin.
 */
trait LastSuperadmin
{
    /**
     * Reject ability to remove last Superadmin.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function isLastSuperadmin(User $user): bool
    {
        // User is not superadmin
        if (! $user->hasRole(User::SUPERADMIN)) {
            return false;
        }
        // Superadmins qty grater than 1
        if (User::role(User::SUPERADMIN)->whereActive(true)->count() > 1) {
            return false;
        }

        return true;
    }
}
