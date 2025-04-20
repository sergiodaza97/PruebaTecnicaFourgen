<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginRepositoryInterface
{
    public function login(array $credentials)
    {
        if (! $token = auth()->attempt($credentials)) {
            return false;
        }

        return $token;
    }

    public function logout()
    {
        auth()->logout();
    }

    public function refresh()
    {
        return auth()->refresh();
    }

    public function getAuthenticatedUser()
    {
        return auth()->user();
    }

}