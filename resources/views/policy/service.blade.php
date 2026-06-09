@extends('layouts.app')

@section('content')

<style>
body{
    background:#070b14 !important;
    color:#e5e7eb !important;
}

.policy-wrapper{
    position:relative;
    display:grid;
    grid-template-columns:300px 1fr;
    gap:24px;
    padding:28px;
    min-height:100vh;
    background:
        radial-gradient(circle at top left, rgba(59,130,246,.18), transparent 35%),
        radial-gradient(circle at bottom right, rgba(124,58,237,.16), transparent 35%),
        #070b14;
}

/* SIDEBAR */
.policy-sidebar{
    position:sticky;
    top:24px;
    height:fit-content;
    background:rgba(15,23,42,.78);
    border:1px solid rgba(148,163,184,.14);
    border-radius:26px;
    padding:24px;
    backdrop-filter:blur(18px);
    box-shadow:0 24px 60px rgba(0,0,0,.35);
}

.policy-sidebar h2{
    margin:0;
    font-size:32px;
    color:white;
}

.policy-sidebar p{
    color:#94a3b8;
    margin:10px 0 24px;
}

.policy-item{
    display:flex;
    gap:14px;
    align-items:center;
    padding:16px;
    margin-bottom:14px;
    border-radius:18px;
    background:rgba(255,255,255,.035);
    border:1px solid rgba(255,255,255,.06);
    transition:.25s;
    cursor:pointer;
}

.policy-item:hover{
    transform:translateY(-3px);
    border-color:#3b82f6;
    box-shadow:0 0 24px rgba(59,130,246,.22);
}

.policy-number{
    min-width:46px;
    height:46px;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#1e3a8a,#2563eb);
    color:#bfdbfe;
    font-weight:800;
}

.policy-title{
    color:white;
    font-weight:700;
}

.policy-desc{
    color:#94a3b8;
    font-size:13px;
    margin-top:3px;
}

/* CONTENT */
.policy-content{
    background:rgba(15,23,42,.78);
    border:1px solid rgba(148,163,184,.14);
    border-radius:30px;
    padding:34px;
    backdrop-filter:blur(18px);
    box-shadow:0 24px 60px rgba(0,0,0,.35);
}

.back-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:12px 18px;
    border-radius:16px;
    background:rgba(15,23,42,.9);
    border:1px solid rgba(148,163,184,.16);
    color:white;
    text-decoration:none;
    font-weight:700;
    transition:.25s;
}

.back-btn:hover{
    transform:translateY(-2px);
    border-color:#60a5fa;
    box-shadow:0 0 24px rgba(96,165,250,.25);
}

.policy-header{
    margin:28px 0 32px;
}

.policy-tag{
    display:inline-block;
    padding:8px 14px;
    border-radius:999px;
    background:rgba(59,130,246,.15);
    color:#93c5fd;
    border:1px solid rgba(96,165,250,.25);
    margin-bottom:18px;
    font-size:13px;
    font-weight:700;
}

.policy-header h1{
    margin:0;
    font-size:52px;
    line-height:1.08;
    color:white;
}

.policy-header p{
    color:#94a3b8;
    font-size:18px;
    line-height:1.7;
}

/* BOX */
.policy-box{
    background:rgba(2,6,23,.52);
    border:1px solid rgba(148,163,184,.12);
    border-radius:26px;
    padding:34px;
}

.policy-box h2{
    color:#60a5fa;
    font-size:28px;
    margin:38px 0 18px;
}

.policy-box h2:first-child{
    margin-top:0;
}

.policy-box p,
.policy-box li{
    color:#d1d5db;
    font-size:17px;
    line-height:1.9;
}

.policy-box li{
    margin-bottom:10px;
}

.policy-footer{
    margin-top:44px;
    padding-top:22px;
    border-top:1px solid rgba(148,163,184,.14);
    color:#94a3b8;
    text-align:center;
}

/* RESPONSIVE */
@media(max-width:1000px){
    .policy-wrapper{
        grid-template-columns:1fr;
    }

    .policy-sidebar{
        position:relative;
        top:0;
    }

    .policy-header h1{
        font-size:38px;
    }
}
</style>

