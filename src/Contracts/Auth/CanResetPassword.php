<?php

namespace ThiagoBrauer\MultiAuthPasswordReset\Contracts\Auth;

interface CanResetPassword
{
    /**
     * Get the name of the user's unique key used for password reset. Defaults to email.
     *
     * @return string
     */
    public function getKeyNameForPasswordReset();

    /**
     * Get the user's unique key used for password reset.
     *
     * @return string
     */
    public function getKeyForPasswordReset();
}
