<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Entities\User;

class UserController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function currentUser()
    {
        return response()->json([
            'user' => Auth::user()
        ], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
         return response()->json([
             'users' =>  User::all()
            ], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'user' => $user
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'user not found!'
            ], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return response()->json([
                'message'  => "User has been successfully deleted.",
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'user not found!'
            ], 404);
        }
    }

}
