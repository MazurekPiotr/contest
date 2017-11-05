<?php
namespace App\User;

use App\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $userRepository;

    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($id) {
        return $this->userRepository->getUser($id);
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }
}