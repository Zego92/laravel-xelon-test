<?php

namespace App\Http\Controllers;

use App\Broadcasting\CurrencyChannel;
use App\Events\CurrencyEvent;
use App\Repositories\CurrencyRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(public CurrencyRepository $currencyRepository)
    {
    }

    public function index()
    {
        $event = new CurrencyEvent($this->currencyRepository);

//        dd($event);
        broadcast(new CurrencyEvent($this->currencyRepository))->toOthers();
    }
}
