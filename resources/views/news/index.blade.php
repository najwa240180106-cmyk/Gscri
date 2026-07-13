@extends('layouts.app')

@section('content')

<div class="panel">

    <div class="panel-header">
        <h2>📰 Global Supply Chain News</h2>
    </div>

    <table class="table">

        <thead>
            <tr>
                <th>Country</th>
                <th>Title</th>
                <th>Source</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

        @forelse($news as $article)

            <tr>

                <td>
                    {{ $article['country'] }}
                </td>

                <td>
                    <a href="{{ $article['url'] }}" target="_blank">
                        {{ $article['title'] }}
                    </a>
                </td>

                <td>
                    {{ $article['source']['name'] ?? '-' }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y') }}
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="4" style="text-align:center;">
                    Belum ada berita.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection