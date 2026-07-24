@extends('layouts.app')

@section('title', 'Hasil Latihan - EngPersona')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card ep-card">
            <div class="card-body p-4 p-md-5">
                <h3 class="fw-bold mb-4">Hasil Latihan</h3>

                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="bg-light rounded p-3">
                            <small class="text-secondary">Skor</small>
                            <div class="fw-bold fs-4">{{ $result->score }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-light rounded p-3">
                            <small class="text-secondary">Benar</small>
                            <div class="fw-bold fs-4">{{ (int) ($result->xp / 10) }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-light rounded p-3">
                            <small class="text-secondary">Salah</small>
                            <div class="fw-bold fs-4">{{ max(10 - (int) ($result->xp / 10), 0) }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-light rounded p-3">
                            <small class="text-secondary">XP</small>
                            <div class="fw-bold fs-4">{{ $result->xp }}</div>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold">Karakter: {{ $result->character }}</h5>
                <p class="text-secondary">{{ $description }}</p>

                <h6 class="fw-bold mt-4">Rekomendasi Belajar</h6>
                <ul class="mb-4">
                    @foreach($recommendations as $recommendation)
                        <li>{{ $recommendation }}</li>
                    @endforeach
                </ul>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('exercise.start') }}" class="btn btn-primary">Latihan Lagi</a>
                    <a href="{{ route('review.index') }}" class="btn btn-outline-primary">Review Latihan</a>
                    <a href="{{ route('history.index') }}" class="btn btn-outline-secondary">Riwayat</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