<div class="policy-wrapper">

    <aside class="policy-sidebar">
        <h2>📘 Chính Sách</h2>
        <p>Dịch vụ · Pháp lý · Quy định hệ thống</p>

        <div class="policy-item">
            <div class="policy-number">01</div>
            <div>
                <div class="policy-title">Chính sách chung</div>
                <div class="policy-desc">Điều khoản sử dụng</div>
            </div>
        </div>

        <div class="policy-item">
            <div class="policy-number">02</div>
            <div>
                <div class="policy-title">Dịch vụ Auto MXH</div>
                <div class="policy-desc">Quy định dịch vụ</div>
            </div>
        </div>

        <div class="policy-item">
            <div class="policy-number">03</div>
            <div>
                <div class="policy-title">Tăng tương tác</div>
                <div class="policy-desc">Chính sách vận hành</div>
            </div>
        </div>

        <div class="policy-item">
            <div class="policy-number">04</div>
            <div>
                <div class="policy-title">Thanh toán</div>
                <div class="policy-desc">Bảo mật & số dư</div>
            </div>
        </div>
    </aside>

    <main class="policy-content">

        <a href="{{ url('/') }}" class="back-btn">← Quay về trang chủ</a>

        <div class="policy-header">
            <div class="policy-tag">DỊCH VỤ · PHÁP LÝ</div>

            <h1>Chính Sách Dịch Vụ</h1>

            <p>
                Văn bản pháp lý và điều khoản sử dụng hệ thống TRUNG TÂM MMO.
                Khi sử dụng dịch vụ, người dùng được xem là đã đồng ý với các quy định dưới đây.
            </p>
        </div>

        <div class="policy-box">

            <h2>CHÍNH SÁCH VÀ ĐIỀU KHOẢN</h2>

            <p>
                Văn bản này quy định các điều khoản sử dụng dịch vụ, chính sách bảo mật thông tin
                và quy định xử lý dữ liệu cá nhân áp dụng cho toàn bộ người dùng khi sử dụng hệ thống.
            </p>

            <p>
                Việc đăng ký tài khoản, đăng nhập, nạp tiền, tạo đơn hàng hoặc sử dụng dịch vụ
                được xem là người dùng đã đồng ý toàn bộ nội dung điều khoản.
            </p>

            <h2>ĐIỀU 1. GIẢI THÍCH THUẬT NGỮ</h2>

            <p>
                “Hệ thống” là nền tảng website cung cấp các dịch vụ MMO,
                Auto mạng xã hội và giao dịch tài khoản số.
            </p>

            <p>
                “Người dùng” là cá nhân hoặc tổ chức sử dụng dịch vụ trên hệ thống.
            </p>

            <p>
                “Dịch vụ” bao gồm các dịch vụ auto/bán tự động, xử lý tài khoản,
                tương tác mạng xã hội, bảo vệ, khôi phục và các dịch vụ kỹ thuật khác.
            </p>

            <h2>ĐIỀU 2. ĐIỀU KIỆN SỬ DỤNG</h2>

            <ul>
                <li>Người dùng phải cung cấp thông tin chính xác.</li>
                <li>Tự chịu trách nhiệm bảo mật tài khoản.</li>
                <li>Không sử dụng hệ thống vào mục đích vi phạm pháp luật.</li>
                <li>Không spam hoặc gây ảnh hưởng hệ thống.</li>
            </ul>

            <h2>ĐIỀU 3. THANH TOÁN & NẠP TIỀN</h2>

            <p>Toàn bộ giao dịch nạp tiền được quy đổi thành số dư hệ thống.</p>

            <p>Người dùng có trách nhiệm kiểm tra đúng thông tin trước khi thanh toán.</p>

            <p>
                Hệ thống không hoàn tiền đối với các giao dịch đã hoàn tất,
                trừ trường hợp đặc biệt.
            </p>

            <h2>ĐIỀU 4. QUYỀN HỆ THỐNG</h2>

            <ul>
                <li>Từ chối hoặc khóa tài khoản vi phạm.</li>
                <li>Thay đổi bảng giá và chính sách bất kỳ lúc nào.</li>
                <li>Tạm dừng dịch vụ để nâng cấp hệ thống.</li>
            </ul>

            <h2>ĐIỀU 5. MIỄN TRỪ TRÁCH NHIỆM</h2>

            <p>
                Hệ thống không chịu trách nhiệm đối với các thay đổi từ nền tảng bên thứ ba
                như Facebook, TikTok, Instagram hoặc Google.
            </p>

            <p>Người dùng tự chịu trách nhiệm đối với mục đích sử dụng dịch vụ.</p>

            <div class="policy-footer">
                © 2025 TRUNG TÂM MMO - Chính sách dịch vụ
            </div>

        </div>

    </main>

</div>

@endsection