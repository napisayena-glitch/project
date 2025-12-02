<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class CustomUserProvider implements UserProvider
{
    protected $model;
    protected $hasher;

    public function __construct($hasher, $model)
    {
        $this->model = $model;
        $this->hasher = $hasher;
    }

    public function retrieveById($identifier)
    {
        return $this->createModel()->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        $model = $this->createModel();

        return $model->where($model->getKeyName(), $identifier)
                     ->where($model->getRememberTokenName(), $token)
                     ->first();
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
        $user->save();
    }

    public function retrieveByCredentials(array $credentials)
    {
        $model = $this->createModel();

        return $model->where('email', $credentials['email'])->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }

    protected function createModel()
    {
        $class = '\\' . ltrim($this->model, '\\');

        return new $class;
    }
}
