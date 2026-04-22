@extends('admin.layout')

@section('content')

<h2>Quản lý Category</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Button thêm -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
    + Thêm Category
</button>

<!-- Table -->
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Action</th>
    </tr>

    @foreach($categories as $cate)
    <tr>
        <td>{{ $cate->id }}</td>
        <td>{{ $cate->name }}</td>
        <td>{{ $cate->slug }}</td>
        <td>
            <!-- Sửa -->
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $cate->id }}">
                Sửa
            </button>

            <!-- Xoá -->
            <form action="{{ route('admin.categories.destroy', $cate->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Xoá?')">Xoá</button>
            </form>
        </td>
    </tr>

    <!-- Modal sửa -->
    <div class="modal fade" id="edit{{ $cate->id }}">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.categories.update', $cate->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-content p-3">
                    <h4>Sửa Category</h4>

                    <input type="text" name="name" value="{{ $cate->name }}" class="form-control mb-2">
                    <input type="text" name="slug" value="{{ $cate->slug }}" class="form-control mb-2">

                    <button class="btn btn-success">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    @endforeach
</table>

<!-- Modal thêm -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <div class="modal-content p-3">
                <h4>Thêm Category</h4>

                <input type="text" name="name" placeholder="Tên" class="form-control mb-2">
                <input type="text" name="slug" placeholder="Slug" class="form-control mb-2">

                <button class="btn btn-primary">Thêm</button>
            </div>
        </form>
    </div>
</div>

@endsection