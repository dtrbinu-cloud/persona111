<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - EngPersona</title>
    <style>
        :root {
            --bg-main: #061d2b;
            --bg-dark: #071726;
            --panel: #0a2232;
            --line: #2b495d;
            --text: #f2f7fb;
            --muted: #9eb6c7;
            --green: #58cc02;
            --blue: #4bc3ff;
            --card: rgba(13, 39, 57, 0.86);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: linear-gradient(100deg, var(--bg-dark) 0%, var(--bg-main) 45%, var(--bg-dark) 100%);
        }

        .layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 250px minmax(460px, 1fr) 360px;
        }

        .sidebar {
            border-right: 2px solid #1e3546;
            padding: 14px;
            background: linear-gradient(180deg, #071a28 0%, #051824 100%);
        }

        .brand {
            color: var(--green);
            font-size: 24px;
            font-weight: 900;
            margin: 4px 6px 16px;
        }

        .menu { display: grid; gap: 6px; }

        .menu a {
            color: #dceaf4;
            text-decoration: none;
            border: 2px solid transparent;
            border-radius: 14px;
            padding: 9px 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 800;
        }

        .menu a.active {
            border-color: #3b7ca7;
            background: rgba(64, 125, 167, 0.2);
            color: var(--blue);
        }

        .ico {
            width: 22px;
            height: 22px;
            border: 2px solid currentColor;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 900;
        }

        .logout {
            margin-top: 12px;
        }

        .logout button {
            width: 100%;
            border: 0;
            border-radius: 10px;
            min-height: 38px;
            background: #163448;
            color: #d1e2ed;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .main {
            padding: 14px 16px 18px;
        }

        .profile-hero {
            border: 2px solid var(--line);
            border-radius: 16px;
            background: var(--card);
            padding: 16px;
            margin-bottom: 12px;
        }

        .avatar-wrap {
            height: 165px;
            border-radius: 12px;
            background: linear-gradient(180deg, #1a3547 0%, #1a3244 100%);
            border: 2px solid rgba(115, 170, 203, 0.2);
            display: grid;
            place-items: center;
            margin-bottom: 12px;
        }

        .avatar {
            width: 108px;
            height: 108px;
            border-radius: 50%;
            border: 3px dashed #58baf1;
            display: grid;
            place-items: center;
            color: #58baf1;
            font-size: 36px;
            font-weight: 800;
            background: rgba(88, 186, 241, 0.18);
        }

        .title {
            font-size: 28px;
            font-weight: 900;
            margin: 0;
        }

        .subtitle {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 15px;
        }

        .meta {
            margin: 6px 0 0;
            font-size: 13px;
            color: #c5d8e5;
        }

        .follow {
            margin-top: 10px;
            color: var(--blue);
            font-weight: 800;
            font-size: 16px;
            display: flex;
            gap: 20px;
        }

        .sec-title {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 12px;
        }

        .stat-card {
            border: 2px solid var(--line);
            border-radius: 14px;
            background: var(--card);
            padding: 12px;
        }

        .stat-val {
            font-size: 28px;
            font-weight: 900;
            margin: 0;
        }

        .stat-label {
            margin: 2px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .right {
            padding: 14px 12px 14px 0;
        }

        .top-metrics {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            color: #9ec3d9;
            font-weight: 900;
            font-size: 16px;
            margin: 2px 0 10px;
        }

        .panel {
            border: 2px solid var(--line);
            border-radius: 16px;
            background: var(--card);
            padding: 14px;
            margin-bottom: 10px;
        }

        .panel h3 {
            margin: 0 0 8px;
            font-size: 20px;
        }

        .panel p {
            margin: 0;
            color: #c2d7e5;
            font-size: 12px;
            line-height: 1.5;
        }

        .tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 12px;
            border-bottom: 2px solid #23475f;
        }

        .tabs div {
            padding: 6px 0 10px;
            text-align: center;
            font-weight: 800;
            font-size: 12px;
            color: #d6e7f2;
        }

        .tabs .active {
            color: var(--blue);
            border-bottom: 2px solid var(--blue);
            margin-bottom: -2px;
        }

        .friend {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #214258;
            padding: 10px 0;
            font-size: 13px;
            font-weight: 700;
        }

        .friend:first-of-type {
            border-top: 0;
            padding-top: 2px;
        }

        @media (max-width: 1100px) {
            .layout { grid-template-columns: 1fr; }
            .sidebar { border-right: 0; border-bottom: 2px solid #1e3546; }
            .right { padding: 0 12px 14px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">engpersona</div>
        <nav class="menu">
            <a href="{{ route('dashboard') }}"><span class="ico">HM</span> BELAJAR</a>
            <a href="{{ route('history.index') }}"><span class="ico">PK</span> PAPAN SKOR</a>
            <a href="{{ route('exercise.start') }}"><span class="ico">MS</span> MISI</a>
            <a href="{{ route('music.index') }}"><span class="ico">TK</span> TOKO</a>
            <a class="active" href="{{ route('review.index') }}"><span class="ico">PF</span> PROFIL</a>
            <a href="{{ route('history.index') }}"><span class="ico">LN</span> LAINNYA</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" class="logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </aside>

    <main class="main">
        <section class="profile-hero">
            <div class="avatar-wrap">
                <div class="avatar">{{ strtoupper(substr($user->username, 0, 1)) }}</div>
            </div>
            <h1 class="title">{{ $user->username }}</h1>
            <p class="subtitle">{{ $user->name ?? $user->username }}</p>
            <p class="meta">Bergabung {{ optional($user->created_at)->translatedFormat('F Y') ?? '-' }}</p>
            <div class="follow">
                <span>mengikuti 0</span>
                <span>diikuti 0</span>
            </div>
        </section>

        <h2 class="sec-title">Statistik</h2>
        <section class="stats-grid">
            <div class="stat-card">
                <p class="stat-val">{{ $user->streak }}</p>
                <p class="stat-label">Runtunan hari</p>
            </div>
            <div class="stat-card">
                <p class="stat-val">{{ $user->xp }}</p>
                <p class="stat-label">Total XP</p>
            </div>
            <div class="stat-card">
                <p class="stat-val">{{ $user->learning_character ? 'Ada' : 'Tidak ada' }}</p>
                <p class="stat-label">Profil belajar</p>
            </div>
            <div class="stat-card">
                <p class="stat-val">{{ $totalResults }}</p>
                <p class="stat-label">Total latihan selesai</p>
            </div>
        </section>

    </main>

    <aside class="right">
        <div class="top-metrics">
            <span>STREAK {{ $user->streak }}</span>
            <span>XP {{ $user->xp }}</span>
            <span>LEVEL {{ $user->level }}</span>
        </div>

        <section class="panel">
            <div class="tabs">
                <div class="active">MENGIKUTI</div>
                <div>PENGIKUT</div>
            </div>
            <h3>Belajar bareng teman</h3>
            <p>Belajar lebih seru dan efektif saat kamu terhubung dengan yang lain.</p>
        </section>

        <section class="panel">
            <h3>Tambah teman</h3>
            <div class="friend">
                <span>Temukan teman</span>
                <span>&gt;</span>
            </div>
            <div class="friend">
                <span>Ajak teman</span>
                <span>&gt;</span>
            </div>
        </section>
    </aside>
</div>
</body>
</html>
