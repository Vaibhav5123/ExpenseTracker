<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User
     */
    public function getAuthenticatedUser()
    {
        return Auth::user();
    }
}
