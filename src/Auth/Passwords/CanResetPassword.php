<?php

namespace ThiagoBrauer\MultiAuthPasswordReset\Auth\Passwords;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

trait CanResetPassword
{
    /**
     * Get the name of the user's unique key used for password reset. Defaults to email.
     *
     * @return string
     */
    public function getKeyNameForPasswordReset()
    {
        return isset($this->keyName) ? $this->keyName : 'email';
    }

    /**
     * Get the user's unique key used for password reset.
     *
     * @return string
     */
    public function getKeyForPasswordReset()
    {
        return $this->{$this->getKeyNameForPasswordReset()};
    }
}
