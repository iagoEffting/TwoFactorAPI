<?php

namespace IagoEffting\TwoFactorAPI\Repositories;

class AccessRepository
{

  public function create($user)
  {
    $accessEntity = config('twofactor.access_model');

    $access = app()->make($accessEntity);
    $access->ip = '127.0.0.1';
    $access->browser = 'chrome';

    $user->access()->save($access);
  }

}