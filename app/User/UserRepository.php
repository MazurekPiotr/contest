<?php
namespace App\User;

class UserRepository implements UserRepositoryInterface
{

    public function getUser($id)
    {
        return User::find($id);
    }

    public function getUserByMail($mail)
    {
        return User::where('email', $mail)->first();
    }

    public function getAll()
    {
        return User::all();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}