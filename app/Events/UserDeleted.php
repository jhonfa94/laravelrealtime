<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserDeleted implements ShouldBroadcast
{
    // Se elimina el SerializesModels porque nos genera error en la eliminación
    use Dispatchable, InteractsWithSockets;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Log::debug("{$this->message}");# SE VE EL LOG DE LA ACTIVIDAD
        // Log::debug("{$this->type}");
        // Log::debug("User deleted {$this->user->name}");
        return new Channel('users'); // Evento Público
        // return new PrivateChannel('notifications'); // EVENTO PRIVADO
    }
}
