@extends('admin.layout')

@section('content')
    

    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card-custom p-4">
                <h5>Tổng Users</h5>
                <h2>{{ $totalUsers ?? 0 }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-custom p-4">
                <h5>Tổng Account</h5>
                <h2>{{ $totalAccounts ?? 0 }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-custom p-4">
                <h5>Đơn đã bán</h5>
                <h2>{{ $totalOrders ?? 0 }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-custom p-4">
                <h5>Doanh thu</h5>
                <h2>{{ number_format($totalRevenue ?? 0) }}đ</h2>
            </div>
        </div>

    </div>
@endsection
