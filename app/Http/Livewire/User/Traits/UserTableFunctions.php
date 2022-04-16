<?php

namespace App\Http\Livewire\User\Traits;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

trait UserTableFunctions
{
    use LivewireAlert;

    public function bulkActions(): array
    {
        return [
            'activateSelectedConfirm' => 'Activate',
            'deactivateSelectedConfirm' => 'Deactivate',
        ];
    }

    public function activateSelectedConfirm()
    {
        if (empty($this->getSelected())) return $this->alert('error', 'No selected data', [
            'position' => 'center',
            'timer' => 1500,
            'toast' => true,
        ]);

        $this->alert('warning', 'Are you sure you want to activate selected data?', [
            'position' => 'center',
            'timer' => '10000',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'activateSelected',
            'showDenyButton' => false,
            'onDenied' => '',
            'denyButtonText' => 'Cancel',
            'confirmButtonText' => 'Confirm',
            'showCancelButton' => true,
            'onDismissed' => '',
            'cancelButtonText' => 'Cancel',
            'timerProgressBar' => true,
        ]);
    }

    public function deactivateSelectedConfirm()
    {
        if (empty($this->getSelected())) return $this->alert('error', 'No selected data', [
            'position' => 'center',
            'timer' => 1500,
            'toast' => true,
        ]);

        $this->alert('warning', 'Are you sure you want to deactivate selected data?', [
            'position' => 'center',
            'timer' => '10000',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'deactivateSelected',
            'showDenyButton' => false,
            'onDenied' => '',
            'denyButtonText' => 'Cancel',
            'confirmButtonText' => 'Confirm',
            'showCancelButton' => true,
            'onDismissed' => '',
            'cancelButtonText' => 'Cancel',
            'timerProgressBar' => true,
        ]);
    }

    public function activateSelected()
    {
        if (count($this->getSelected())) {
            User::whereIn('id', $this->getSelected())->where('active', 0)->update(['active' => true]);
        }

        $this->clearSelected();
    }

    public function deactivateSelected()
    {
        if (count($this->getSelected())) {
            User::whereIn('id', $this->getSelected())->where('active', 1)->update(['active' => false]);
        }

        $this->clearSelected();
    }
}
