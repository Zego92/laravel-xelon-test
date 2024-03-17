<?php


namespace App\Repositories\Interfaces;

use App\Models\Currency;

interface CurrencyRepositoryInterface
{
    public function upsert($currencyData, Currency $currency);

    public function all();
}
