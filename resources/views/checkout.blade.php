<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thanh toán tài khoản | MMO</title>
    <style>
        :root {
            color-scheme: dark;
            --bg: #050a17;
            --panel: rgba(15, 25, 46, .88);
            --panel-soft: rgba(20, 33, 59, .68);
            --line: rgba(148, 163, 184, .16);
            --text: #f8fafc;
            --muted: #94a3b8;
            --blue: #3b82f6;
            --violet: #7c3aed;
            --green: #22c55e;
            --red: #fb7185;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            color: var(--text);
            background:
                radial-gradient(circle at 15% 10%, rgba(37, 99, 235, .18), transparent 27%),
                radial-gradient(circle at 88% 85%, rgba(124, 58, 237, .16), transparent 30%),
                var(--bg);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .22;
            background-image:
                linear-gradient(rgba(148, 163, 184, .08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, .08) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: linear-gradient(to bottom, black, transparent 78%);
        }

        button, a { font: inherit; }

        .checkout-shell {
            position: relative;
            z-index: 1;
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0 55px;
        }

        .checkout-nav {
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

        .secure-status {
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

        .secure-status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 13px rgba(34, 197, 94, .85);
        }

        .checkout-heading {
            margin-bottom: 28px;
            animation: reveal .6s .06s cubic-bezier(.16, 1, .3, 1) both;
        }

        .checkout-heading span {
            color: #93c5fd;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .checkout-heading h1 {
            margin: 9px 0 8px;
            font-size: clamp(28px, 4vw, 42px);
            letter-spacing: -.8px;
        }

        .checkout-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(340px, .85fr);
            gap: 22px;
            align-items: start;
        }

        .checkout-panel {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 24px;
            background: var(--panel);
            box-shadow: 0 24px 70px rgba(0, 0, 0, .28);
            backdrop-filter: blur(18px);
            animation: reveal .65s .12s cubic-bezier(.16, 1, .3, 1) both;
        }

        .checkout-panel::before {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            top: -120px;
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

        .product-body { padding: 24px; }

        .product-card {
            display: flex;
            gap: 17px;
            padding: 18px;
            border: 1px solid rgba(96, 165, 250, .2);
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(37, 99, 235, .11), rgba(124, 58, 237, .06));
        }

        .platform-mark {
            display: grid;
            width: 54px;
            height: 54px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 16px;
            color: white;
            background: linear-gradient(145deg, #2563eb, #6941d9);
            box-shadow: 0 12px 28px rgba(37, 99, 235, .28);
            font-size: 22px;
            font-weight: 900;
        }

        .product-meta { min-width: 0; }

        .product-meta small {
            display: block;
            margin-bottom: 6px;
            color: #93c5fd;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .product-meta h3 {
            margin: 0 0 7px;
            overflow: hidden;
            font-size: 17px;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .product-meta p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .detail-list {
            display: grid;
            gap: 12px;
            margin-top: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 14px 15px;
            border: 1px solid var(--line);
            border-radius: 13px;
            background: rgba(15, 23, 42, .55);
        }

        .detail-item span {
            color: var(--muted);
            font-size: 12px;
        }

        .detail-item strong {
            max-width: 65%;
            overflow: hidden;
            font-size: 12px;
            text-align: right;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .ready {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #86efac;
        }

        .ready::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 10px rgba(34, 197, 94, .8);
        }

        .ready.unavailable {
            color: #fda4af;
        }

        .ready.unavailable::before {
            background: #f43f5e;
            box-shadow: 0 0 10px rgba(244, 63, 94, .7);
        }

        .benefits {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 11px;
            margin-top: 20px;
        }

        .benefit {
            min-width: 0;
            padding: 14px 12px;
            border: 1px solid var(--line);
            border-radius: 14px;
            color: var(--muted);
            background: rgba(15, 23, 42, .45);
            font-size: 10px;
            line-height: 1.5;
        }

        .benefit b {
            display: block;
            margin-bottom: 4px;
            color: #e2e8f0;
            font-size: 11px;
        }

        .summary-panel {
            position: sticky;
            top: 22px;
            animation-delay: .2s;
        }

        .summary-body { padding: 24px; }

        .summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 14px;
            color: var(--muted);
            font-size: 12px;
        }

        .summary-row strong {
            color: #e2e8f0;
            font-size: 12px;
        }

        .summary-divider {
            height: 1px;
            margin: 20px 0;
            background: var(--line);
        }

        .total-row {
            align-items: flex-end;
            margin: 0;
        }

        .total-row span {
            color: #cbd5e1;
            font-weight: 700;
        }

        .total-price {
            color: var(--red) !important;
            font-size: clamp(22px, 3vw, 29px) !important;
            line-height: 1;
            overflow-wrap: anywhere;
            text-align: right;
        }

        .balance-box {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            margin: 20px 0;
            padding: 13px 14px;
            border: 1px solid rgba(96, 165, 250, .18);
            border-radius: 13px;
            color: #bfdbfe;
            background: rgba(59, 130, 246, .08);
            font-size: 11px;
        }

        .balance-box strong { color: white; }

        .balance-box.warning {
            border-color: rgba(251, 113, 133, .25);
            color: #fecdd3;
            background: rgba(244, 63, 94, .08);
        }

        .checkout-actions {
            display: grid;
            gap: 10px;
        }

        .pay-btn, .back-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            min-height: 49px;
            overflow: hidden;
            border-radius: 14px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            transition: transform .25s, border-color .25s, box-shadow .25s, filter .25s;
        }

        .pay-btn {
            border: 0;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            box-shadow: 0 14px 32px rgba(37, 99, 235, .3);
            cursor: pointer;
        }

        .pay-btn::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, .25), transparent 70%);
            transform: translateX(-120%);
            transition: transform .7s ease;
        }

        .pay-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
            box-shadow: 0 18px 38px rgba(37, 99, 235, .4);
        }

        .pay-btn:hover::before { transform: translateX(120%); }

        .pay-btn:disabled {
            pointer-events: none;
            opacity: .72;
            background: #334155;
            box-shadow: none;
        }

        .back-btn {
            border: 1px solid var(--line);
            color: #cbd5e1;
            background: rgba(15, 23, 42, .55);
        }

        .back-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(96, 165, 250, .4);
            color: white;
            background: rgba(30, 41, 59, .82);
        }

        .fine-print {
            margin: 17px 0 0;
            color: #64748b;
            font-size: 10px;
            line-height: 1.6;
            text-align: center;
        }

        .spinner {
            width: 15px;
            height: 15px;
            border: 2px solid rgba(255, 255, 255, .35);
            border-top-color: white;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        @keyframes reveal {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 850px) {
            .checkout-grid { grid-template-columns: 1fr; }
            .summary-panel { position: static; }
        }

        @media (max-width: 580px) {
            .checkout-shell {
                width: min(100% - 20px, 1180px);
                padding-top: 18px;
            }

            .secure-status span { display: none; }
            .checkout-nav { margin-bottom: 27px; }
            .panel-head, .product-body, .summary-body { padding: 18px; }
            .benefits { grid-template-columns: 1fr; }
            .detail-item { align-items: flex-start; }
            .detail-item strong { max-width: 58%; }
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
        $isAuthenticated = auth()->check();
        $isSold = (int) $account->status === 1;
        $balance = $isAuthenticated ? (float) (auth()->user()->balance ?? 0) : 0;
        $hasEnoughBalance = $isAuthenticated && $balance >= (float) $account->price;
    @endphp

    <main class="checkout-shell">
        <nav class="checkout-nav">
            <a class="brand" href="{{ url('/') }}">
                <span class="brand-mark">⚡</span>
                <span>MMO CENTER</span>
            </a>
            <span class="secure-status"><span>Giao dịch được bảo vệ</span></span>
        </nav>

        <header class="checkout-heading">
            <span>Xác nhận đơn hàng</span>
            <h1>Thanh toán tài khoản</h1>
            <p>Kiểm tra thông tin trước khi hoàn tất giao dịch.</p>
        </header>

        <div class="checkout-grid">
            <section class="checkout-panel">
                <div class="panel-head">
                    <span class="panel-icon">▣</span>
                    <div>
                        <h2>Thông tin sản phẩm</h2>
                        <p>Tài khoản sẽ được bàn giao ngay sau khi thanh toán thành công.</p>
                    </div>
                </div>

                <div class="product-body">
                    <div class="product-card">
                        <span class="platform-mark">{{ strtoupper(substr($account->category?->name ?? 'MMO', 0, 1)) }}</span>
                        <div class="product-meta">
                            <small>{{ $account->category?->name ?? 'Tài khoản MMO' }}</small>
                            <h3>{{ $account->title }}</h3>
                            <p>Mã sản phẩm: #ACC-{{ str_pad($account->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>

                    <div class="detail-list">
                        <div class="detail-item">
                            <span>Username</span>
                            <strong>{{ $account->username }}</strong>
                        </div>
                        <div class="detail-item">
                            <span>Trạng thái</span>
                            <strong class="ready {{ $isSold ? 'unavailable' : '' }}">
                                {{ $isSold ? 'Tài khoản đã bán' : 'Sẵn sàng bàn giao' }}
                            </strong>
                        </div>
                        <div class="detail-item">
                            <span>Hình thức nhận</span>
                            <strong>Tự động sau thanh toán</strong>
                        </div>
                    </div>

                    <div class="benefits">
                        <div class="benefit"><b>Bàn giao tức thì</b>Nhận thông tin ngay sau khi mua.</div>
                        <div class="benefit"><b>Giao dịch bảo mật</b>Thanh toán trực tiếp bằng số dư.</div>
                        <div class="benefit"><b>Hỗ trợ nhanh</b>Đội ngũ hỗ trợ khi cần thiết.</div>
                    </div>
                </div>
            </section>

            <aside class="checkout-panel summary-panel">
                <div class="panel-head">
                    <span class="panel-icon">✓</span>
                    <div>
                        <h2>Tóm tắt thanh toán</h2>
                        <p>Thông tin chi phí giao dịch.</p>
                    </div>
                </div>

                <div class="summary-body">
                    <div class="summary-row">
                        <span>Giá tài khoản</span>
                        <strong>{{ number_format($account->price, 0, ',', '.') }}đ</strong>
                    </div>
                    <div class="summary-row">
                        <span>Phí giao dịch</span>
                        <strong>Miễn phí</strong>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row total-row">
                        <span>Tổng thanh toán</span>
                        <strong class="total-price">{{ number_format($account->price, 0, ',', '.') }}đ</strong>
                    </div>

                    <div class="balance-box {{ $isAuthenticated && !$hasEnoughBalance ? 'warning' : '' }}">
                        <span>Số dư hiện tại</span>
                        <strong>{{ $isAuthenticated ? number_format($balance, 0, ',', '.') . 'đ' : 'Chưa đăng nhập' }}</strong>
                    </div>

                    <div class="checkout-actions">
                        @if ($isSold)
                            <button class="pay-btn" type="button" disabled>
                                <span>Tài khoản đã được bán</span>
                            </button>
                        @elseif (!$isAuthenticated)
                            <a href="{{ route('login') }}" class="pay-btn">
                                <span>Đăng nhập để thanh toán</span>
                                <span>→</span>
                            </a>
                        @elseif (!$hasEnoughBalance)
                            <a href="{{ url('/deposit') }}" class="pay-btn">
                                <span>Nạp thêm số dư</span>
                                <span>→</span>
                            </a>
                        @else
                            <button id="payBtn" class="pay-btn" type="button" onclick="pay({{ $account->id }})">
                                <span>Thanh toán ngay</span>
                                <span>→</span>
                            </button>
                        @endif
                        <a href="{{ url('/') }}" class="back-btn">← Quay về trang chủ</a>
                    </div>

                    <p class="fine-print">Khi thanh toán, bạn xác nhận đã kiểm tra thông tin và đồng ý với chính sách dịch vụ.</p>
                </div>
            </aside>
        </div>
    </main>

    @include('components.mmo-notifications')

    <script>
        async function pay(id) {
            const button = document.getElementById("payBtn");
            const initialContent = button.innerHTML;

            button.disabled = true;
            button.innerHTML = '<span class="spinner"></span><span>Đang xử lý giao dịch...</span>';

            try {
                const response = await fetch(`/api/buy-account/${id}`, {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.status) {
                    button.innerHTML = '<span>Thanh toán thành công</span><span>✓</span>';
                    window.mmoToast(
                        `Mua thành công!\nUser: ${data.data.username}\nPass: ${data.data.password}`,
                        "success",
                        { title: "Thanh toán thành công", duration: 5500 }
                    );

                    setTimeout(() => {
                        window.location.href = "/my-orders";
                    }, 1400);
                    return;
                }

                window.mmoToast(data.message || "Không thể hoàn tất thanh toán.", "error");
            } catch (error) {
                console.error(error);
                window.mmoToast("Không thể mua tài khoản. Vui lòng kiểm tra đăng nhập và thử lại.", "error");
            }

            button.innerHTML = initialContent;
            button.disabled = false;
        }
    </script>
</body>
</html>
