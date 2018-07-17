<?php

namespace App\Register;

use Illuminate\Queue\SerializesModels;

class AdminRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $adminuser;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($adminuser)
    {
        $this->adminuser = $adminuser;
    }
}
