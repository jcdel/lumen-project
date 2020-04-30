<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserRepositoryInterface;
use App\Entities\User;


class UserRepository implements UserRepositoryInterface
{
    const LIMIT = 5;

    public function getUsers()
    {
        return User::paginate(self::LIMIT);
    }

    public function getUserById(int $id)
    {
        return User::findOrFail($id);
    }

    public function deleteUserById(int $id): void
    {
        User::destroy($id);
    }
}