@extends('layouts.app')

@section('title', 'Riwayat Latihan - EngPersona')

@section('content')
<div class="card ep-card">
    <div class="card-body p-4">
        <h3 class="fw-bold mb-3">Riwayat Latihan</h3>

        @if($results->count() === 0)
            <div class="alert alert-info mb-0">Belum ada riwayat latihan.</div>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Skor</th>
                        <th>XP</th>
                        <th>Karakter Belajar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->date->format('d M Y') }}</td>
                            <td>{{ $result->score }}</td>
                            <td>{{ $result->xp }}</td>
                            <td>{{ $result->character }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $results->links() }}
        @endif
    </div>
</div>
@endsection
