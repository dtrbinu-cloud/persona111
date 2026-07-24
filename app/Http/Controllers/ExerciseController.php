<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use App\Models\WrongAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ExerciseController extends Controller
{
    public function start(Request $request): RedirectResponse
    {
        $globalLevel = max((int) $request->query('level', 0), 0);
        if ($globalLevel > 0) {
            [$difficulty, $stage] = $this->mapDifficultyAndStageFromLevel($globalLevel);
        } else {
            $difficulty = strtolower((string) $request->query('difficulty', 'easy'));
            if (! in_array($difficulty, ['easy', 'medium', 'hard'], true)) {
                $difficulty = 'easy';
            }

            $stage = max((int) $request->query('stage', 1), 1);
        }

        $questionIds = $this->resolveQuestionIds($difficulty, $stage);

        if (count($questionIds) === 0) {
            return redirect()->route('dashboard')->with('status', 'Soal untuk '.$this->difficultyLabel($difficulty).' level '.$stage.' belum tersedia.');
        }

        $request->session()->put('exercise', [
            'question_ids' => $questionIds,
            'difficulty' => $difficulty,
            'stage' => $stage,
            'global_level' => $globalLevel > 0 ? $globalLevel : null,
            'current_index' => 0,
            'correct_count' => 0,
            'wrong_count' => 0,
            'xp_earned' => 0,
            'grammar_score' => 0,
            'vocabulary_score' => 0,
            'context_score' => 0,
            'wrong_question_ids' => [],
            'result_id' => null,
        ]);

        return redirect()->route('exercise.show');
    }

    private function resolveQuestionIds(string $difficulty, int $stage): array
    {
        if (Schema::hasColumn('questions', 'difficulty') && Schema::hasColumn('questions', 'stage')) {
            return Question::query()
                ->where('difficulty', $difficulty)
                ->where('stage', $stage)
                ->inRandomOrder()
                ->pluck('id')
                ->values()
                ->all();
        }

        // Fallback untuk DB lama: mapping difficulty ke type, lalu pecah per 3 soal per level.
        $type = match ($difficulty) {
            'medium' => 'vocabulary',
            'hard' => 'context',
            default => 'grammar',
        };

        $allIds = Question::query()
            ->where('type', $type)
            ->orderBy('id')
            ->pluck('id')
            ->values()
            ->all();

        $chunks = array_chunk($allIds, 3);
        $questionIds = $chunks[$stage - 1] ?? [];
        shuffle($questionIds);

        return $questionIds;
    }

    public function show(Request $request): RedirectResponse|View
    {
        $exercise = $request->session()->get('exercise');
        if (! $exercise) {
            return redirect()->route('exercise.start');
        }

        $currentIndex = (int) $exercise['current_index'];
        $questionIds = $exercise['question_ids'];
        $totalQuestions = count($questionIds);

        if ($currentIndex >= $totalQuestions) {
            return redirect()->route('result.show');
        }

        $question = Question::findOrFail($questionIds[$currentIndex]);
        $progressPercent = (int) floor(($currentIndex / max($totalQuestions, 1)) * 100);

        return view('exercise.index', [
            'question' => $question,
            'currentIndex' => $currentIndex + 1,
            'totalQuestions' => $totalQuestions,
            'progressPercent' => $progressPercent,
            'difficultyLabel' => $this->difficultyLabel((string) ($exercise['difficulty'] ?? 'easy')),
            'stage' => (int) ($exercise['stage'] ?? 1),
            'globalLevel' => (int) ($exercise['global_level'] ?? 0),
            'embedUrl' => $this->buildEmbedUrl((string) ($request->user()->spotify_playlist_url ?? '')),
        ]);
    }

    public function submit(Request $request): RedirectResponse
    {
        $exercise = $request->session()->get('exercise');
        if (! $exercise) {
            return redirect()->route('exercise.start');
        }

        $validated = $request->validate([
            'answer' => ['required', 'string'],
        ]);

        $currentIndex = (int) $exercise['current_index'];
        $questionIds = $exercise['question_ids'];
        $totalQuestions = count($questionIds);

        if ($currentIndex >= $totalQuestions) {
            return redirect()->route('result.show');
        }

        $question = Question::findOrFail($questionIds[$currentIndex]);

        $userAnswer = $this->normalizeAnswer($validated['answer']);
        $correctAnswer = $this->normalizeAnswer($question->answer);
        $isCorrect = $userAnswer === $correctAnswer;

        if ($isCorrect) {
            $exercise['correct_count'] += 1;
            $exercise['xp_earned'] += 10;
            $scoreKey = $question->type.'_score';
            $exercise[$scoreKey] = ($exercise[$scoreKey] ?? 0) + 1;
        } else {
            $exercise['wrong_count'] += 1;
            if (! in_array($question->id, $exercise['wrong_question_ids'], true)) {
                $exercise['wrong_question_ids'][] = $question->id;
            }
        }

        $exercise['current_index'] += 1;
        $request->session()->put('exercise', $exercise);

        if ($exercise['current_index'] >= $totalQuestions) {
            $result = $this->finalizeExercise($request);
            $request->session()->flash('exercise_message', 'Latihan selesai.');

            return redirect()->route('result.show', ['result' => $result->id]);
        }

        if ($isCorrect) {
            return redirect()->route('exercise.show')->with([
                'feedback_type' => 'success',
                'feedback_message' => 'Benar! +10 XP',
            ]);
        }

        return redirect()->route('exercise.show')->with([
            'feedback_type' => 'danger',
            'feedback_message' => 'Salah! Jawaban benar adalah: '.$question->answer,
        ]);
    }

    private function finalizeExercise(Request $request): Result
    {
        $exercise = $request->session()->get('exercise');
        $user = $request->user();
        $totalQuestions = max(count($exercise['question_ids']), 1);
        $score = (int) round(($exercise['correct_count'] / $totalQuestions) * 100);
        $character = $this->determineCharacter(
            (int) $exercise['grammar_score'],
            (int) $exercise['vocabulary_score'],
            (int) $exercise['context_score']
        );

        $result = Result::create([
            'user_id' => $user->id,
            'score' => $score,
            'xp' => $exercise['xp_earned'],
            'grammar_score' => $exercise['grammar_score'],
            'vocabulary_score' => $exercise['vocabulary_score'],
            'context_score' => $exercise['context_score'],
            'character' => $character,
            'date' => now()->toDateString(),
        ]);

        $user->xp += (int) $exercise['xp_earned'];
        $user->level = (int) floor($user->xp / 100) + 1;
        $user->learning_character = $character;
        $user->save();

        foreach ($exercise['wrong_question_ids'] as $questionId) {
            WrongAnswer::firstOrCreate([
                'user_id' => $user->id,
                'question_id' => $questionId,
            ]);
        }

        $exercise['result_id'] = $result->id;
        $request->session()->put('exercise', $exercise);

        return $result;
    }

    private function determineCharacter(int $grammarScore, int $vocabularyScore, int $contextScore): string
    {
        $scores = [
            'Grammar Learner' => $grammarScore,
            'Vocabulary Learner' => $vocabularyScore,
            'Context Learner' => $contextScore,
        ];

        arsort($scores);

        return array_key_first($scores);
    }

    private function normalizeAnswer(string $answer): string
    {
        return strtolower(trim($answer));
    }

    private function difficultyLabel(string $difficulty): string
    {
        return match ($difficulty) {
            'medium' => 'Medium',
            'hard' => 'Hard',
            default => 'Easy',
        };
    }

    private function mapDifficultyAndStageFromLevel(int $level): array
    {
        if ($level >= 16) {
            return ['hard', $level - 15];
        }

        if ($level >= 5) {
            return ['medium', $level - 4];
        }

        return ['easy', $level];
    }

    private function buildEmbedUrl(string $url): ?string
    {
        $playlistId = $this->extractPlaylistId($url);
        if (! $playlistId) {
            return null;
        }

        return 'https://open.spotify.com/embed/playlist/'.$playlistId.'?utm_source=generator';
    }

    private function extractPlaylistId(string $url): ?string
    {
        $url = trim($url);
        if ($url === '') {
            return null;
        }

        if (preg_match('/^[a-zA-Z0-9]{22}$/', $url)) {
            return $url;
        }

        if (preg_match('/spotify:playlist:([a-zA-Z0-9]{22})/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('#open\.spotify\.com/(?:embed/)?playlist/([a-zA-Z0-9]{22})#', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
