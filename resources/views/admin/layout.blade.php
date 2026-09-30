<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin MMO Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Be Vietnam Pro', 'Segoe UI', Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(59, 130, 246, .18), transparent 35%),
                radial-gradient(circle at bottom right, rgba(124, 58, 237, .18), transparent 35%),
                #060c1a;
            color: #e2e8f0;
        }

        .admin-sidebar {
            width: 270px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: rgba(15, 23, 42, .92);
            border-right: 1px solid rgba(148, 163, 184, .12);
            padding: 24px;
            overflow-y: auto;
            box-shadow: 10px 0 40px rgba(0, 0, 0, .35);
            backdrop-filter: blur(18px);
        }

        .admin-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 35px;
        }

        .admin-logo-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: linear-gradient(135deg, #3b82f6, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(59, 130, 246, .45);
            font-size: 22px;
        }

        .admin-logo h4 {
            margin: 0;
            color: white;
            font-weight: 700;
        }

        .admin-logo small {
            color: #94a3b8;
        }

        .admin-menu-title {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 12px;
            letter-spacing: 1px;
        }

        .admin-sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            margin-bottom: 10px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 15px;
            border: 1px solid transparent;
            transition: .25s;
        }

        .admin-sidebar a:hover {
            background: rgba(59, 130, 246, .12);
            border-color: rgba(96, 165, 250, .35);
            color: white;
            transform: translateX(6px);
            box-shadow: 0 0 22px rgba(59, 130, 246, .2);
        }

        .admin-content {
            margin-left: 270px;
            min-height: 100vh;
            padding: 28px;
        }

        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(15, 23, 42, .86);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 24px;
            padding: 18px 24px;
            margin-bottom: 25px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .28);
            backdrop-filter: blur(16px);
        }

        .admin-topbar h3 {
            margin: 0;
            color: white;
            font-weight: 700;
        }

        .admin-topbar p {
            margin: 4px 0 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(135deg, #2563eb, #9333ea);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            box-shadow: 0 0 25px rgba(59, 130, 246, .38);
        }

        .admin-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .admin-user span {
            color: white;
            font-weight: 600;
        }

        .admin-user small {
            color: #94a3b8;
            display: block;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: rgba(15, 23, 42, .86);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 22px;
            padding: 22px;
            position: relative;
            overflow: hidden;
            transition: .25s;
            box-shadow: 0 18px 40px rgba(0, 0, 0, .26);
        }

        .stat-card::before {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            right: -35px;
            top: -35px;
            background: rgba(59, 130, 246, .2);
            filter: blur(10px);
            border-radius: 50%;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            border-color: rgba(96, 165, 250, .4);
            box-shadow: 0 0 35px rgba(59, 130, 246, .25);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 16px;
            font-size: 20px;
        }

        .stat-card span {
            color: #94a3b8;
            font-size: 13px;
        }

        .stat-card h4 {
            margin: 8px 0 0;
            color: white;
            font-size: 28px;
            font-weight: 800;
        }

        .admin-panel {
            background: rgba(15, 23, 42, .86);
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .28);
        }

        .card,
        .table,
        .modal-content {
            background: #0f172a !important;
            color: #e2e8f0 !important;
            border-color: #1e293b !important;
        }

        table {
            color: #e2e8f0 !important;
        }

        thead {
            background: #111827 !important;
        }

        thead th {
            color: #94a3b8 !important;
            border-color: #1e293b !important;
        }

        tbody td {
            border-color: #1e293b !important;
            color: #e2e8f0 !important;
        }

        tbody tr {
            transition: .2s;
        }

        tbody tr:hover {
            background: rgba(59, 130, 246, .08) !important;
        }

        input,
        select,
        textarea {
            background: #111827 !important;
            color: white !important;
            border: 1px solid #334155 !important;
            border-radius: 12px !important;
        }

        .btn {
            border-radius: 12px !important;
            transition: .25s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        @media(max-width: 1000px) {
            .admin-sidebar {
                width: 230px;
            }

            .admin-content {
                margin-left: 230px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 760px) {
            .admin-sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .admin-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="admin-sidebar">

        <div class="admin-logo">
            <div class="admin-logo-icon">
                <i class="fa-solid fa-headset"></i>
            </div>

            <div>
                <h4>MMO ADMIN</h4>
                <small>Control Panel</small>
            </div>
        </div>

        <div class="admin-menu-title">Quản lý hệ thống</div>

        <a href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.accounts') }}">
            <i class="fa-solid fa-box"></i>
            Accounts
        </a>

        <a href="{{ route('admin.categories.index') }}">
            <i class="fa-solid fa-layer-group"></i>
            Categories
        </a>

        <a href="/admin/services">
            <i class="fa-solid fa-satellite-dish"></i>
            AI Support Desk
        </a>

        <a href="{{ route('admin.users.index') }}">
            <i class="fa-solid fa-users"></i>
            Users
        </a>

        <a href="/">
            <i class="fa-solid fa-house"></i>
            Về trang chủ
        </a>

    </div>

    <div class="admin-content">

        <div class="admin-topbar">
            <div>
                <h3>Dashboard</h3>
                <p>Quản trị hệ thống MMO, tài khoản, user và giao dịch.</p>
            </div>

            <div class="admin-user">
                <div class="admin-avatar">
                    @if (auth()->user()?->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                            alt="Ảnh đại diện của {{ auth()->user()->name ?? 'Admin' }}">
                    @else
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    @endif
                </div>

                <div>
                    <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                    <small>Administrator</small>
                </div>
            </div>
        </div>

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <span>Tổng Users</span>
                <h4>{{ $totalUsers ?? 0 }}</h4>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <span>Tổng Accounts</span>
                <h4>{{ $totalAccounts ?? 0 }}</h4>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <span>Đơn đã bán</span>
                <h4>{{ $totalOrders ?? 0 }}</h4>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <span>Doanh thu</span>
                <h4>{{ number_format($totalRevenue ?? 0) }}đ</h4>
            </div>

        </div>

        <div class="admin-panel">
            @yield('content')
        </div>

    </div>

    @include('components.mmo-notifications')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
