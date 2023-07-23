<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Contract\UserRepository;
use App\Services\Base\User\Dto\UserDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Str;

/**
 * Class UserRepository.
 */
class UserEloquentRepository implements UserRepository
{
    /**
     * @param \App\Services\Base\User\Dto\UserDto $dto
     *
     * @return \App\Models\User
     */
    public function create(UserDto $dto): User
    {
        $user = new User();

        $user->password = bcrypt($dto->getPassword() ?: Str::password());
        $user->active   = $dto->isActive();
        $user->name     = $dto->getName();
        $user->phone    = $dto->getPhone();
        $user->email    = $dto->getEmail();

        $user->save();

        $user->syncRoles($dto->getRole());

        return $user;
    }

    /**
     * @param \App\Models\User                    $user
     * @param \App\Services\Base\User\Dto\UserDto $dto
     *
     * @return \App\Models\User
     */
    public function update(User $user, UserDto $dto): User
    {
        if ($dto->getPassword()) {
            $user->password = bcrypt($dto->getPassword());
        }

        $user->active = $dto->isActive();
        $user->name   = $dto->getName();
        $user->phone  = $dto->getPhone();
        $user->email  = $dto->getEmail();

        $user->save();

        $user->syncRoles($dto->getRole());

        return $user;
    }

    /**
     * @param \App\Models\User $user
     *
     * @return void
     */
    public function delete(User $user): void
    {
        if (! $user->trashed()) {
            $user->active = false;
            $user->save();
        }

        $user->delete();
    }

    /**
     * @param int  $paginate
     * @param bool $withTrashed
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(
        int $paginate,
        bool $withTrashed = false
    ): LengthAwarePaginator {
        $client = User::query();

        if ($withTrashed) {
            $client = $client->withTrashed();
        }

        return $client->paginate($paginate);
    }

    /**
     * @param string $id
     *
     * @return \App\Models\User
     */
    public function getById(string $id): User
    {
        /** @var User $user */
        $user = User::query()
            ->where('id', '=', $id)
            ->first();

        if (! $user) {
            abort(404, 'User not found');
        }

        return $user;
    }
}
