<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use App\Models\TokenUser;

class TokenUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return TokenUser::find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        return TokenUser::where('id', $identifier)
                        ->where('api_token', $token)
                        ->first();
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
        $user->save();
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials['api_token'])) {
            return null;
        }

        return TokenUser::where('api_token', $credentials['api_token'])->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Ici, nous ne faisons pas de validation supplémentaire, mais vous pouvez ajouter des règles si nécessaire.
        return true;
    }
}
