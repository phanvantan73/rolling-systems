<?php

namespace App\Http\Services;

use Auth;

/**
 * Service class for authentication handling
 */
class AuthService
{
    public function login(array $inputs)
    {
        $remember = isset($inputs['remember']) && $inputs['remember'] ? true : false;

        return Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']], $remember);
    }
}
