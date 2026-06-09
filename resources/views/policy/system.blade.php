@extends('layouts.app')

@section('content')

<style>
body{
    background:#0b0b0f !important;
    color:rgb(13, 13, 13);
}

/* MAIN */
.policy-wrapper{
    display:flex;
    gap:22px;
    padding:20px;
}

/* SIDEBAR */
.policy-sidebar{
    width:280px;
    background:rgba(17,17,17,0.92);
    border:1px solid rgba(255,255,255,0.06);
    border-radius:24px;
    padding:28px 22px;
    backdrop-filter:blur(12px);
    box-shadow:
        0 0 0 1px rgba(255,255,255,0.03),
        0 20px 50px rgba(0,0,0,0.45);
    height:fit-content;
}

.policy-sidebar h2{
    font-size:42px;
    margin:0;
    font-weight:700;
    color:white;
}

.policy-sidebar p{
    color:#8d8d95;
    margin-top:10px;
    line-height:1.7;
    font-size:15px;
}

/* MENU */
.policy-menu{
    margin-top:28px;
}

.policy-item{
    display:flex;
    align-items:center;
    gap:16px;
    padding:18px;
    border-radius:20px;
    margin-bottom:16px;
    background:rgba(255,255,255,0.02);
    border:1px solid rgba(255,255,255,0.05);
    transition:0.25s;
    cursor:pointer;
}

.policy-item:hover{
    transform:translateY(-2px);
    border-color:rgba(96,165,250,0.4);
    background:rgba(255,255,255,0.04);
}

.policy-number{
    width:56px;
    height:56px;
    border-radius:18px;
    background:rgba(255,255,255,0.05);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    color:#60a5fa;
    font-size:20px;
}

.policy-title{
    color:white;
    font-size:21px;
    font-weight:700;
}

.policy-desc{
    color:#8b8b95;
    font-size:14px;
    margin-top:4px;
}

/* CONTENT */
.policy-content{
    flex:1;
    background:rgba(17,17,17,0.92);
    border:1px solid rgba(255,255,255,0.06);
    border-radius:26px;
    padding:40px;
    backdrop-filter:blur(12px);
    box-shadow:
        0 0 0 1px rgba(255,255,255,0.03),
        0 20px 50px rgba(0,0,0,0.45);
}

/* TOP */
.policy-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:30px;
}

/* BACK BUTTON */
.back-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:13px 20px;
    border-radius:16px;
    background:#111827;
    border:1px solid rgba(255,255,255,0.08);
    color:white;
    text-decoration:none;
    font-weight:600;
    transition:0.25s;
}

.back-btn:hover{
    background:#1f2937;
    border-color:#60a5fa;
    transform:translateY(-2px);
}

/* HEADER */
.policy-header h1{
    font-size:64px;
    line-height:1.1;
    margin:0;
    font-weight:800;
    color:white;
}

.policy-header p{
    margin-top:16px;
    color:#8d8d95;
    font-size:22px;
}

/* BOX */
.policy-box{
    margin-top:35px;
    background:rgba(255,255,255,0.02);
    border:1px solid rgba(255,255,255,0.05);
    border-radius:24px;
    padding:42px;
}

/* TITLES */
.policy-box h2{
    color:#60a5fa;
    font-size:34px;
    margin-top:45px;
    margin-bottom:22px;
}

.policy-box h3{
    color:white;
    margin-top:25px;
}

/* TEXT */
.policy-box p{
    color:#d1d5db;
    font-size:19px;
    line-height:2;
    margin-bottom:22px;
}

.policy-box li{
    color:#d1d5db;
    font-size:19px;
    line-height:2;
    margin-bottom:12px;
}

/* FOOTER */
.policy-footer{
    margin-top:50px;
    padding-top:25px;
    border-top:1px solid rgba(255,255,255,0.08);
    text-align:center;
    color:#8b8b95;
    font-size:15px;
}

/* SCROLLBAR */
::-webkit-scrollbar{
    width:10px;
}

::-webkit-scrollbar-track{
    background:#0b0b0f;
}

::-webkit-scrollbar-thumb{
    background:#2b2b31;
    border-radius:10px;
}

::-webkit-scrollbar-thumb:hover{
    background:#3d3d46;
}

/* TOP NAVBAR */
.navbar,
header,
.topbar{
    background: rgba(17,17,17,0.92) !important;

    border-bottom: 1px solid rgba(255,255,255,0.06) !important;

    backdrop-filter: blur(12px);

    box-shadow:
        0 0 0 1px rgba(255,255,255,0.03),
        0 10px 30px rgba(0,0,0,0.35);
}

