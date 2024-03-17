<?php

namespace App\Console\Commands;

use App\Events\CurrencyEvent;
use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Console\Command;

class GetBankCurrencyCommand extends Command
{
    public function __construct(public CurrencyRepository $currencyRepository)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-bank-currency-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting currency from open API of monobank';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        event(new CurrencyEvent($this->currencyRepository));
    }
}
