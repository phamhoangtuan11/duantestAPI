<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nạp tiền tự động | MMO</title>
    <style>
        :root {
            color-scheme: dark;
            --bg: #050a17;
            --panel: rgba(15, 25, 46, .88);
            --panel-soft: rgba(15, 23, 42, .58);
            --line: rgba(148, 163, 184, .16);
            --text: #f8fafc;
            --muted: #94a3b8;
            --blue: #3b82f6;
            --violet: #7c3aed;
            --green: #22c55e;
            --amber: #f59e0b;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            color: var(--text);
            background:
                radial-gradient(circle at 13% 8%, rgba(37, 99, 235, .19), transparent 28%),
                radial-gradient(circle at 88% 88%, rgba(124, 58, 237, .17), transparent 30%),
                var(--bg);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .2;
            background-image:
                linear-gradient(rgba(148, 163, 184, .08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, .08) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: linear-gradient(to bottom, black, transparent 80%);
        }

        button, a { font: inherit; }

        .deposit-shell {
            position: relative;
            z-index: 1;
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0 55px;
        }

        .deposit-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 35px;
            animation: reveal .55s cubic-bezier(.16, 1, .3, 1) both;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--text);
            text-decoration: none;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .brand-mark {
            display: grid;
            width: 42px;
            height: 42px;
            place-items: center;
            border: 1px solid rgba(96, 165, 250, .45);
            border-radius: 13px;
            background: linear-gradient(135deg, var(--blue), var(--violet));
            box-shadow: 0 10px 30px rgba(59, 130, 246, .28);
        }

        .auto-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 13px;
            border: 1px solid rgba(34, 197, 94, .22);
            border-radius: 999px;
            color: #bbf7d0;
            background: rgba(34, 197, 94, .08);
            font-size: 12px;
            font-weight: 700;
        }

        .auto-status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 13px rgba(34, 197, 94, .85);
        }

        .deposit-heading {
            margin-bottom: 28px;
            animation: reveal .6s .06s cubic-bezier(.16, 1, .3, 1) both;
        }

        .deposit-heading > span {
            color: #93c5fd;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .deposit-heading h1 {
            margin: 9px 0 8px;
            font-size: clamp(28px, 4vw, 42px);
            letter-spacing: -.8px;
        }

        .deposit-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .deposit-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.12fr) minmax(340px, .88fr);
            gap: 22px;
            align-items: start;
        }

        .deposit-panel {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 24px;
            background: var(--panel);
            box-shadow: 0 24px 70px rgba(0, 0, 0, .28);
            backdrop-filter: blur(18px);
            animation: reveal .65s .12s cubic-bezier(.16, 1, .3, 1) both;
        }

        .deposit-panel::before {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            top: -125px;
            right: -95px;
            border-radius: 50%;
            background: rgba(59, 130, 246, .2);
            filter: blur(8px);
        }

        .panel-head {
            position: relative;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 22px 24px;
            border-bottom: 1px solid var(--line);
        }

        .panel-icon {
            display: grid;
            width: 42px;
            height: 42px;
            flex: 0 0 auto;
            place-items: center;
            border: 1px solid rgba(96, 165, 250, .25);
            border-radius: 13px;
            color: #bfdbfe;
            background: rgba(59, 130, 246, .13);
            font-size: 17px;
        }

        .panel-head h2 {
            margin: 0 0 4px;
            font-size: 16px;
        }

        .panel-head p {
            margin: 0;
            color: var(--muted);
            font-size: 11px;
        }

        .bank-body, .qr-body { padding: 24px; }

        .bank-card {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 18px;
            padding: 17px;
            border: 1px solid rgba(96, 165, 250, .2);
            border-radius: 17px;
            background: linear-gradient(135deg, rgba(37, 99, 235, .12), rgba(124, 58, 237, .07));
        }

        .bank-logo {
            display: grid;
            width: 50px;
            height: 50px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 15px;
            color: white;
            background: linear-gradient(145deg, #2563eb, #6941d9);
            box-shadow: 0 12px 28px rgba(37, 99, 235, .28);
            font-size: 15px;
            font-weight: 900;
        }

        .bank-card small {
            display: block;
            margin-bottom: 5px;
            color: #93c5fd;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .bank-card strong { font-size: 16px; }

        .info-list {
            display: grid;
            gap: 11px;
        }

        .info-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 14px 15px;
            border: 1px solid var(--line);
            border-radius: 13px;
            background: var(--panel-soft);
        }

        .info-item span {
            color: var(--muted);
            font-size: 12px;
        }

        .info-value {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
        }

        .info-value strong {
            overflow: hidden;
            font-size: 12px;
            text-align: right;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .mini-copy {
            display: grid;
            width: 29px;
            height: 29px;
            flex: 0 0 auto;
            place-items: center;
            border: 1px solid rgba(96, 165, 250, .22);
            border-radius: 9px;
            color: #bfdbfe;
            background: rgba(59, 130, 246, .1);
            cursor: pointer;
            transition: transform .2s, border-color .2s, background .2s;
        }

        .mini-copy:hover {
            transform: translateY(-2px);
            border-color: rgba(96, 165, 250, .55);
            background: rgba(59, 130, 246, .2);
        }

        .transfer-box {
            margin-top: 18px;
            padding: 16px;
            border: 1px solid rgba(245, 158, 11, .24);
            border-radius: 17px;
            background: rgba(245, 158, 11, .07);
        }

        .transfer-box label {
            display: block;
            margin-bottom: 10px;
            color: #fde68a;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .transfer-code {
            padding: 16px;
            border: 1px dashed rgba(251, 191, 36, .42);
            border-radius: 13px;
            color: #fff7cc;
            background: rgba(15, 23, 42, .58);
            font-size: clamp(18px, 3vw, 23px);
            font-weight: 900;
            letter-spacing: 1.5px;
            text-align: center;
            overflow-wrap: anywhere;
        }

        .copy-btn, .back-btn, .login-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            min-height: 48px;
            overflow: hidden;
            border-radius: 13px;
            color: white;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: transform .25s, border-color .25s, box-shadow .25s, filter .25s;
        }

        .copy-btn, .login-btn {
            margin-top: 12px;
            border: 0;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            box-shadow: 0 14px 30px rgba(37, 99, 235, .26);
            cursor: pointer;
        }

        .copy-btn::before, .login-btn::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, .25), transparent 70%);
            transform: translateX(-120%);
            transition: transform .7s ease;
        }

        .copy-btn:hover, .login-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
            box-shadow: 0 18px 38px rgba(37, 99, 235, .38);
        }

        .copy-btn:hover::before, .login-btn:hover::before { transform: translateX(120%); }

        .qr-panel {
            position: sticky;
            top: 22px;
            animation-delay: .2s;
        }

        .qr-frame {
            position: relative;
            padding: 17px;
            border-radius: 21px;
            background: white;
            box-shadow: 0 22px 48px rgba(0, 0, 0, .34);
        }

        .qr-frame::after {
            content: "";
            position: absolute;
            inset: -1px;
            pointer-events: none;
            border: 1px solid rgba(96, 165, 250, .32);
            border-radius: 21px;
        }

        .qr-frame img {
            display: block;
            width: 100%;
            border-radius: 13px;
        }

        .qr-caption {
            margin: 17px 0 0;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.65;
            text-align: center;
        }

        .steps {
            display: grid;
            gap: 10px;
            margin-top: 18px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 12px;
            border: 1px solid var(--line);
            border-radius: 12px;
            color: #cbd5e1;
            background: var(--panel-soft);
            font-size: 10px;
        }

        .step b {
            display: grid;
            width: 24px;
            height: 24px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 8px;
            color: #bfdbfe;
            background: rgba(59, 130, 246, .14);
        }

        .deposit-note {
            display: flex;
            gap: 12px;
            margin-top: 22px;
            padding: 16px 18px;
            border: 1px solid rgba(245, 158, 11, .25);
            border-radius: 16px;
            color: #fde68a;
            background: rgba(245, 158, 11, .08);
            font-size: 11px;
            line-height: 1.7;
            animation: reveal .65s .26s cubic-bezier(.16, 1, .3, 1) both;
        }

        .back-btn {
            width: auto;
            min-width: 190px;
            margin-top: 18px;
            padding: 0 19px;
            border: 1px solid var(--line);
            color: #cbd5e1;
            background: rgba(15, 23, 42, .58);
        }

        .back-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(96, 165, 250, .42);
            color: white;
            background: rgba(30, 41, 59, .85);
        }

        .auth-required {
            padding: 25px;
            color: var(--muted);
            text-align: center;
        }

        .auth-required strong {
            display: block;
            margin-bottom: 8px;
            color: white;
            font-size: 17px;
        }

        @keyframes reveal {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 850px) {
            .deposit-grid { grid-template-columns: 1fr; }
            .qr-panel { position: static; }
        }

        @media (max-width: 580px) {
            .deposit-shell {
                width: min(100% - 20px, 1180px);
                padding-top: 18px;
            }

            .auto-status span { display: none; }
            .deposit-nav { margin-bottom: 27px; }
            .panel-head, .bank-body, .qr-body { padding: 18px; }
            .info-item { align-items: flex-start; }
            .info-value { max-width: 62%; }
            .back-btn { width: 100%; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    @php
        $bankNumber = '0211102004321';
        $bankOwner = 'PHAM HOANG TUAN';
        $transferCode = auth()->check() ? 'NAPTIEN_' . auth()->id() : null;
    @endphp

    <main class="deposit-shell">
        <nav class="deposit-nav">
            <a class="brand" href="{{ url('/') }}">
                <span class="brand-mark">⚡</span>
                <span>MMO CENTER</span>
            </a>
            <span class="auto-status"><span>Đối soát tự động đang hoạt động</span></span>
        </nav>

        <header class="deposit-heading">
            <span>Nạp số dư hệ thống</span>
            <h1>Nạp tiền tự động</h1>
            <p>Quét mã QR hoặc chuyển khoản đúng nội dung để hệ thống cộng tiền chính xác.</p>
        </header>

        @auth
            <div class="deposit-grid">
                <section class="deposit-panel">
                    <div class="panel-head">
                        <span class="panel-icon">▣</span>
                        <div>
                            <h2>Thông tin chuyển khoản</h2>
                            <p>Sử dụng đúng số tài khoản và nội dung bên dưới.</p>
                        </div>
                    </div>

                    <div class="bank-body">
                        <div class="bank-card">
                            <span class="bank-logo">MB</span>
                            <div>
                                <small>Ngân hàng thụ hưởng</small>
                                <strong>MB Bank</strong>
                            </div>
                        </div>

                        <div class="info-list">
                            <div class="info-item">
                                <span>Số tài khoản</span>
                                <div class="info-value">
                                    <strong>{{ $bankNumber }}</strong>
                                    <button class="mini-copy" type="button" onclick="copyValue('{{ $bankNumber }}', 'số tài khoản')" aria-label="Sao chép số tài khoản">▣</button>
                                </div>
                            </div>
                            <div class="info-item">
                                <span>Chủ tài khoản</span>
                                <div class="info-value">
                                    <strong>{{ $bankOwner }}</strong>
                                </div>
                            </div>
                            <div class="info-item">
                                <span>Số dư hiện tại</span>
                                <div class="info-value">
                                    <strong>{{ number_format(auth()->user()->balance ?? 0, 0, ',', '.') }}đ</strong>
                                </div>
                            </div>
                        </div>

                        <div class="transfer-box">
                            <label>Nội dung chuyển khoản bắt buộc</label>
                            <div class="transfer-code" id="transferCode">{{ $transferCode }}</div>
                            <button class="copy-btn" type="button" onclick="copyTransferCode(this)">
                                <span>Sao chép nội dung chuyển khoản</span>
                                <span>▣</span>
                            </button>
                        </div>
                    </div>
                </section>

                <aside class="deposit-panel qr-panel">
                    <div class="panel-head">
                        <span class="panel-icon">⌗</span>
                        <div>
                            <h2>Quét mã VietQR</h2>
                            <p>Nội dung chuyển khoản đã được điền sẵn.</p>
                        </div>
                    </div>

                    <div class="qr-body">
                        <div class="qr-frame">
                            <img
                                src="https://img.vietqr.io/image/MB-{{ $bankNumber }}-compact.png?addInfo={{ urlencode($transferCode) }}"
                                alt="Mã QR nạp tiền MB Bank"
                            >
                        </div>
                        <p class="qr-caption">Mở ứng dụng ngân hàng, quét QR và nhập số tiền bạn muốn nạp.</p>

                        <div class="steps">
                            <div class="step"><b>1</b><span>Quét mã bằng ứng dụng ngân hàng.</span></div>
                            <div class="step"><b>2</b><span>Kiểm tra đúng nội dung chuyển khoản.</span></div>
                            <div class="step"><b>3</b><span>Hoàn tất và chờ hệ thống cộng số dư.</span></div>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="deposit-note">
                <span>⚠</span>
                <span>Chuyển khoản đúng nội dung <strong>{{ $transferCode }}</strong>. Thời gian xử lý dự kiến từ 1 - 5 phút; không thay đổi hoặc thêm ký tự vào nội dung.</span>
            </div>
        @else
            <section class="deposit-panel">
                <div class="auth-required">
                    <strong>Đăng nhập để nhận mã nạp tiền cá nhân</strong>
                    Mỗi tài khoản có một nội dung chuyển khoản riêng để hệ thống đối soát chính xác.
                    <a href="{{ route('login') }}" class="login-btn">Đăng nhập ngay →</a>
                </div>
            </section>
        @endauth

        <a href="{{ url('/') }}" class="back-btn">← Quay về trang chủ</a>
    </main>

    @include('components.mmo-notifications')

    <script>
        async function copyValue(value, label) {
            try {
                await navigator.clipboard.writeText(value);
                window.mmoToast(`Đã sao chép ${label}: ${value}`, "success");
            } catch (error) {
                window.mmoToast("Không thể sao chép tự động. Vui lòng sao chép thủ công.", "error");
            }
        }

        async function copyTransferCode(button) {
            const code = document.getElementById("transferCode").innerText.trim();
            const initialContent = button.innerHTML;

            await copyValue(code, "nội dung chuyển khoản");
            button.innerHTML = "<span>Đã sao chép nội dung</span><span>✓</span>";

            setTimeout(() => {
                button.innerHTML = initialContent;
            }, 1800);
        }
    </script>
</body>
</html>
