<!doctype html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EngPersona</title>
    <style>
        :root {
            --bg: #f2f2f2;
            --text-dark: #4b4f54;
            --text-soft: #9ea3a7;
            --brand-green: #59cc02;
            --brand-green-shadow: #4daa06;
            --brand-blue: #1cb0f6;
            --line: #d8d8d8;
            --btn-gray: #efefef;
            --btn-gray-border: #d2d2d2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--text-dark);
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            max-width: 1260px;
            width: 100%;
            margin: 0 auto;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            color: var(--brand-green);
            font-size: 30px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-decoration: none;
        }

        .lang-switch {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-soft);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.4px;
        }

        .lang-switch a {
            color: var(--text-soft);
            text-decoration: none;
            padding: 5px 8px;
            border-radius: 8px;
        }

        .lang-switch a.active {
            color: #6f7377;
            background: #e6e6e6;
        }

        .hero {
            max-width: 1260px;
            width: 100%;
            margin: auto;
            padding: 16px 24px 34px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            align-items: center;
        }

        .illustration {
            min-height: 460px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .phone {
            width: 240px;
            height: 350px;
            border-radius: 38px;
            background: linear-gradient(170deg, #83de35 0%, #59cc02 70%);
            transform: rotate(-33deg);
            position: absolute;
            box-shadow: 0 20px 45px rgba(80, 160, 20, 0.25);
        }

        .coin {
            position: absolute;
            width: 68px;
            height: 68px;
            border-radius: 999px;
            background: #ffd600;
            box-shadow: inset 0 -6px 0 #f5bc00;
        }

        .coin.c1 { top: 150px; left: 42%; }
        .coin.c2 { top: 220px; left: 54%; width: 58px; height: 58px; }
        .coin.c3 { top: 272px; left: 36%; width: 52px; height: 52px; }

        .owl {
            position: absolute;
            right: 10%;
            top: 26%;
            width: 185px;
            height: 185px;
            border-radius: 50%;
            background: #59cc02;
            box-shadow: inset 0 -10px 0 #4daa06;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 84px;
        }

        .hero-copy {
            max-width: 460px;
            justify-self: center;
        }

        h1 {
            margin: 0 0 32px;
            text-align: center;
            font-size: clamp(30px, 2.8vw, 52px);
            line-height: 1.2;
            font-weight: 800;
            color: var(--text-dark);
        }

        .cta {
            display: grid;
            gap: 16px;
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-height: 62px;
            border-radius: 16px;
            text-decoration: none;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 0.4px;
        }

        .btn-primary {
            background: var(--brand-green);
            color: white;
            box-shadow: 0 5px 0 var(--brand-green-shadow);
        }

        .btn-secondary {
            color: var(--brand-blue);
            border: 3px solid var(--btn-gray-border);
            background: var(--btn-gray);
        }

        .showcase {
            margin-top: auto;
            border-top: 2px solid var(--line);
            background: #f4f4f4;
            padding: 14px 12px;
            display: flex;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
            color: #7d7d7d;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 14px;
        }

        @media (max-width: 960px) {
            .hero {
                grid-template-columns: 1fr;
                gap: 8px;
                padding-bottom: 18px;
            }

            .illustration {
                min-height: 300px;
                transform: scale(0.82);
            }

            .hero-copy {
                width: 100%;
                max-width: 520px;
            }

            .btn {
                font-size: 20px;
                min-height: 54px;
            }
        }
    </style>
</head>
<body>
<div class="page">
    <header class="header">
        <a href="{{ route('landing') }}" class="logo">engpersona</a>
        <div class="lang-switch">
            <span>{{ $copy['site_language'] }}:</span>
            <a href="{{ route('language.switch', ['lang' => 'id']) }}" class="{{ $lang === 'id' ? 'active' : '' }}">Indonesia</a>
            <a href="{{ route('language.switch', ['lang' => 'en']) }}" class="{{ $lang === 'en' ? 'active' : '' }}">English</a>
        </div>
    </header>

    <main class="hero">
        <section class="illustration" aria-hidden="true">
            <div class="phone"></div>
            <div class="coin c1"></div>
            <div class="coin c2"></div>
            <div class="coin c3"></div>
            <div class="owl">🦉</div>
        </section>

        <section class="hero-copy">
            <h1>{{ $copy['headline'] }}</h1>
            <div class="cta">
                <a href="{{ route('register') }}" class="btn btn-primary">{{ $copy['start'] }}</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">{{ $copy['have_account'] }}</a>
            </div>
        </section>
    </main>

    <footer class="showcase">
        <span>{{ $copy['showcase_1'] }}</span>
        <span>{{ $copy['showcase_2'] }}</span>
    </footer>
</div>
</body>
</html>
