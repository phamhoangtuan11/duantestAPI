<x-app-layout>
    <style>
        :root {
            --profile-bg: #050a17;
            --profile-panel: rgba(15, 25, 46, .88);
            --profile-soft: rgba(15, 23, 42, .62);
            --profile-line: rgba(148, 163, 184, .16);
            --profile-text: #f8fafc;
            --profile-muted: #94a3b8;
            --profile-blue: #3b82f6;
            --profile-violet: #7c3aed;
        }

        body, main, .min-h-screen {
            background: var(--profile-bg) !important;
        }

        .profile-page {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            padding: 38px 20px 65px;
            color: var(--profile-text);
            background:
                radial-gradient(circle at 12% 8%, rgba(37, 99, 235, .18), transparent 27%),
                radial-gradient(circle at 90% 88%, rgba(124, 58, 237, .16), transparent 30%);
        }

        .profile-page::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: .2;
            background-image:
                linear-gradient(rgba(148, 163, 184, .08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, .08) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: linear-gradient(to bottom, black, transparent 78%);
        }

        .profile-container {
            position: relative;
            z-index: 1;
            width: min(1180px, 100%);
            margin: auto;
        }

        .profile-hero {
            position: relative;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            min-height: 210px;
            overflow: hidden;
            margin-bottom: 22px;
            padding: 32px;
            border: 1px solid var(--profile-line);
            border-radius: 25px;
            background:
                linear-gradient(110deg, rgba(7, 15, 32, .96), rgba(15, 29, 54, .84), rgba(37, 99, 235, .28)),
                url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1600') !important;
            background-position: center;
            background-size: cover;
            box-shadow: 0 24px 70px rgba(0, 0, 0, .28);
            animation: profileReveal .6s cubic-bezier(.16, 1, .3, 1) both;
        }

        .profile-hero::after {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            top: -145px;
            right: -70px;
            border-radius: 50%;
            background: rgba(96, 165, 250, .23);
            filter: blur(10px);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 13px;
            padding: 7px 11px;
            border: 1px solid rgba(96, 165, 250, .28);
            border-radius: 999px;
            color: #bfdbfe;
            background: rgba(59, 130, 246, .12);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .profile-hero h1 {
            margin: 0 0 8px;
            color: white;
            font-size: clamp(28px, 4vw, 42px);
            letter-spacing: -.8px;
        }

        .profile-hero p {
            max-width: 610px;
            margin: 0;
            color: #cbd5e1;
            font-size: 13px;
            line-height: 1.7;
        }

        .back-home-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, .13);
            border-radius: 13px;
            color: white;
            background: rgba(15, 23, 42, .66);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            backdrop-filter: blur(12px);
            transition: transform .25s, border-color .25s, background .25s, box-shadow .25s;
        }

        .back-home-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(96, 165, 250, .5);
            background: rgba(37, 99, 235, .75);
            box-shadow: 0 12px 28px rgba(37, 99, 235, .28);
        }

        .profile-grid {
            display: grid;
            grid-template-columns: minmax(285px, 330px) minmax(0, 1fr);
            gap: 22px;
            align-items: start;
        }

        .profile-sidebar {
            position: sticky;
            top: 20px;
            display: grid;
            gap: 16px;
            animation: profileReveal .65s .08s cubic-bezier(.16, 1, .3, 1) both;
        }

        .profile-card {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--profile-line);
            border-radius: 22px;
            background: var(--profile-panel);
            box-shadow: 0 20px 55px rgba(0, 0, 0, .2);
            backdrop-filter: blur(18px);
        }

        .user-box {
            padding: 26px;
            text-align: center;
        }

        .user-box::before {
            content: "";
            position: absolute;
            width: 170px;
            height: 170px;
            top: -112px;
            right: -75px;
            border-radius: 50%;
            background: rgba(59, 130, 246, .24);
            filter: blur(8px);
        }

        .avatar-wrap {
            position: relative;
            width: 102px;
            margin: 0 auto;
        }

        .avatar {
            position: relative;
            display: grid;
            width: 102px;
            height: 102px;
            place-items: center;
            border: 4px solid rgba(15, 23, 42, .92);
            border-radius: 29px;
            color: white;
            background: linear-gradient(145deg, var(--profile-blue), var(--profile-violet));
            box-shadow: 0 16px 38px rgba(59, 130, 246, .28);
            font-size: 38px;
            font-weight: 900;
            transition: transform .35s cubic-bezier(.16, 1, .3, 1), box-shadow .35s;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-box:hover .avatar {
            transform: translateY(-4px) rotate(-2deg);
            box-shadow: 0 22px 45px rgba(59, 130, 246, .4);
        }

        .online-dot {
            position: absolute;
            right: 2px;
            bottom: 1px;
            width: 18px;
            height: 18px;
            border: 4px solid #0f192e;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 14px rgba(34, 197, 94, .7);
        }

        .user-box h2 {
            margin: 18px 0 5px;
            color: white;
            font-size: 20px;
        }

        .user-email {
            margin: 0;
            overflow: hidden;
            color: var(--profile-muted);
            font-size: 11px;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .member-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 12px;
            padding: 6px 10px;
            border: 1px solid rgba(34, 197, 94, .22);
            border-radius: 999px;
            color: #bbf7d0;
            background: rgba(34, 197, 94, .08);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .member-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 10px rgba(34, 197, 94, .75);
        }

        .balance-box {
            margin-top: 21px;
            padding: 16px;
            border: 1px solid rgba(96, 165, 250, .2);
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(37, 99, 235, .12), rgba(124, 58, 237, .07));
            text-align: left;
        }

        .balance-box span {
            color: #93c5fd;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .balance-box strong {
            display: block;
            margin-top: 6px;
            color: white;
            font-size: 25px;
            overflow-wrap: anywhere;
        }

        .balance-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 9px;
            color: #bfdbfe;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
        }

        .quick-card { padding: 12px; }

        .quick-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 13px;
            border-radius: 12px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            transition: transform .22s, color .22s, background .22s;
        }

        .quick-link:hover {
            transform: translateX(3px);
            color: white;
            background: rgba(59, 130, 246, .12);
        }

        .profile-content {
            display: grid;
            gap: 17px;
            min-width: 0;
        }

        .form-card {
            padding: 25px;
            animation: profileReveal .65s cubic-bezier(.16, 1, .3, 1) both;
        }

        .form-card:nth-child(1) { animation-delay: .13s; }
        .form-card:nth-child(2) { animation-delay: .19s; }
        .form-card:nth-child(3) { animation-delay: .25s; }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--profile-line);
        }

        .section-icon {
            display: grid;
            width: 42px;
            height: 42px;
            flex: 0 0 auto;
            place-items: center;
            border: 1px solid rgba(96, 165, 250, .24);
            border-radius: 13px;
            color: #bfdbfe;
            background: rgba(59, 130, 246, .12);
            font-size: 16px;
        }

        .section-heading h2 {
            margin: 0 0 4px;
            color: white;
            font-size: 16px;
            font-weight: 800;
        }

        .section-heading p {
            margin: 0;
            color: var(--profile-muted);
            font-size: 10px;
        }

        .danger-card {
            border-color: rgba(244, 63, 94, .18);
        }

        .danger-card .section-icon {
            border-color: rgba(244, 63, 94, .23);
            color: #fecdd3;
            background: rgba(244, 63, 94, .1);
        }

        .profile-form header { display: none; }

        .profile-form form {
            display: grid;
            gap: 17px;
            margin-top: 0 !important;
        }

        .profile-form label {
            color: #cbd5e1 !important;
            font-size: 11px !important;
            font-weight: 700 !important;
        }

        .profile-form input {
            width: 100% !important;
            min-height: 46px;
            margin-top: 7px !important;
            border: 1px solid rgba(148, 163, 184, .2) !important;
            border-radius: 12px !important;
            color: white !important;
            background: rgba(15, 23, 42, .7) !important;
            box-shadow: none !important;
            transition: border-color .25s, box-shadow .25s, transform .25s !important;
        }

        .profile-form input:focus {
            transform: translateY(-1px);
            border-color: rgba(96, 165, 250, .7) !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .12) !important;
        }

        .profile-form p {
            color: var(--profile-muted) !important;
            font-size: 11px !important;
        }

        .profile-form button {
            min-height: 43px;
            border: 0 !important;
            border-radius: 12px !important;
            color: white !important;
            background: linear-gradient(135deg, #2563eb, #7c3aed) !important;
            box-shadow: 0 11px 25px rgba(37, 99, 235, .23);
            font-size: 11px !important;
            font-weight: 800 !important;
            transition: transform .25s, box-shadow .25s, filter .25s !important;
        }

        .profile-form button:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
            box-shadow: 0 16px 32px rgba(37, 99, 235, .34);
        }

        .danger-card .profile-form > section > button,
        .danger-card .profile-form > button {
            background: linear-gradient(135deg, #e11d48, #be123c) !important;
            box-shadow: 0 11px 25px rgba(225, 29, 72, .2);
        }

        .profile-form [class*="text-red"] {
            color: #fda4af !important;
            font-size: 10px !important;
        }

        .avatar-upload-field {
            display: grid;
            grid-template-columns: 92px minmax(0, 1fr);
            gap: 17px;
            align-items: center;
            padding: 16px;
            border: 1px solid rgba(96, 165, 250, .18);
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(37, 99, 235, .1), rgba(124, 58, 237, .05));
        }

        .avatar-preview-frame {
            display: grid;
            width: 82px;
            height: 82px;
            overflow: hidden;
            place-items: center;
            border: 3px solid rgba(15, 23, 42, .9);
            border-radius: 23px;
            color: white;
            background: linear-gradient(145deg, var(--profile-blue), var(--profile-violet));
            box-shadow: 0 12px 28px rgba(59, 130, 246, .22);
            font-size: 29px;
            font-weight: 900;
        }

        .avatar-preview-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-upload-copy p {
            margin: 5px 0 10px !important;
        }

        .avatar-file-input {
            position: absolute;
            width: 1px !important;
            height: 1px !important;
            overflow: hidden;
            opacity: 0;
            pointer-events: none;
        }

        .avatar-select-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 36px;
            padding: 0 13px;
            border: 1px solid rgba(96, 165, 250, .28);
            border-radius: 10px;
            color: #bfdbfe !important;
            background: rgba(59, 130, 246, .12);
            cursor: pointer;
            font-size: 10px !important;
            font-weight: 800 !important;
            transition: transform .22s, border-color .22s, background .22s;
        }

        .avatar-select-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(96, 165, 250, .58);
            background: rgba(59, 130, 246, .22);
        }

        .avatar-file-name {
            display: inline-block;
            max-width: 210px;
            margin-left: 8px;
            overflow: hidden;
            color: var(--profile-muted);
            font-size: 9px;
            vertical-align: middle;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .danger-card .bg-white {
            border: 1px solid rgba(244, 63, 94, .2);
            border-radius: 20px !important;
            color: white;
            background: #0f192e !important;
            box-shadow: 0 28px 80px rgba(0, 0, 0, .55);
        }

        .danger-card .bg-white h2 {
            color: white !important;
        }

        .danger-card .bg-white input {
            width: 100% !important;
        }

        .danger-card .bg-white button {
            min-height: 40px;
            border-radius: 11px !important;
        }

        .danger-card .bg-white button:first-of-type {
            border: 1px solid var(--profile-line) !important;
            color: #cbd5e1 !important;
            background: #1e293b !important;
            box-shadow: none;
        }

        @keyframes profileReveal {
            from { opacity: 0; transform: translateY(17px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 900px) {
            .profile-grid { grid-template-columns: 1fr; }
            .profile-sidebar { position: static; }
        }

        @media (max-width: 640px) {
            .profile-page { padding: 20px 10px 45px; }
            .profile-hero {
                align-items: flex-start;
                flex-direction: column;
                min-height: auto;
                padding: 24px;
            }
            .back-home-btn { width: 100%; }
            .form-card { padding: 18px; }
            .avatar-upload-field { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>

    <div class="profile-page">
        <div class="profile-container">
            <header class="profile-hero">
                <div class="hero-content">
                    <span class="hero-eyebrow">Trung tâm tài khoản MMO</span>
                    <h1>Hồ sơ tài khoản</h1>
                    <p>Quản lý thông tin cá nhân, tăng cường bảo mật và theo dõi ví hệ thống tại một nơi.</p>
                </div>
                <a href="{{ url('/') }}" class="back-home-btn">← Quay về trang chủ</a>
            </header>

            <div class="profile-grid">
                <aside class="profile-sidebar">
                    <section class="profile-card user-box">
                        <div class="avatar-wrap">
                            <div class="avatar">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Ảnh đại diện của {{ $user->name }}">
                                @else
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                @endif
                            </div>
                            <span class="online-dot"></span>
                        </div>
                        <h2>{{ $user->name }}</h2>
                        <p class="user-email">{{ $user->email }}</p>
                        <span class="member-badge">
                            {{ $user->email_verified_at ? 'Tài khoản đã xác minh' : 'Thành viên hệ thống' }}
                        </span>

                        <div class="balance-box">
                            <span>Số dư ví MMO</span>
                            <strong>{{ number_format($user->balance ?? 0, 0, ',', '.') }}đ</strong>
                            <a href="{{ url('/deposit') }}" class="balance-action">Nạp thêm số dư →</a>
                        </div>
                    </section>

                    <nav class="profile-card quick-card">
                        <a href="{{ url('/my-orders') }}" class="quick-link"><span>Đơn hàng của tôi</span><span>→</span></a>
                        <a href="{{ url('/deposit') }}" class="quick-link"><span>Nạp tiền tài khoản</span><span>→</span></a>
                        <a href="{{ url('/chinh-sach-he-thong') }}" class="quick-link"><span>Chính sách hệ thống</span><span>→</span></a>
                    </nav>
                </aside>

                <div class="profile-content">
                    <section class="profile-card form-card">
                        <div class="section-heading">
                            <span class="section-icon">✎</span>
                            <div>
                                <h2>Thông tin cá nhân</h2>
                                <p>Cập nhật tên hiển thị và địa chỉ email tài khoản.</p>
                            </div>
                        </div>
                        <div class="profile-form">@include('profile.partials.update-profile-information-form')</div>
                    </section>

                    <section class="profile-card form-card">
                        <div class="section-heading">
                            <span class="section-icon">◆</span>
                            <div>
                                <h2>Bảo mật tài khoản</h2>
                                <p>Thay đổi mật khẩu định kỳ để bảo vệ tài khoản.</p>
                            </div>
                        </div>
                        <div class="profile-form">@include('profile.partials.update-password-form')</div>
                    </section>

                    <section class="profile-card form-card danger-card">
                        <div class="section-heading">
                            <span class="section-icon">!</span>
                            <div>
                                <h2>Vùng nguy hiểm</h2>
                                <p>Xóa tài khoản và toàn bộ dữ liệu liên quan vĩnh viễn.</p>
                            </div>
                        </div>
                        <div class="profile-form">@include('profile.partials.delete-user-form')</div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
