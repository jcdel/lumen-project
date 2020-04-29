<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;

class UserController extends Controller
{

    /**
     * Get all User.
     *
     * @return Response
    */
    public function allUsers()
    {
        return new UserCollection(User::all());
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

        return new UserResource(User::findOrFail($id));
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

        $user->delete();
        return response()->json(['message'  => "User has been successfully deleted.",], 200);
    }

}
