<?php

namespace App\Repositories;

use App\Models\User;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth2;

class UserRepository
{
    public function getUserBySocId($user, $socName)
    {
        $userInSystem = User::query()
            ->where('social_id', $user->id)
            ->where('auth_type', $socName)
            ->first();

        if (is_null($userInSystem)) {
            $userInSystem = new User();

            $userInSystem->fill([
                'name' => !empty($user->getNickname()) ? $user->getNickname() : '',
                'email' => !empty($user->getEmail()) ? $socName . ':' . $user->getEmail() : '',
                'password' => '',
                'social_id' => !empty($user->getId()) ? $user->getId() : '',
                'auth_type' => $socName,
                'avatar' => !empty($user->getAvatar()) ? $user->getAvatar() : '',
                'email_verified_at' => now(),
            ]);
            $userInSystem->save();
        }

        return $userInSystem;
    }
}
