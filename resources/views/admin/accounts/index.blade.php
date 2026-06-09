@extends('admin.layout')

@section('content')
    <style>
        /* HEADER */
        .account-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .account-title h2 {
            color: white;
            font-size: 38px;
            font-weight: 800;
            margin: 0;
        }

        .account-title p {
            color: #94a3b8;
            margin-top: 6px;
        }

        /* BUTTON */
        .add-btn {
            border: none;
            padding: 14px 22px;
            border-radius: 18px;

            background: linear-gradient(135deg, #3b82f6, #2563eb);

            color: white;
            font-weight: 700;

            transition: .25s;

            box-shadow:
                0 0 25px rgba(59, 130, 246, .35);
        }

        .add-btn:hover {
            transform: translateY(-3px);
            box-shadow:
                0 0 40px rgba(59, 130, 246, .55);
        }

        /* FILTER */
        .filter-box {
            background: rgba(15, 23, 42, .9);

            border: 1px solid rgba(148, 163, 184, .12);

            border-radius: 22px;

            padding: 20px;

            margin-bottom: 25px;
        }

        .filter-form {
            display: flex;
            gap: 14px;
        }

        .filter-form select {
            max-width: 260px;
        }

        /* TABLE */
        .account-table-box {
            background: rgba(15, 23, 42, .88);

            border: 1px solid rgba(148, 163, 184, .12);

            border-radius: 24px;

            overflow: hidden;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, .35);
        }

        .table {
            margin: 0;
        }

        .table thead th {
            background: #0b1220 !important;

            color: #93c5fd !important;

            border: none !important;

            padding: 20px;

            font-size: 14px;
            letter-spacing: .5px;
        }

        .table tbody td {
            background: #111827 !important;

            color: #e2e8f0 !important;

            border-color: #1e293b !important;

            padding: 18px;

            vertical-align: middle;
        }

        .table tbody tr {
            transition: .25s;
        }

        .table tbody tr:hover td {
            background: #172033 !important;

            transform: scale(1.002);
        }

        /* BADGE */
        .account-id {
            color: #60a5fa;
            font-weight: 700;
        }

        .price {
            color: #22c55e;
            font-weight: 700;
        }

        /* ACTION */
        .action-btn {
            border: none;

            padding: 10px 14px;

            border-radius: 12px;

            font-size: 13px;
            font-weight: 700;

            transition: .25s;
        }

        .edit-btn {
            background: #f59e0b;
            color: #111827;
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(245, 158, 11, .45);
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .delete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(239, 68, 68, .45);
        }

        /* MODAL */
        .modal-content {
            background: #0f172a !important;

            border: 1px solid #1e293b !important;

            border-radius: 24px !important;

            color: white;
        }

        .modal-header {
            border-color: #1e293b !important;
        }

        .modal-footer {
            border-color: #1e293b !important;
        }

        .modal-title {
            font-weight: 700;
        }

        .form-control,
        .form-select {
            background: #111827 !important;

            border: 1px solid #334155 !important;

            color: white !important;

            border-radius: 14px !important;

            padding: 14px !important;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow:
                0 0 0 3px rgba(59, 130, 246, .25) !important;

            border-color: #3b82f6 !important;
        }

        /* SAVE BUTTON */
        .save-btn {
            border: none;

            padding: 12px 18px;

            border-radius: 14px;

            background: linear-gradient(135deg, #22c55e, #16a34a);

            color: white;

            font-weight: 700;

            transition: .25s;
        }

        .save-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 0 25px rgba(34, 197, 94, .35);
        }
    </style>

    <div class="account-header">

        <div class="account-title">
            <h2>Quản lý Accounts</h2>
            <p>Quản lý tài khoản MMO, Facebook, TikTok, Instagram...</p>
        </div>

        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">
            + Thêm Account
        </button>

    </div>

    <div class="filter-box">

        <form method="GET" class="filter-form">

            <select name="category_id" class="form-select">

                <option value="">-- Tất cả danh mục --</option>

                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}" {{ request('category_id') == $cate->id ? 'selected' : '' }}>
                        {{ $cate->name }}
                    </option>
                @endforeach

            </select>

            <button class="add-btn" type="submit">
                Lọc
            </button>

        </form>

    </div>

    <div class="account-table-box">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Username</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($accounts as $acc)
                    <tr>

                        <td>
                            <span class="account-id">
                                #{{ $acc->id }}
                            </span>
                        </td>

                        <td>{{ $acc->title }}</td>

                        <td>{{ $acc->username }}</td>

                        <td class="price">
                            {{ number_format($acc->price) }}đ
                        </td>

                        <td>
                            {{ $acc->category->name ?? 'N/A' }}
                        </td>

                        <td>

                            <button class="action-btn edit-btn" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $acc->id }}">
                                ✏️ Sửa
                            </button>

                            <form action="{{ route('admin.accounts.destroy', $acc->id) }}" method="POST"
                                style="display:inline" data-confirm="Xóa account này? Hành động này không thể hoàn tác."
                                data-confirm-title="Xóa account" data-confirm-button="Xóa">

                                @csrf
                                @method('DELETE')

                                <button class="action-btn delete-btn">
                                    🗑 Xoá
                                </button>

                            </form>

                        </td>

                    </tr>

                    <!-- EDIT MODAL -->
                    <div class="modal fade" id="edit{{ $acc->id }}">

                        <div class="modal-dialog">

                            <form method="POST" action="{{ route('admin.accounts.update', $acc->id) }}">

                                @csrf
                                @method('PUT')

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Sửa Account
                                        </h5>
                                    </div>

                                    <div class="modal-body">

                                        <input name="title" value="{{ $acc->title }}" class="form-control mb-3">

                                        <input name="username" value="{{ $acc->username }}" class="form-control mb-3">

                                        <input name="price" value="{{ $acc->price }}" class="form-control mb-3">

                                        <select name="category_id" class="form-select">

                                            @foreach ($categories as $cate)
                                                <option value="{{ $cate->id }}"
                                                    {{ $acc->category_id == $cate->id ? 'selected' : '' }}>
                                                    {{ $cate->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="modal-footer">

                                        <button class="save-btn">
                                            Cập nhật
                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>
                @endforeach

            </tbody>

        </table>

    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="addModal">

        <div class="modal-dialog">

            <form method="POST" action="{{ route('admin.accounts.store') }}">

                @csrf

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Thêm Account
                        </h5>
                    </div>

                    <div class="modal-body">

                        <input name="title" placeholder="Tiêu đề" class="form-control mb-3">

                        <input name="username" placeholder="Username" class="form-control mb-3">

                        <input name="price" placeholder="Giá" class="form-control mb-3">

                        <select name="category_id" class="form-select">

                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}">
                                    {{ $cate->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="modal-footer">

                        <button class="save-btn">
                            + Thêm Account
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>
@endsection
