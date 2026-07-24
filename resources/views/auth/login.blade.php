<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - EngPersona</title>
    <style>
        :root {
            --bg-a: #08151f;
            --bg-b: #0b2634;
            --panel: #1a303f;
            --panel-border: #345167;
            --text-main: #e8f4ff;
            --text-muted: #668399;
            --brand: #4cbff6;
            --brand-2: #32a8e8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-main);
            background:
                radial-gradient(1000px 500px at 20% 100%, rgba(20, 93, 122, 0.3) 0%, rgba(20, 93, 122, 0) 60%),
                linear-gradient(100deg, var(--bg-a) 0%, var(--bg-b) 50%, var(--bg-a) 100%);
        }

        .screen {
            position: relative;
            min-height: 100vh;
            padding: 28px 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-link {
            position: absolute;
            top: 26px;
            left: 32px;
            text-decoration: none;
            color: #607b8f;
            font-size: 40px;
            line-height: 1;
            font-weight: 300;
        }

        .register-link {
            position: absolute;
            top: 32px;
            right: 36px;
            text-decoration: none;
            color: var(--brand);
            border: 2px solid rgba(94, 134, 160, 0.5);
            border-radius: 20px;
            padding: 14px 28px;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 0.8px;
        }

        .card {
            width: 100%;
            max-width: 780px;
            padding: 18px 10px;
        }

        .title {
            text-align: center;
            margin: 0 0 34px;
            font-size: 52px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .input-wrap {
            position: relative;
            margin-bottom: 18px;
        }

        .input {
            width: 100%;
            height: 88px;
            border-radius: 24px;
            border: 3px solid var(--panel-border);
            background: rgba(36, 58, 73, 0.65);
            color: var(--text-main);
            padding: 0 28px;
            font-size: 44px;
            outline: none;
        }

        .input::placeholder {
            color: #d1dfeb;
            opacity: 1;
        }

        .forgot {
            position: absolute;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            text-decoration: none;
            color: #607b8f;
            font-weight: 700;
            font-size: 36px;
        }

        .btn-login {
            width: 100%;
            margin-top: 18px;
            height: 92px;
            border: 0;
            border-radius: 30px;
            background: linear-gradient(180deg, var(--brand) 0%, var(--brand-2) 100%);
            color: #082135;
            font-size: 40px;
            font-weight: 900;
            letter-spacing: 2px;
            cursor: pointer;
            box-shadow: 0 8px 0 rgba(16, 109, 152, 0.9);
        }

        .divider {
            margin: 46px 0 30px;
            display: flex;
            align-items: center;
            gap: 18px;
            color: #5c788d;
            font-weight: 800;
            justify-content: center;
            font-size: 36px;
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 2px;
            flex: 1;
            background: #335267;
        }

        .social-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 36px;
        }

        .social {
            border: 3px solid #345167;
            border-radius: 30px;
            height: 88px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            text-decoration: none;
            color: #4d79db;
            font-size: 36px;
            font-weight: 900;
            letter-spacing: 1px;
            background: rgba(6, 20, 29, 0.35);
        }

        .google-mark {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: conic-gradient(#ea4335 0 25%, #fbbc05 25% 50%, #34a853 50% 75%, #4285f4 75% 100%);
        }

        .meta {
            margin: 0;
            text-align: center;
            color: var(--text-muted);
            font-size: 26px;
            line-height: 1.5;
        }

        .meta + .meta {
            margin-top: 18px;
        }

        .meta b {
            color: #8ea6b8;
            font-weight: 700;
        }

        .error-box {
            margin-bottom: 14px;
            border: 1px solid #8a3a48;
            background: rgba(138, 58, 72, 0.25);
            color: #ffb7c2;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 20px;
        }

        @media (max-width: 992px) {
            .screen {
                padding: 18px;
            }

            .close-link {
                top: 10px;
                left: 14px;
                font-size: 30px;
            }

            .register-link {
                top: 12px;
                right: 14px;
                padding: 8px 14px;
                border-radius: 12px;
                font-size: 14px;
            }

            .card {
                max-width: 540px;
                padding: 58px 0 10px;
            }

            .title {
                margin-bottom: 18px;
                font-size: 42px;
            }

            .input {
                height: 58px;
                border-width: 2px;
                border-radius: 14px;
                padding: 0 14px;
                font-size: 26px;
            }

            .forgot {
                right: 12px;
                font-size: 18px;
            }

            .btn-login {
                height: 60px;
                border-radius: 16px;
                font-size: 24px;
                letter-spacing: 1px;
            }

            .divider {
                margin: 24px 0 18px;
                font-size: 18px;
            }

            .social {
                border-width: 2px;
                height: 58px;
                border-radius: 16px;
                font-size: 20px;
            }

            .google-mark {
                width: 20px;
                height: 20px;
            }

            .meta {
                font-size: 14px;
            }

            .error-box {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="screen">
    <a href="{{ route('landing') }}" class="close-link" aria-label="Kembali">&times;</a>
    <a href="{{ route('register') }}" class="register-link">DAFTAR</a>

    <div class="card">
        <h1 class="title">Masuk</h1>

        @if(session('status'))
            <div class="error-box">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="error-box">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="input-wrap">
                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    class="input"
                    placeholder="Email atau nama pengguna"
                    required
                >
            </div>
            <div class="input-wrap">
                <input
                    type="password"
                    name="password"
                    class="input"
                    placeholder="Kata sandi"
                    required
                >
                <a href="#" class="forgot">LUPA?</a>
            </div>
            <button class="btn-login" type="submit">MASUK</button>
        </form>

        <div class="divider">ATAU</div>

        <div class="social-grid">
            <a class="social" href="#" aria-label="Masuk dengan Google">
                <span class="google-mark" aria-hidden="true"></span>
                GOOGLE
            </a>
            <a class="social" href="#" aria-label="Masuk dengan Facebook">
                <span aria-hidden="true">f</span>
                FACEBOOK
            </a>
        </div>

        <p class="meta">Dengan masuk ke EngPersona, kamu menyetujui <b>Ketentuan</b> dan <b>Kebijakan Privasi</b> kami.</p>
        <p class="meta">Situs ini dilindungi oleh reCAPTCHA Enterprise, dan <b>Kebijakan Privasi</b> serta <b>Ketentuan Layanan</b> berlaku.</p>
    </div>
</div>
</body>
</html>
