<?php

namespace App\Events;

use App\Models\Resident;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocumentGenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public const DOCUMENTS = [
        'Indigency' => 'Certificate of Indigency was generated.',
        'Residency' => 'Certificate of Residency was generated.',
        'Clearance' => 'Barangay Clearance was generated.',
    ];

    public $subject;
    public $activity;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Resident $subject, $document)
    {
        $this->subject = $subject;
        $this->activity = self::DOCUMENTS[$document];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
