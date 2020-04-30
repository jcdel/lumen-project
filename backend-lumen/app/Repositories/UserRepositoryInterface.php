<?php

namespace App\Repositories;

use App\Entities\User;

interface UserRepositoryInterface
{
    public function getUsers();
    public function getUserById(int $id);
    public function deleteUserById(int $id);
}