<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // Laravel Reverb supports instant

class TeachersImportEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $status;
    public $message;

    public function __construct(string $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    /*public function broadcastOn()
    {
       // return ['teacher-import-channel'];
        return new Channel('teacher-import-channel');
    }

    public function broadcastAs()
    {
        return 'TeachersImportEvent';
    }
    */

    public function broadcastOn(): Channel
    {
        echo "broadcastOn: ".$this->message."\n";
        return new Channel('teachersImport');
    }
}



