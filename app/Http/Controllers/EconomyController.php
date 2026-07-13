<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Support\Facades\Http;

class EconomyController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return view('economy.index', compact('countries'));
    }
}