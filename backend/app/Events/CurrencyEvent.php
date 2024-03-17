<?php

namespace App\Events;

use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

class CurrencyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public CurrencyRepository $currencyRepository){}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('public.currencies');
//        return [
//            new PrivateChannel('currencies'),
//        ];
    }

    public function broadcastAs(): string
    {
        return 'currencies';
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->currencyRepository->currencyRequest(),
        ];
    }

    /**
     * @return CurrencyRepository
     */
    public function getCurrencyRepository(): CurrencyRepository
    {
        return $this->currencyRepository;
    }

}
