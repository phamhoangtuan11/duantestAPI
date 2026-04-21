@extends('admin.layout')

@section('content')
{{-- {{ dd($accounts) }} --}}
<div class="card card-custom p-3">

    <div class="d-flex justify-content-between mb-3">
        <h4>📦 Danh sách account</h4>

        <a href="/admin/accounts/create" class="btn btn-primary">
            + Thêm account
        </a>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Username</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
        @foreach($accounts as $acc)
            <tr>
                <td>{{ $acc->id }}</td>
                <td>{{ $acc->title }}</td>
                <td>{{ $acc->username }}</td>
                <td class="text-danger fw-bold">
                    {{ number_format($acc->price) }} VND
                </td>
                <td>{{ $acc->category->name ?? 'Không có' }}</td>
                <td>
                    <a href="/admin/accounts/{{ $acc->id }}/edit"
                       class="btn btn-warning btn-sm">
                        Sửa
                    </a>

                    <form action="/admin/accounts/{{ $acc->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Xoá thật không?')">
                            Xoá
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

</div>

@endsection