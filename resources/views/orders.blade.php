<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Acc đã mua</title>

    <style>
        body {
            margin: 0;
            background: #060c1a;
            color: #e2e8f0;
            font-family: 'Segoe UI', sans-serif;
        }

        .container-box {
            max-width: 1150px;
            margin: 40px auto;
            padding: 20px;
        }

        .page-header {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            border: 1px solid #1e293b;
            border-radius: 22px;
            padding: 28px;
            margin-bottom: 24px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .35);
        }

        .page-header h2 {
            margin: 0;
            color: white;
            font-size: 30px;
        }

        .page-header p {
            color: #94a3b8;
            margin-top: 8px;
        }

        .card {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 22px;
            padding: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .35);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #111827;
        }

        th {
            padding: 16px;
            color: #94a3b8;
            text-align: left;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            padding: 16px;
            border-top: 1px solid #1e293b;
            color: #e2e8f0;
        }

        tbody tr {
            transition: .25s;
        }

        tbody tr:hover {
            background: #111827;
        }

        .price {
            color: #facc15;
            font-weight: 700;
        }

        .badge-success {
            background: rgba(34, 197, 94, .15);
            color: #22c55e;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .pass {
            font-family: monospace;
            background: #111827;
            padding: 7px 10px;
            border-radius: 10px;
            border: 1px solid #1e293b;
        }

        .btn {
            border: none;
            border-radius: 10px;
            padding: 8px 12px;
            cursor: pointer;
            margin-left: 6px;
            color: white;
            transition: .25s;
        }

        .btn-view {
            background: #334155;
        }

        .btn-copy {
            background: #2563eb;
        }

        .btn:hover {
            transform: translateY(-2px);
            opacity: .9;
        }

        .back-btn {
            display: inline-block;
            margin-top: 22px;
            background: #1e293b;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 14px;
            transition: .25s;
        }

        .back-btn:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <div class="container-box">

        <div class="page-header">
            <h2>📦 Tài khoản đã mua</h2>
            <p>Quản lý danh sách tài khoản bạn đã thanh toán thành công.</p>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>{{ $order->username }}</td>

                            <td>
                                <span class="pass" data-pass="{{ $order->password }}">******</span>

                                <button onclick="togglePass(this)" class="btn btn-view">
                                    👁
                                </button>

                                <button onclick="copyPass('{{ $order->password }}')" class="btn btn-copy">
                                    Copy
                                </button>
                            </td>

                            <td class="price">
                                {{ number_format($order->price) }}đ
                            </td>

                            <td>
                                <span class="badge-success">
                                    Hoàn thành
                                </span>
                            </td>

                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Bạn chưa mua tài khoản nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="/" class="back-btn">← Về trang chủ</a>

    </div>

    <script>
        function togglePass(btn) {
            const span = btn.parentElement.querySelector(".pass");

            span.innerText = span.innerText === "******" ?
                span.dataset.pass :
                "******";
        }

        function copyPass(pass) {
            navigator.clipboard.writeText(pass);
            window.mmoToast("Đã copy password!", "success");
        }
    </script>

@include('components.mmo-notifications')
</body>

</html>