/* TEXT NAVBAR */
.navbar a,
.navbar span,
.navbar-brand,
header a,
header span{
    color:white !important;
}

/* REMOVE WHITE */
.bg-white{
    background: rgba(17,17,17,0.92) !important;
}
body{
    background:#0b0b0f !important;
}
</style>

<div class="policy-wrapper">

    <!-- LEFT -->
    <div class="policy-sidebar">

        <h2>📘 Chính Sách</h2>

        <p>
            Dịch vụ · Pháp lý · Quy định hệ thống
        </p>

        <div class="policy-menu">

            <div class="policy-item">
                <div class="policy-number">01</div>

                <div>
                    <div class="policy-title">
                        Chính sách chung
                    </div>

                    <div class="policy-desc">
                        Điều khoản sử dụng
                    </div>
                </div>
            </div>

            <div class="policy-item">
                <div class="policy-number">02</div>

                <div>
                    <div class="policy-title">
                        Dịch vụ Auto MXH
                    </div>

                    <div class="policy-desc">
                        Quy định dịch vụ
                    </div>
                </div>
            </div>

            <div class="policy-item">
                <div class="policy-number">03</div>

                <div>
                    <div class="policy-title">
                        Tăng tương tác
                    </div>

                    <div class="policy-desc">
                        Chính sách vận hành
                    </div>
                </div>
            </div>

            <div class="policy-item">
                <div class="policy-number">04</div>

                <div>
                    <div class="policy-title">
                        Sàn trung gian số
                    </div>

                    <div class="policy-desc">
                        Bảo mật & thanh toán
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="policy-content">

        <div class="policy-top">

            <a href="{{ url()->previous() }}" class="back-btn">
                ← Quay Lại
            </a>

        </div>

        <div class="policy-header">

            <h1>Chính Sách Hệ Thống</h1>

            <p>
                Văn bản pháp lý và điều khoản sử dụng hệ thống TRUNGMAN MMO
            </p>

        </div>

        <div class="policy-box">

            <h2>CHÍNH SÁCH VÀ ĐIỀU KHOẢN</h2>

            <p>
                Văn bản này quy định các điều khoản sử dụng dịch vụ,
                chính sách bảo mật thông tin và quy định xử lý dữ liệu cá nhân
                áp dụng cho toàn bộ người dùng khi sử dụng hệ thống.
            </p>

            <p>
                Việc đăng ký tài khoản, đăng nhập, nạp tiền,
                tạo đơn hàng hoặc sử dụng dịch vụ được xem là
                người dùng đã đồng ý toàn bộ nội dung điều khoản.
            </p>

            <h2>ĐIỀU 1. GIẢI THÍCH THUẬT NGỮ</h2>

            <p>
                “Hệ thống” là nền tảng website cung cấp các dịch vụ MMO,
                Auto mạng xã hội và giao dịch tài khoản số.
            </p>

            <p>
                “Người dùng” là cá nhân hoặc tổ chức sử dụng dịch vụ
                trên hệ thống.
            </p>

            <p>
                “Dịch vụ” bao gồm các dịch vụ auto/bán tự động,
                xử lý tài khoản, tương tác mạng xã hội,
                bảo vệ, khôi phục và các dịch vụ kỹ thuật khác.
            </p>

            <h2>ĐIỀU 2. ĐIỀU KIỆN SỬ DỤNG</h2>

            <ul>
                <li>Người dùng phải cung cấp thông tin chính xác.</li>

                <li>Tự chịu trách nhiệm bảo mật tài khoản.</li>

                <li>Không sử dụng hệ thống vào mục đích vi phạm pháp luật.</li>

                <li>Không spam hoặc gây ảnh hưởng hệ thống.</li>
            </ul>

            <h2>ĐIỀU 3. THANH TOÁN & NẠP TIỀN</h2>

            <p>
                Toàn bộ giao dịch nạp tiền được quy đổi thành số dư hệ thống.
            </p>

            <p>
                Người dùng có trách nhiệm kiểm tra đúng thông tin trước khi thanh toán.
            </p>

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
                Hệ thống không chịu trách nhiệm đối với các thay đổi
                từ nền tảng bên thứ ba như Facebook, TikTok,
                Instagram hoặc Google.
            </p>

            <p>
                Người dùng tự chịu trách nhiệm đối với mục đích sử dụng dịch vụ.
            </p>

            <div class="policy-footer">
                © 2025 TRUNG TÂM MMO - Chính sách hệ thống
            </div>

        </div>

    </div>

</div>

@endsection