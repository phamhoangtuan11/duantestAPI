@extends('layouts.mmo')
@section('content')
{{-- {{ dd($accounts) }} --}}
<div class="mmo">

    <!-- SIDEBAR -->
    {{-- <div class="sidebar">
        <div class="logo">TRUNGMAN<span>MMO</span></div>

        <a class="active">🏠 Trang chủ</a>
        <a>📦 Tài khoản</a>
        <a>🛠 Dịch vụ</a>
        <a>💰 Nạp tiền</a>
    </div> --}}

    <!-- MAIN -->
    <div class="main">

        <!-- TOP -->
        <div class="top">
            <div>
                <small>TRANG CHỦ</small>
                <h3>CHÀO MỪNG TRỞ LẠI, KHÁCH</h3>
            </div>

            <button class="btn-start">Bắt đầu ngay</button>
        </div>

        <!-- SERVICES -->
        <h5 class="section-title">DỊCH VỤ NỔI BẬT</h5>

        <div class="service-grid">

            @php $i = 1; @endphp
            @foreach([
                'Tăng tương tác',
                'Auto MXH',
                'Tài nguyên',
                'AI Manager',
                'Chat Support',
                'Forum MMO',
                'Find Job',
                'Chợ MMO'
            ] as $item)

            <div class="service-box">
                <span class="number">{{ str_pad($i++, 2, '0', STR_PAD_LEFT) }}</span>
                <div class="content">
                    <h6>{{ $item }}</h6>
                    <p>Dịch vụ MMO chất lượng cao</p>
                </div>
            </div>

            @endforeach

        </div>

        <!-- ACCOUNT -->
<h5 class="section-title mt-4">TÀI KHOẢN</h5>
<!-- FILTER CATEGORY -->
<div style="margin-bottom:15px;">
    <button onclick="loadAccounts('')">Tất cả</button>
    <button onclick="loadAccounts('facebook')">Facebook</button>
    <button onclick="loadAccounts('tiktok')">TikTok</button>
</div>

<div id="account-list" class="service-grid"></div>

<script src="/js/account.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadAccounts();
    });
</script>
    </div>
</div>

@endsection