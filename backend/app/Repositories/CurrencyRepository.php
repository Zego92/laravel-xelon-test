<?php


namespace App\Repositories;


use App\Models\Currency;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use http\Exception\RuntimeException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use LaravelIdea\Helper\App\Models\_IH_Currency_C;
use Throwable;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function all(): Collection|array|_IH_Currency_C
    {
        return Currency::all();
    }

    public function currencyRequest(): array
    {
        try {
            $request = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->get('https://api.monobank.ua/bank/currency');
            if ($request->status() !== Response::HTTP_OK) {
                return $this->all();
            } else {
                return $request->json();
            }
        } catch (Throwable $exception) {
            throw new RuntimeException($exception->getMessage());
        }

    }

    public function upsert($currencyData, Currency $currency)
    {
        $currency->upsert($currencyData, ['currencyCodeA', 'currencyCodeB']);
    }
}
