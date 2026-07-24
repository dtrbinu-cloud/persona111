<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MusicController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $playlistUrl = (string) ($user->spotify_playlist_url ?? '');

        return view('music.index', [
            'playlistUrl' => $playlistUrl,
            'embedUrl' => $this->buildEmbedUrl($playlistUrl),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'spotify_playlist_url' => ['required', 'string', 'max:255'],
        ]);

        $rawInput = trim($validated['spotify_playlist_url']);
        $playlistId = $this->extractPlaylistId($rawInput);
        if (! $playlistId) {
            return back()
                ->withErrors(['spotify_playlist_url' => 'Format tidak dikenali. Pakai link playlist Spotify, link embed playlist, URI spotify, atau ID playlist.'])
                ->withInput();
        }

        $user = $request->user();
        // Simpan dalam format canonical supaya konsisten dan mudah diproses.
        $user->spotify_playlist_url = 'https://open.spotify.com/playlist/'.$playlistId;
        $user->save();

        return redirect()
            ->route('music.index')
            ->with('status', 'Playlist berhasil disimpan.');
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

        // Support ID mentah: 22 karakter base62.
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
