@extends('admin.layout')

@section('content')
    <style>
        /* HEADER */
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .category-title h2 {
            color: white;
            font-size: 38px;
            font-weight: 800;
            margin: 0;
        }

        .category-title p {
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

        /* TABLE */
        .category-table-box {
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
        }

        /* ID */
        .category-id {
            color: #60a5fa;
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

            box-shadow:
                0 0 20px rgba(245, 158, 11, .45);
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .delete-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 0 20px rgba(239, 68, 68, .45);
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

        /* INPUT */
        .form-control {
            background: #111827 !important;

            border: 1px solid #334155 !important;

            color: white !important;

            border-radius: 14px !important;

            padding: 14px !important;
        }

        .form-control:focus {
            box-shadow:
                0 0 0 3px rgba(59, 130, 246, .25) !important;

            border-color: #3b82f6 !important;
        }

        /* SAVE BTN */
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

    <div class="category-header">

        <div class="category-title">
            <h2>Quản lý Category</h2>
            <p>Quản lý danh mục dịch vụ MMO hệ thống</p>
        </div>

        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">
            + Thêm Category
        </button>

    </div>

    <div class="category-table-box">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($categories as $cate)
                    <tr>

                        <td>
                            <span class="category-id">
                                #{{ $cate->id }}
                            </span>
                        </td>

                        <td>{{ $cate->name }}</td>

                        <td>{{ $cate->slug }}</td>

                        <td>

                            <!-- EDIT -->
                            <button class="action-btn edit-btn" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $cate->id }}">
                                ✏️ Sửa
                            </button>

                            <!-- DELETE -->
                            <form action="{{ route('admin.categories.destroy', $cate->id) }}" method="POST"
                                style="display:inline;" data-confirm="Xóa category này? Hành động này không thể hoàn tác."
                                data-confirm-title="Xóa category" data-confirm-button="Xóa">

                                @csrf
                                @method('DELETE')

                                <button class="action-btn delete-btn">
                                    🗑 Xoá
                                </button>

                            </form>

                        </td>

                    </tr>

                    <!-- EDIT MODAL -->
                    <div class="modal fade" id="edit{{ $cate->id }}">

                        <div class="modal-dialog">

                            <form method="POST" action="{{ route('admin.categories.update', $cate->id) }}">

                                @csrf
                                @method('PUT')

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Sửa Category
                                        </h5>
                                    </div>

                                    <div class="modal-body">

                                        <input type="text" name="name" value="{{ $cate->name }}"
                                            class="form-control mb-3">

                                        <input type="text" name="slug" value="{{ $cate->slug }}"
                                            class="form-control">

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

            <form method="POST" action="{{ route('admin.categories.store') }}">

                @csrf

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Thêm Category
                        </h5>
                    </div>

                    <div class="modal-body">

                        <input type="text" name="name" placeholder="Tên category" class="form-control mb-3">

                        <input type="text" name="slug" placeholder="Slug category" class="form-control">

                    </div>

                    <div class="modal-footer">

                        <button class="save-btn">
                            + Thêm Category
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>
@endsection
