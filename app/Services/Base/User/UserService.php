<?php

namespace App\Services\Base\User;

use App\Models\User;
use App\Repositories\Contract\UserRepository;
use App\Services\Base\User\Dto\UserDto;

class UserService
{
    /**
     * @param \App\Repositories\Contract\UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository,
    ) {
    }

    /**
     * @param \App\Services\Base\User\Dto\UserDto $dto
     *
     * @return \App\Models\User
     */
    public function create(UserDto $dto): User
    {
        return $this->userRepository->create($dto);
    }

    /**
     * @param string                              $id
     * @param \App\Services\Base\User\Dto\UserDto $dto
     *
     * @return \App\Models\User
     */
    public function update(string $id, UserDto $dto): User
    {
        $user = $this->userRepository->getById($id);

        return $this->userRepository->update($user, $dto);
    }
}
