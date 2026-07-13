<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        $news = [];

        foreach ($countries as $country) {

            $response = Http::withoutVerifying()->get(
                'https://newsapi.org/v2/everything',
                [
                    'q'        => $country->name,
                    'language' => 'en',
                    'sortBy'   => 'publishedAt',
                    'pageSize' => 3,
                    'apiKey'   => config('services.newsapi.key'),
                ]
            );

            if ($response->successful()) {

                foreach ($response->json()['articles'] ?? [] as $article) {

                    $article['country'] = $country->name;

                    $news[] = $article;
                }
            }
        }

        return view('news.index', compact('news'));
    }
}