<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("User was created.");
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("User was updated.");
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("User was deleted.");
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("User was restored.");
    }
}
