<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EngPersona</title>
    <style>
        :root {
            --bg-main: #061d2b;
            --bg-dark: #071726;
            --panel: #0a2232;
            --panel-2: #0c2738;
            --line: #2b495d;
            --text: #f2f7fb;
            --muted: #a7bccb;
            --green: #58cc02;
            --green-shadow: #47a704;
            --blue: #52c7ff;
            --heart: #ff6672;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: linear-gradient(100deg, var(--bg-dark) 0%, var(--bg-main) 45%, var(--bg-dark) 100%);
        }

        .dash {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 250px minmax(420px, 1fr) 360px;
        }

        .sidebar {
            border-right: 2px solid #1e3546;
            padding: 14px 14px 10px;
            background: linear-gradient(180deg, #071a28 0%, #051824 100%);
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .brand {
            color: var(--green);
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 0.5px;
            margin: 2px 6px 16px;
        }

        .menu {
            display: grid;
            gap: 6px;
        }

        .menu a {
            text-decoration: none;
            color: #dceaf4;
            font-size: 16px;
            font-weight: 800;
            border: 2px solid transparent;
            border-radius: 14px;
            padding: 9px 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menu .ico {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid currentColor;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 900;
            line-height: 1;
            flex: 0 0 auto;
        }

        .menu a.active {
            border-color: #3b7ca7;
            background: rgba(64, 125, 167, 0.2);
            color: var(--blue);
        }

        .sidebar-foot {
            margin-top: 12px;
        }

        .logout-btn {
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
            padding: 14px 16px 16px;
        }

        .unit-box {
            background: var(--green);
            border-radius: 14px;
            padding: 12px 14px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 14px;
        }

        .unit-top {
            font-size: 13px;
            font-weight: 800;
            opacity: 0.95;
            margin-bottom: 2px;
        }

        .unit-title {
            font-size: 16px;
            font-weight: 900;
        }

        .guide {
            background: rgba(0, 0, 0, 0.1);
            border: 3px solid rgba(0, 0, 0, 0.16);
            color: white;
            border-radius: 12px;
            min-height: 42px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .path {
            margin: 0 auto;
            max-width: 420px;
            min-height: 520px;
            display: grid;
            align-content: start;
            justify-items: center;
            gap: 10px;
            padding-top: 4px;
        }

        .track-menu {
            width: 100%;
            display: grid;
            justify-items: center;
            gap: 10px;
        }

        .start-badge {
            position: relative;
            border-radius: 10px;
            border: 3px solid #2e4f63;
            background: #132737;
            color: var(--green);
            font-size: 14px;
            font-weight: 900;
            padding: 7px 14px;
            margin-bottom: -2px;
            line-height: 1;
        }

        .start-badge::after {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -8px;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 8px solid #2e4f63;
        }

        .level-node {
            text-decoration: none;
            border: 9px solid #2f4759;
            border-radius: 999px;
            color: #6f8798;
            width: 82px;
            height: 82px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 900;
            text-transform: uppercase;
            background: #3c5668;
            box-shadow: inset 0 -9px 0 #334b5c;
        }

        .level-node.active {
            background: var(--green);
            border-color: #2e4558;
            color: #ffffff;
            box-shadow:
                0 0 0 2px #3a566a,
                inset 0 -9px 0 var(--green-shadow);
        }

        .level-node.lock {
            border-radius: 14px;
            width: 70px;
            height: 70px;
            font-size: 26px;
        }

        .level-node.trophy {
            opacity: 0.75;
        }

        .level-node:hover {
            border-color: #62d3ff;
            color: #e8f7ff;
        }

        .level-info {
            display: grid;
            justify-items: center;
            gap: 4px;
        }

        .level-label {
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.8px;
            color: #a3c1d4;
            text-transform: uppercase;
        }

        .level-number {
            font-size: 10px;
            font-weight: 800;
            color: #7ea8c0;
        }

        .level-node.stage-2,
        .level-node.stage-4,
        .level-node.stage-6,
        .level-node.stage-8,
        .level-node.stage-10 {
            margin-right: 52px;
        }

        .level-node.stage-3,
        .level-node.stage-5,
        .level-node.stage-7,
        .level-node.stage-9,
        .level-node.stage-11 {
            margin-left: 52px;
        }

        .right {
            padding: 14px 12px 14px 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .top-stats {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin: 2px 0 10px;
            color: #9ec3d9;
            font-weight: 900;
            font-size: 16px;
        }

        .top-stats .heart {
            color: var(--heart);
        }

        .panel {
            border: 2px solid var(--line);
            border-radius: 16px;
            background: rgba(8, 32, 48, 0.72);
            padding: 14px 14px;
            margin-bottom: 10px;
        }

        .panel h3 {
            margin: 0 0 8px;
            font-size: 20px;
        }

        .panel p {
            margin: 0;
            color: #bfd2df;
            font-size: 12px;
            line-height: 1.45;
        }

        .panel .row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 4px;
        }

        .quest-head {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 10px;
        }

        .quest-head .link {
            text-decoration: none;
            color: var(--blue);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .progress {
            height: 12px;
            background: #425769;
            border-radius: 999px;
            overflow: hidden;
            margin-top: 4px;
        }

        .progress > div {
            height: 100%;
            width: {{ min(($user->xp % 100), 100) }}%;
            background: linear-gradient(90deg, #4cc7ff 0%, #57d2ff 100%);
        }

        .metric {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .metric .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid currentColor;
            display: inline-block;
        }

        .panel-cta {
            display: grid;
            gap: 8px;
            margin-top: 10px;
        }

        .btn {
            text-decoration: none;
            text-align: center;
            border-radius: 14px;
            min-height: 46px;
            display: grid;
            place-items: center;
            font-size: 18px;
            font-weight: 900;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .btn.green {
            background: #8fd231;
            color: #183312;
            box-shadow: inset 0 -6px 0 #75b026;
        }

        .btn.blue {
            background: #4ab0e0;
            color: #062033;
            box-shadow: inset 0 -6px 0 #358fbe;
        }

        .alert {
            margin-bottom: 8px;
            border-radius: 10px;
            padding: 7px 10px;
            font-weight: 600;
            font-size: 12px;
        }

        .alert.info {
            background: rgba(81, 177, 223, 0.2);
            border: 1px solid rgba(81, 177, 223, 0.5);
            color: #b8e6ff;
        }

        .alert.success {
            background: rgba(88, 204, 2, 0.2);
            border: 1px solid rgba(88, 204, 2, 0.45);
            color: #d9ffc0;
        }

        @media (max-width: 1400px) {
            .dash {
                grid-template-columns: 220px 1fr 320px;
            }

            .brand { font-size: 22px; }
            .menu a { font-size: 14px; }
            .unit-title { font-size: 14px; }
            .panel h3 { font-size: 18px; }
            .btn { font-size: 16px; min-height: 42px; }
        }

        @media (max-width: 1024px) {
            .dash {
                grid-template-columns: 1fr;
            }

            .sidebar {
                border-right: 0;
                border-bottom: 2px solid #1e3546;
                position: static;
                height: auto;
                overflow: visible;
            }

            .right {
                padding: 0 20px 20px;
                position: static;
                height: auto;
                overflow: visible;
            }

            .main {
                padding-top: 10px;
            }

            .level-node.stage-2,
            .level-node.stage-4,
            .level-node.stage-6,
            .level-node.stage-8,
            .level-node.stage-10,
            .level-node.stage-3,
            .level-node.stage-5,
            .level-node.stage-7,
            .level-node.stage-9,
            .level-node.stage-11 {
                margin-left: 0;
                margin-right: 0;
            }

        }
    </style>
</head>
<body>
<div class="dash">
    <aside class="sidebar">
        <div class="brand">engpersona</div>
        <nav class="menu">
            <a class="active" href="{{ route('dashboard') }}"><span class="ico">HM</span> BELAJAR</a>
            <a href="{{ route('history.index') }}"><span class="ico">PK</span> PAPAN SKOR</a>
            <a href="{{ route('exercise.start') }}"><span class="ico">MS</span> MISI</a>
            <a href="{{ route('music.index') }}"><span class="ico">TK</span> Musik</a>
            <a href="{{ route('review.index') }}"><span class="ico">PF</span> PROFIL</a>
            <a href="{{ route('history.index') }}"><span class="ico">LN</span> LAINNYA</a>
        </nav>
        <div class="sidebar-foot">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </aside>

    <main class="main">
        @if(session('status'))
            <div class="alert info">{{ session('status') }}</div>
        @endif
        @if(session('exercise_message'))
            <div class="alert success">{{ session('exercise_message') }}</div>
        @endif

        <section class="unit-box">
            <div>
                <div class="unit-top">&larr; BAGIAN {{ $user->level }}, UNIT 1</div>
                <div class="unit-title">Halo {{ $user->username }}, siap belajar?</div>
            </div>
            <div class="guide">GUIDE BOOK</div>
        </section>

        <section class="path">
            <div class="track-menu">
                @foreach($trackLevels as $level)
                    @if($loop->first)
                        <span class="start-badge">MULAI</span>
                    @endif
                    @php
                        $nodeClass = 'level-node stage-'.$loop->iteration;
                        $symbol = '*';
                        if ($loop->first) {
                            $nodeClass .= ' active';
                        } elseif ($loop->iteration % 10 === 0) {
                            $nodeClass .= ' trophy';
                            $symbol = 'T';
                        } elseif ($loop->iteration % 5 === 0) {
                            $nodeClass .= ' lock';
                            $symbol = 'L';
                        }

                        $difficultyLabel = $level >= 16 ? 'Hard' : ($level >= 5 ? 'Medium' : 'Easy');
                    @endphp
                    <div class="level-info">
                        <div class="level-label">{{ $difficultyLabel }}</div>
                        <a href="{{ route('exercise.start', ['level' => $level]) }}" class="{{ $nodeClass }}" title="Level {{ $level }}">
                            {{ $symbol }}
                        </a>
                        <div class="level-number">LEVEL {{ $level }}</div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <aside class="right">
        <div class="top-stats">
            <span class="metric"><span class="dot"></span>{{ $user->streak }}</span>
            <span class="metric"><span class="dot"></span>{{ $user->xp }}</span>
            <span class="heart metric"><span class="dot"></span>{{ $latestResult ? max(1, (int) round($latestResult->score / 25)) : 4 }}</span>
        </div>

        <section class="panel">
            <h3>Buka Papan Skor!</h3>
            <p>Selesaikan beberapa pelajaran lagi untuk mulai berkompetisi.</p>
        </section>

        <section class="panel">
            <div class="quest-head">
                <h3 style="margin:0;">Misi Harian</h3>
                <a class="link" href="{{ route('review.index') }}">Lihat Semua</a>
            </div>
            <div class="row">
                <span style="font-size:28px;">XP</span>
                <div>
                    <p style="font-weight:800; color:#e8f4ff;">Dapatkan 10 XP</p>
                    <div class="progress"><div></div></div>
                </div>
            </div>
        </section>

        <section class="panel">
            <h3>Profil Belajar</h3>
            <p>Karakter: <strong>{{ $user->learning_character ?? 'Belum ditentukan' }}</strong></p>
            <p style="margin-top:8px;">Hasil terakhir: <strong>{{ $latestResult ? $latestResult->score : 0 }}</strong></p>
            <div class="panel-cta">
                <a class="btn green" href="{{ route('review.index') }}">Lihat Profil</a>
                <a class="btn blue" href="{{ route('exercise.start') }}">Mulai</a>
            </div>
        </section>
    </aside>
</div>
</body>
</html>
