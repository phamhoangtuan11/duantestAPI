@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Quản lý Accounts</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Thêm</button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<form method="GET" style="margin-bottom: 20px;">
    <select name="category_id" class="form-control" style="width:200px; display:inline-block;">
        <option value="">-- Tất cả --</option>

        @foreach($categories as $cate)
            <option value="{{ $cate->id }}"
                {{ request('category_id') == $cate->id ? 'selected' : '' }}>
                {{ $cate->name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">Lọc</button>
</form>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Username</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($accounts as $acc)
                <tr>
                    <td>{{ $acc->id }}</td>
                    <td>{{ $acc->title }}</td>
                    <td>{{ $acc->username }}</td>
                    <td>{{ $acc->price }}</td>
                    <td>{{ $acc->category->name ?? 'N/A' }}</td>

                    <td>
                        <!-- EDIT -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#edit{{ $acc->id }}">Sửa</button>

                        <!-- DELETE -->
                        <form action="{{ route('admin.accounts.destroy', $acc->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Xoá?')" class="btn btn-danger btn-sm">Xoá</button>
                        </form>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <div class="modal fade" id="edit{{ $acc->id }}">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('admin.accounts.update', $acc->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5>Sửa Account</h5>
                                </div>

                                <div class="modal-body">
                                    <input name="title" value="{{ $acc->title }}" class="form-control mb-2">
                                    <input name="username" value="{{ $acc->username }}" class="form-control mb-2">
                                    <input name="price" value="{{ $acc->price }}" class="form-control mb-2">
                                    <input name="category_id" value="{{ $acc->category_id }}" class="form-control">
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-success">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- ADD MODAL -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.accounts.store') }}">
                @csrf

                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5>Thêm Account</h5>
                    </div>

                    <div class="modal-body">
                        <input name="title" placeholder="Title" class="form-control mb-2">
                        <input name="username" placeholder="Username" class="form-control mb-2">
                        <input name="price" placeholder="Price" class="form-control mb-2">
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
