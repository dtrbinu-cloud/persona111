<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function show(Request $request, ?Result $result = null): View
    {
        $user = $request->user();
        $result = $result?->user_id === $user->id ? $result : $user->results()->latest()->firstOrFail();

        [$description, $recommendations] = $this->characterMeta($result->character);

        return view('result.show', [
            'result' => $result,
            'description' => $description,
            'recommendations' => $recommendations,
        ]);
    }

    public function review(Request $request): View
    {
        $user = $request->user();

        $totalResults = Result::query()
            ->where('user_id', $user->id)
            ->count();

        return view('review.index', [
            'user' => $user,
            'totalResults' => $totalResults,
        ]);
    }

    public function history(Request $request): View
    {
        $results = Result::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('history.index', [
            'results' => $results,
        ]);
    }

    private function characterMeta(string $character): array
    {
        return match ($character) {
            'Grammar Learner' => [
                'Kamu lebih mudah memahami Bahasa Inggris melalui grammar.',
                ['Belajar tenses', 'Belajar struktur kalimat'],
            ],
            'Vocabulary Learner' => [
                'Kamu cepat menangkap arti kata dan kosakata baru.',
                ['Hafalkan kata baru', 'Gunakan flashcard'],
            ],
            default => [
                'Kamu lebih mudah memahami Bahasa Inggris melalui konteks.',
                ['Membaca teks Inggris', 'Latihan dialog'],
            ],
        };
    }
}
