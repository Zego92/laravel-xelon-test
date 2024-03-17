<?php

namespace App\Broadcasting;

use App\Events\CurrencyEvent;
use App\Models\User;
use App\Repositories\CurrencyRepository;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class CurrencyChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct(public array $response)
    {

    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join()
    {
        Log::channel('currency')->info('ololololo');
        return $this->response;
    }
}
