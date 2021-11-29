<?php

namespace App;

use App\Http\Controllers\NbpApi;
use App\Models\Currency;

class CurrencyService
{
    public static function refresh(){
        $currencyList = new NbpApi();
        $response = $currencyList->fetch();
        foreach ($response['content'] as $result){
            $currency = Currency::where('currency_code',$result['code'])->first();
            if($currency){
                Currency::create([
                    'name' => $result['currency'],
                    'currency_code' => $result['code'],
                    'exchange_rate' => $result['mid']
                ]);
            }else{
                Currency::update([
                    'exchange_rate' => $result['mid']
                ]);
            }
        }
    }
}
