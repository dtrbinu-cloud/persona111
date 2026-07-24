@extends('layouts.app')

@section('title', 'Musik - EngPersona')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card ep-card mb-4">
            <div class="card-body p-4 p-md-5">
                <h2 class="fw-bold mb-2">Play Musik</h2>
                <p class="text-secondary mb-4">Tempel link playlist Spotify, lalu putar langsung dari halaman ini.</p>

                <form action="{{ route('music.update') }}" method="POST" class="d-grid gap-3">
                    @csrf
                    <div>
                        <label for="spotify_playlist_url" class="form-label">Link Playlist Spotify</label>
                        <input
                            id="spotify_playlist_url"
                            type="text"
                            name="spotify_playlist_url"
                            value="{{ old('spotify_playlist_url', $playlistUrl) }}"
                            class="form-control @error('spotify_playlist_url') is-invalid @enderror"
                            placeholder="https://open.spotify.com/playlist/... atau spotify:playlist:..."
                            required
                        >
                        <small class="text-secondary">Format yang didukung: link playlist, link embed playlist, URI spotify, atau ID playlist.</small>
                        @error('spotify_playlist_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Playlist</button>
                </form>
            </div>
        </div>

        <div class="card ep-card">
            <div class="card-body p-3 p-md-4">
                @if($embedUrl)
                    <iframe
                        style="border-radius:12px"
                        src="{{ $embedUrl }}"
                        width="100%"
                        height="380"
                        frameborder="0"
                        allowfullscreen=""
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy">
                    </iframe>
                @else
                    <div class="text-secondary">
                        Belum ada playlist. Masukkan link playlist Spotify dulu.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
