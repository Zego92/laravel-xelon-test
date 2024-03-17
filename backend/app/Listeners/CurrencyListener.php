<?php

namespace App\Listeners;

use App\Broadcasting\CurrencyChannel;
use App\Events\CurrencyEvent;
use App\Models\Currency;
use Illuminate\Support\Facades\Log;
use Throwable;

class CurrencyListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CurrencyEvent $event): void
    {
        try {
            $response = $event->getCurrencyRepository()->currencyRequest();
            foreach ($response as $item) {
                Currency::upsert($item, ['currencyCodeA', 'currencyCodeB']);
            }
            Log::channel('currency')->info('Sended');
        } catch (Throwable $exception) {
            Log::channel('currency')->info($exception->getMessage());
        }
    }
}
