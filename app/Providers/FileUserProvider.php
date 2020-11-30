<?php


namespace App\Providers;


use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class FileUserProvider implements UserProvider
{
    public $users;

    public function __construct()
    {
        $this->users = json_decode(Storage::get('users/users.json'));
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier){
        $user = Arr::first($this->users, function ($value, $key) use ($identifier) {
            return $value->username == $identifier;
        });
        if($user) {
            $user->remember_token = null;
            return new GenericUser(get_object_vars($user));
        }
        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }
}
