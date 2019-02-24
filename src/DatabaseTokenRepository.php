<?php

namespace ThiagoBrauer\MultiAuthPasswordReset;

use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\DatabaseTokenRepository as LaravelDatabaseTokenRepository;
use Illuminate\Support\Carbon;

class DatabaseTokenRepository extends LaravelDatabaseTokenRepository
{
    /**
     * Create a new token record.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @return string
     */
    public function create(CanResetPasswordContract $user)
    {
        $keyName = isset($user->keyName) ? $user->keyName : 'email';
        $keyValue = $user->{$keyName};

        $this->deleteExisting($user);

        // We will create a new, random token for the user so that we can e-mail them
        // a safe link to the password reset form. Then we will insert a record in
        // the database so that we can verify the token within the actual reset.
        $token = $this->createNewToken();

        $this->getTable()->insert([
            $keyName => $keyValue, 
            'token' => $this->hasher->make($token), 
            'created_at' => new Carbon
        ]);

        return $token;
    }

    /**
     * Delete all existing reset tokens from the database.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @return int
     */
    protected function deleteExisting(CanResetPasswordContract $user)
    {
        $keyName = isset($user->keyName) ? $user->keyName : 'email';
        $keyValue = $user->{$keyName};

        return $this->getTable()->where($keyName, $keyValue)->delete();
    }

    /**
     * Determine if a token record exists and is valid.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $token
     * @return bool
     */
    public function exists(CanResetPasswordContract $user, $token)
    {
        $keyName = isset($user->keyName) ? $user->keyName : 'email';
        $keyValue = $user->{$keyName};
    
        $record = (array) $this->getTable()->where(
            $keyName, $keyValue
        )->first();

        return $record &&
               ! $this->tokenExpired($record['created_at']) &&
                 $this->hasher->check($token, $record['token']);
    }

}
