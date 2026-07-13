<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Port;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Countries
       $countries = Country::orderByDesc('score')
    ->take(5)
    ->get();

$weatherCountries = Country::orderBy('name')
    ->take(5)
    ->get();

        // Statistik
        $totalCountries = Country::count();

        $totalPorts = Port::count();

        $lowRisk = Country::where('risk', 'LOW')->count();

        $mediumRisk = Country::where('risk', 'MEDIUM')->count();

        $highRisk = Country::where('risk', 'HIGH')->count();

        // Rata-rata ekonomi
        $avgGdp = Country::avg('gdp');

        $avgInflation = Country::avg('inflation');
        // Ambil 3 berita terbaru
$response = Http::withoutVerifying()->get(
    'https://newsapi.org/v2/everything',
    [
        'q'        => 'global supply chain',
        'language' => 'en',
        'sortBy'   => 'publishedAt',
        'pageSize' => 3,
        'apiKey'   => config('services.newsapi.key'),
    ]
);

$news = $response->json()['articles'] ?? [];
return view('dashboard', compact(
    'countries',
    'weatherCountries',
    'totalCountries',
    'totalPorts',
    'lowRisk',
    'mediumRisk',
    'highRisk',
    'avgGdp',
    'avgInflation',
    'news'
));
    }
}