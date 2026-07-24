@extends('layouts.app')

@section('title', 'Latihan - EngPersona')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card ep-card">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-secondary">Soal {{ $currentIndex }} dari {{ $totalQuestions }}</small>
                    <span class="badge text-bg-primary text-uppercase">
                        @if($globalLevel > 0)
                            Level {{ $globalLevel }} - {{ $difficultyLabel }}
                        @else
                            {{ $difficultyLabel }} - Stage {{ $stage }}
                        @endif
                    </span>
                </div>
                <div class="progress mb-4" role="progressbar" aria-valuenow="{{ $progressPercent }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: {{ $progressPercent }}%"></div>
                </div>

                @if(session('feedback_message'))
                    <div class="alert alert-{{ session('feedback_type', 'info') }}">
                        {{ session('feedback_message') }}
                    </div>
                @endif

                <h4 class="fw-bold mb-4">{{ $question->question }}</h4>

                <form action="{{ route('exercise.submit') }}" method="POST">
                    @csrf

                    @if($question->option_a && $question->option_b && $question->option_c && $question->option_d)
                        @foreach (['a', 'b', 'c', 'd'] as $opt)
                            @php $value = $question->{'option_'.$opt}; @endphp
                            <label class="card mb-2 border">
                                <div class="card-body py-2 px-3">
                                    <input class="form-check-input me-2" type="radio" name="answer" value="{{ $value }}" required>
                                    {{ $value }}
                                </div>
                            </label>
                        @endforeach
                    @else
                        <input type="text" name="answer" class="form-control @error('answer') is-invalid @enderror" placeholder="Ketik jawaban..." required>
                        @error('answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @endif

                    <button class="btn btn-primary mt-4">Next</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-3 mt-lg-0">
        <div class="card ep-card">
            <div class="card-body p-3">
                <h6 class="fw-bold mb-2">Musik Saat Latihan</h6>
                @if($embedUrl)
                    <iframe
                        style="border-radius:12px"
                        src="{{ $embedUrl }}"
                        width="100%"
                        height="352"
                        frameborder="0"
                        allowfullscreen=""
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy">
                    </iframe>
                @else
                    <p class="text-secondary mb-2">Belum ada playlist Spotify tersimpan.</p>
                    <a href="{{ route('music.index') }}" class="btn btn-outline-primary btn-sm">Atur Playlist</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
