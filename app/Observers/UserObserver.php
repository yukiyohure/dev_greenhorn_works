<?php

namespace App\Observers;

use App\Entities\Questions;
use App\User;
use App\Notifications\SlackPosted;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function updating()
    {
      $user = new User();
      $user->notify(new slackPosted());
    }

    public function creating()
    {
      $user = new User();
      $user->notify(new slackPosted());
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting()
    {
        //
    }
}
