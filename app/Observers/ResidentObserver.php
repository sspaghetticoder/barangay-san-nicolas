<?php

namespace App\Observers;

use App\Models\Resident;

class ResidentObserver
{
    public function created(Resident $resident)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($resident)
            ->log("Resident was created.");
    }
    
    public function updated(Resident $resident)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($resident)
            ->log("Resident was updated.");
    }

    public function deleted(Resident $resident)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($resident)
            ->log("Resident was deleted.");
    }

    public function restored(Resident $resident)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($resident)
            ->log("Resident was restored.");
    }
}
