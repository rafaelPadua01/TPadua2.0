<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Noticias;

class SendNoticia implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $noticia;    
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(Noticias $noticia)
    {
        //
        $this->noticia = $noticia;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notify-received'); //Define o nome do novo Canal
    }
    public function broadcastWith()
    {
        return $this->noticia->toArray();
    }
}
