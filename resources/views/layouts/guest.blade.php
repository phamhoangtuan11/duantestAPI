<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MMO') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background:
                linear-gradient(135deg, rgba(2, 6, 23, .95), rgba(15, 23, 42, .92)),
                url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1600');
            background-size: cover;
            background-position: center;
            font-family: 'Segoe UI', sans-serif;
            color: white;
            overflow: hidden;
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            position: relative;
        }

        .auth-page::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            background: rgba(59, 130, 246, .25);
            filter: blur(100px);
            border-radius: 50%;
            top: -120px;
            left: -120px;
            animation: glowMove 6s infinite alternate;
        }

        .auth-page::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            background: rgba(124, 58, 237, .25);
            filter: blur(100px);
            border-radius: 50%;
            bottom: -120px;
            right: -120px;
            animation: glowMove 7s infinite alternate-reverse;
        }

        @keyframes glowMove {
            from {
                transform: translateY(0) scale(1);
            }

            to {
                transform: translateY(40px) scale(1.15);
            }
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            position: relative;
            z-index: 2;
            background: rgba(15, 23, 42, .88);
            border: 1px solid rgba(148, 163, 184, .18);
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .5);
            backdrop-filter: blur(18px);
            animation: fadeUp .7s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .auth-logo .logo-icon {
            width: 74px;
            height: 74px;
            margin: auto;
            border-radius: 22px;
            background: linear-gradient(135deg, #3b82f6, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            box-shadow: 0 0 35px rgba(59, 130, 246, .45);
        }

        .auth-logo h2 {
            margin: 18px 0 6px;
            font-size: 28px;
            color: white;
        }

        .auth-logo p {
            margin: 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .auth-card label {
            color: #cbd5e1 !important;
            font-size: 14px;
        }

        .auth-card input {
            width: 100%;
            background: #111827 !important;
            border: 1px solid #334155 !important;
            color: white !important;
            border-radius: 14px !important;
            padding: 12px 14px !important;
            margin-top: 6px;
            transition: .25s;
        }

        .auth-card input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .18) !important;
        }

        .auth-card input::placeholder {
            color: #64748b;
        }

        .auth-card button {
            background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
            color: white !important;
            border-radius: 14px !important;
            padding: 12px 20px !important;
            border: none !important;
            transition: .25s;
            font-weight: 700;
        }

        .auth-card button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(59, 130, 246, .35);
        }

        .auth-card a {
            color: #93c5fd !important;
            transition: .25s;
        }

        .auth-card a:hover {
            color: white !important;
        }

        .auth-footer {
            text-align: center;
            margin-top: 22px;
            color: #64748b;
            font-size: 13px;
        }

        .auth-switch {
            text-align: center;
            margin-top: 22px;
            color: #94a3b8;
            font-size: 14px;
        }

        .auth-switch a {
            color: #60a5fa !important;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-switch a:hover {
            color: white !important;
        }
    </style>
</head>

<body>
    <div class="auth-page">
        <div class="auth-card">

            <div class="auth-logo">
                <div class="logo-icon">⚡</div>
                <h2>TRUNG TÂM</h2>
                <p>Đăng nhập hệ thống dịch vụ MMO</p>
            </div>

            {{ $slot }}

            <div class="auth-footer">
                © 2025 TRUNG TÂM
            </div>

        </div>
    </div>

    @include('components.mmo-notifications')
</body>

</html>
