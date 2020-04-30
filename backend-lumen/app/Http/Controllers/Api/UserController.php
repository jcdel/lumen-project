<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get all User.
     *
     * @return Response
    */
    public function allUsers()
    {
        return new UserCollection($this->user->getUsers());
    }

    /**
     * Get one user.
     *
     * @return Response
    */
    public function singleUser($id)
    {
        $user = User::find($id);

        if(!$user)
            return response()->json(['message' => 'user not found!'], 404);

        return new UserResource($this->user->getUserById($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
    */
    public function deleteUser($id)
    {
        $user = User::find($id);

        if(!$user)
            return response()->json(['message' => 'user not found!'], 404);

        $this->user->deleteUserById($id);
        return response()->json(['message'  => "User has been successfully deleted.",], 200);
    }

}
