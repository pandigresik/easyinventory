<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class CustomUserProvider extends UserProvider
{
    /**
     * Overrides the framework defaults validate credentials method.
     *
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];
        // PUT YOUR CUSTOM VALIDATION HERE

        // return $this->hasher->check($plain, $user->getAuthPassword());

        return $this->hashPassword($plain, $user->password_salt) == $user->getAuthPassword();
    }

    private function hashPassword($str, $auth_key = null)
    {
        return md5($str.$auth_key);
    }
}
