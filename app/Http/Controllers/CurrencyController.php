<?php

namespace App\Http\Controllers;

use App\CurrencyService;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(){
        $currencies = Currency::get();
        return view('currency', [
            'currencies' => $currencies
        ]);
    }

    public function reload(){
        CurrencyService::refresh();
        return redirect()->route('index')->with('success', 'Wszystkie dane zostały zaaktualizowane');
    }
}
