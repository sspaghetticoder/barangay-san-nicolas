<?php

namespace App\Http\Livewire;

use App\Events\DocumentGenerated;
use App\Models\Activity;
use App\Models\Resident;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    private array $documentLoggedActivities = DocumentGenerated::DOCUMENTS;

    public function render()
    {
        // dd($this->getRequestedDocumentsTotalAll());
        return view('livewire.dashboard', [
            'months' => $this->getResidentsTotalPerMonth(),
            'week' => $this->getActivitiesTotalPerWeek(),
            'requestedDocuments' => $this->getRequestedDocumentsTotalAll(),
            'residents' => number_format($this->getResidentsTotalAll()),
            'users' => number_format($this->getUsersTotalAll()),
            'activities' => number_format($this->getActivitiesTotalAll()),
            'documents' => number_format($this->getDocumentsTotalAll()),
        ]);
    }

    private function getResidentsTotalPerMonth()
    {
        return Resident::whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])->get()->groupBy(function ($resident) {
            return Carbon::parse($resident->created_at)->format('M');
        })->map(function ($month) {
            return $month->count();
        })->toArray();
    }

    private function getResidentsTotalAll()
    {
        return Resident::get('id')->count();
    }

    private function getUsersTotalAll()
    {
        return User::get('id')->count();
    }

    private function getActivitiesTotalAll()
    {
        return Activity::get('id')->count();
    }

    private function getActivitiesTotalPerWeek()
    {
        return Activity::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->get()->groupBy(function ($activity) {
            return Carbon::parse($activity->created_at)->format('D');
        })->map(function ($activity) {
            return $activity->count();
        })->toArray();
    }

    private function getDocumentsTotalAll()
    {
        return Activity::whereIn('description', $this->documentLoggedActivities)->get()->count();
    }

    private function getRequestedDocumentsTotalAll()
    {
        $documents = Activity::whereIn('description', $this->documentLoggedActivities)
                        ->get()
                        ->groupBy(fn ($document) => $document->description)
                        ->map(fn ($document) => $document->count())
                        ->toArray();

        $reindexed = [];

        foreach ($documents as $documentKey => $documentValue) {
            if (in_array($documentKey, $this->documentLoggedActivities)) 
                $reindexed[array_search($documentKey, $this->documentLoggedActivities)] = $documentValue;
        }

        return $reindexed;
    }
}
