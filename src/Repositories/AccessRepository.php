<?php

namespace IagoEffting\TwoFactorAPI\Repositories;

/**
 * Class AccessRepository
 * @package IagoEffting\TwoFactorAPI\Repositories
 */
class AccessRepository
{


    /**
     * @param $user
     *
     * @return mixed
     */
    public function create($user)
    {
        $accessEntity = config('twofactor.access_model');

        $access          = app()->make($accessEntity);
        $access->ip      = '127.0.0.1';
        $access->browser = 'chrome';

        $user->access()->save($access);

        return $user;

    }


}