<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class NbpApi implements CurrencyApiInterface
{

    private const URL = 'http://api.nbp.pl/api/exchangerates/tables/A/today/?format=json';

    function fetch()
    {
        try{
            $response = Http::get(self::URL);
            $content = $response->json();
            return [
                'status' => $response->status(),
                'content' => $content[0]['rates'],
            ];
        }catch (\Exception  $e){
            return [
                'status' => 401,
                'content' => 'No results found',
            ];
        }
    }
}
