<?php

namespace App\Repositories\Contract;

use App\Models\User;
use App\Services\Base\User\Dto\UserDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface UserRepositoryInterface.
 */
interface UserRepository
{
    /**
     * @param int  $paginate
     * @param bool $withTrashed
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(
        int $paginate,
        bool $withTrashed = false
    ): LengthAwarePaginator;

    /**
     * @param \App\Services\Base\User\Dto\UserDto $dto
     *
     * @return \App\Models\User
     */
    public function create(UserDto $dto): User;

    /**
     * @param \App\Models\User                    $user
     * @param \App\Services\Base\User\Dto\UserDto $dto
     *
     * @return \App\Models\User
     */
    public function update(User $user, UserDto $dto): User;

    /**
     * @param string $id
     *
     * @return \App\Models\User
     */
    public function getById(string $id): User;
    
    public function delete(User $user): void;
}
