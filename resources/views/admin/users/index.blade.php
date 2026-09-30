@extends('admin.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px
        }

        .user-title h2 {
            color: white;
            font-size: 38px;
            font-weight: 800;
            margin: 0
        }

        .user-title p {
            color: #94a3b8;
            margin-top: 6px
        }

        .user-table-box {
            background: rgba(15, 23, 42, .88);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .35)
        }

        .table {
            margin: 0
        }

        .table thead th {
            background: #0b1220 !important;
            color: #93c5fd !important;
            border: none !important;
            padding: 20px
        }

        .table tbody td {
            background: #111827 !important;
            color: #e2e8f0 !important;
            border-color: #1e293b !important;
            padding: 18px;
            vertical-align: middle
        }

        .table tbody tr:hover td {
            background: #172033 !important
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(135deg, #3b82f6, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            box-shadow: 0 0 20px rgba(59, 130, 246, .35)
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .user-name {
            font-weight: 700;
            color: white
        }

        .balance-text {
            color: #22c55e;
            font-weight: 800
        }

        .money-input {
            background: #0f172a !important;
            color: white !important;
            border: 1px solid #334155 !important;
            border-radius: 14px !important;
            padding: 12px !important
        }

        .money-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .2) !important
        }

        .action-btn {
            border: none;
            padding: 11px 15px;
            border-radius: 14px;
            color: white;
            font-weight: 700;
            transition: .25s;
            margin: 2px
        }

        .action-btn:hover {
            transform: translateY(-2px)
        }

        .add-btn {
            background: linear-gradient(135deg, #22c55e, #16a34a)
        }

        .add-btn:hover {
            box-shadow: 0 0 25px rgba(34, 197, 94, .35)
        }

        .minus-btn {
            background: linear-gradient(135deg, #ef4444, #b91c1c)
        }

        .minus-btn:hover {
            box-shadow: 0 0 25px rgba(239, 68, 68, .35)
        }

        .history-btn {
            background: linear-gradient(135deg, #3b82f6, #2563eb)
        }

        .history-btn:hover {
            box-shadow: 0 0 25px rgba(59, 130, 246, .35)
        }

        .role-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(59, 130, 246, .15);
            color: #93c5fd;
            font-size: 13px;
            font-weight: 700
        }

        .modal-content {
            background: #0f172a !important;
            border: 1px solid #1e293b !important;
            border-radius: 24px !important;
            color: white
        }

        .modal-header,
        .modal-footer {
            border-color: #1e293b !important
        }

        .order-card {
            background: #111827;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 14px;
            margin-bottom: 12px
        }

        .order-card strong {
            color: #60a5fa
        }

        .order-price {
            color: #22c55e;
            font-weight: 800
        }
    </style>

    <div class="user-header">
        <div class="user-title">
            <h2>Danh sách Users</h2>
            <p>Quản lý số dư ví, cộng/trừ tiền và xem lịch sử mua tài khoản.</p>
        </div>
    </div>

    <div class="user-table-box">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Số dư</th>
                    <th>Nhập tiền</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    @if ($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}"
                                            alt="Ảnh đại diện của {{ $user->name }}">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif
                                </div>

                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <small style="color:#94a3b8;">{{ $user->email }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="role-badge">
                                {{ $user->role ?? 'user' }}
                            </span>
                        </td>

                        <td class="balance-text">
                            {{ number_format($user->balance ?? 0) }}đ
                        </td>

                        <td>
                            <input type="number" id="amount_{{ $user->id }}" class="form-control money-input"
                                placeholder="Nhập số tiền">
                        </td>

                        <td>
                            <button class="action-btn add-btn" onclick="addMoney({{ $user->id }})">
                                + Cộng
                            </button>

                            <button class="action-btn minus-btn" onclick="minusMoney({{ $user->id }})">
                                - Trừ
                            </button>

                            <button class="action-btn history-btn" data-bs-toggle="modal"
                                data-bs-target="#history{{ $user->id }}">
                                📦 Lịch sử
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="history{{ $user->id }}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        📦 Lịch sử mua của {{ $user->name }}
                                    </h5>
                                </div>

                                <div class="modal-body">
                                    @php
                                        $userOrders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
                                    @endphp

                                    @forelse($userOrders as $order)
                                        <div class="order-card">
                                            <div><strong>Username:</strong> {{ $order->username }}</div>
                                            <div><strong>Password:</strong> {{ $order->password }}</div>
                                            <div><strong>Giá:</strong> <span
                                                    class="order-price">{{ number_format($order->price) }}đ</span></div>
                                            <div><strong>Trạng thái:</strong> {{ $order->status }}</div>
                                            <div><strong>Thời gian:</strong> {{ $order->created_at }}</div>
                                        </div>
                                    @empty
                                        <p style="color:#94a3b8;margin:0;">
                                            User này chưa mua tài khoản nào.
                                        </p>
                                    @endforelse
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Đọc và kiểm tra số tiền admin nhập cho một người dùng.
        function getAmount(userId) {
            let amount = document.getElementById("amount_" + userId).value;

            if (!amount || amount <= 0) {
                window.mmoToast("Nhập số tiền hợp lệ", "warning");
                return false;
            }

            return amount;
        }

        // Gọi API admin để cộng số dư người dùng.
        function addMoney(userId) {
            let amount = getAmount(userId);
            if (!amount) return;

            fetch(`/admin/users/${userId}/add-money`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        amount: amount
                    })
                })
                .then(res => res.json())
                .then(data => {
                    window.mmoToast(data.message, data.status ? "success" : "error");
                    if (data.status) setTimeout(() => location.reload(), 700);
                });
        }

        // Xác nhận rồi gọi API admin để trừ số dư người dùng.
        async function minusMoney(userId) {
            let amount = getAmount(userId);
            if (!amount) return;

            const accepted = await window.mmoConfirm("Bạn chắc chắn muốn trừ tiền user này?", {
                title: "Xác nhận trừ tiền",
                confirmText: "Trừ tiền"
            });

            if (!accepted) {
                return;
            }

            fetch(`/admin/users/${userId}/minus-money`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        amount: amount
                    })
                })
                .then(res => res.json())
                .then(data => {
                    window.mmoToast(data.message, data.status ? "success" : "error");
                    if (data.status) setTimeout(() => location.reload(), 700);
                });
        }
    </script>
@endsection
