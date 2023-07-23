<?php

namespace App\Services\Backend\User;

use App\Models\User;
use App\Services\Backend\User\Exception\LastSuperadminException;
use App\Services\Base\User\Dto\UserDto;
use App\Services\Base\User\UserService as UserServiceBase;
use Illuminate\Support\Facades\Cache;

class UserService extends UserServiceBase
{
    /**
     * @param \App\Services\Base\User\Dto\UserDto $dto
     *
     * @return \App\Models\User
     */
    public function create(UserDto $dto): User
    {
        $user = parent::create($dto);

        Cache::tags('users')
            ->flush();

        return $user;
    }

    /**
     * @throws \App\Services\Backend\User\Exception\LastSuperadminException
     */
    public function update(string $id, UserDto $dto): User
    {

        $user = $this->userRepository->getById($id);

        if ($user->active && $this->isLastSuperadmin($user)) {
            throw new LastSuperadminException;
        }

        Cache::tags('users')
            ->flush();

        return $this->userRepository->update($user, $dto);
    }

    /**
     * @param string $id
     *
     * @throws \App\Services\Backend\User\Exception\LastSuperadminException
     * @return void
     */
    public function delete(string $id): void
    {
        $user = $this->userRepository->getById($id);

        if ($user->active && $this->isLastSuperadmin($user)) {
            throw new LastSuperadminException;
        }

        $this->userRepository->delete($user);

        Cache::tags('users')
            ->flush();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function restore(string $id): void
    {
        $user = $this->userRepository->getById($id);

        $user->restore();

        Cache::tags('users')
            ->flush();
    }

    /**
     * Reject ability to remove last Superadmin.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    private function isLastSuperadmin(User $user): bool
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
