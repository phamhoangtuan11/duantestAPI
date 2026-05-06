<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>MMO</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #0f172a;
            color: white;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            background: #020617;
            padding: 20px;
        }

        .main {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
    <style>
        body {
            margin: 0;
            background: #060c1a;
            font-family: 'Segoe UI', sans-serif;
            color: white;
        }

        /* layout */
        .mmo {
            display: flex;
        }

        /* sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: linear-gradient(180deg, #0f172a, #020617);
            padding: 20px;
        }

        .logo {
            font-weight: bold;
            margin-bottom: 30px;
        }

        .logo span {
            color: #3b82f6;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            color: #94a3b8;
            border-radius: 6px;
            cursor: pointer;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1e293b;
            color: white;
        }

        /* main */
        .main {
            flex: 1;
            padding: 25px;
        }

        /* top */
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            padding: 20px;
            border-radius: 12px;
        }

        /* button */
        .btn-start {
            background: white;
            color: black;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        /* section */
        .section-title {
            margin: 25px 0 15px;
            color: #cbd5f5;
        }

        /* grid */
        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        /* box */
        .service-box {
            position: relative;
            background: #0f172a;
            border: 1px solid #1e293b;
            padding: 20px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .service-box:hover {
            transform: translateY(-6px);
            border-color: #3b82f6;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        /* number */
        .number {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            color: #334155;
        }

        /* content */
        .content h6 {
            margin: 0;
        }

        .content p {
            font-size: 12px;
            color: #94a3b8;
        }

        /* account */
        .account .price {
            margin-top: 10px;
            color: #f43f5e;
            font-weight: bold;
        }

        .sidebar a {
            text-decoration: none;
            /* bỏ gạch chân */
        }

        /* Ẩn submenu mặc định */
        .submenu {
            display: none;
            margin-top: 10px;
        }

        .icon-link {
            display: flex;
            align-items: center;
            padding: 8px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }

        .icon-link:hover {
            background-color: #f1f1f1;
            transform: scale(1.05);
        }

        .icon {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            transition: transform 0.3s ease;
        }

        /* Hiệu ứng động khi hover qua icon */
        .icon-link:hover .icon {
            transform: rotate(360deg);
        }

        .material-icons {
            font-size: 40px;
            /* Thay đổi kích thước biểu tượng */
        }

        /* profile */
        /* wrapper giữ vị trí */
        /* TOP MENU */
        /* Đổi màu background thành màu đen */
        .top-menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0f172a;
            /* Màu xanh đen nhạt */
            padding: 15px 30px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .sidebar {
            z-index: 1;
        }

        /* SEARCH */
        .search-container {
            display: flex;
            gap: 8px;
        }

        .search-container input {
            padding: 6px 10px;
            border-radius: 6px;
            border: none;
            outline: none;
            background-color: #0f172a;
            /* Để input không bị mất tính đồng bộ */
            color: white;
        }

        .search-container button {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        .search-container button:hover {
            background: #2563eb;
            /* Đổi màu khi hover */
        }

        /* USER */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .username {
            font-size: 14px;
            color: #e2e8f0;
        }

        /* DROPDOWN */
        .dropdown {
            position: relative;
            z-index: 9999;
        }

        .dropdown-btn {
            background: #0f172a;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .dropdown-btn:hover {
            background: #1e293b;
        }

        /* MENU */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: #020617;
            border: 1px solid #1e293b;
            border-radius: 10px;
            width: 170px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        /* ITEM */
        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            width: 100%;
            padding: 10px;
            color: #cbd5e1;
            background: none;
            border: none;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
        }

        /* HOVER */
        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #1e293b;
            color: #3b82f6;
        }

        /* SHOW */
        /* .dropdown:hover .dropdown-menu {
    display: block;
} */
        .dropdown-menu.show {
            display: block;
        }

        /* số dư ví */
        .wallet-container {
            background: #1e293b;
            border-radius: 8px;
            padding: 8px 15px;
            gap: 10px;
        }

        .wallet-icon {
            font-size: 18px;
            color: #3b82f6;
        }

        .wallet-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .balance {
            color: #e2e8f0;
            font-size: 14px;
        }

        .add-money-btn {
            background-color: #3b82f6;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .add-money-btn:hover {
            background-color: #2563eb;
        }
        /* ngôn ngữ */
       /* Tạo kiểu dáng cho icon ngôn ngữ */
.language-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 24px; /* Kích thước cho biểu tượng */
    color: #cbd5e1;  /* Màu sáng cho biểu tượng */
    padding: 8px;
}

/* Hiệu ứng hover cho icon */
.language-btn:hover {
    color: #3b82f6; /* Màu sáng hơn khi hover */
}

/* Tạo kiểu dáng cho phần lựa chọn ngôn ngữ */
#language-options {
    position: absolute; /* Đảm bảo rằng phần lựa chọn ngôn ngữ không làm xáo trộn layout */
    background: #020617;  /* Màu nền của phần lựa chọn ngôn ngữ */
    border-radius: 8px; /* Bo tròn các góc */
    width: 150px; /* Đặt chiều rộng cho danh sách lựa chọn */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Đổ bóng cho phần lựa chọn ngôn ngữ */
    z-index: 1000; /* Đảm bảo các phần tử khác không che khuất */
    display: none; /* Ẩn phần lựa chọn ngôn ngữ mặc định */
    margin-top: 10px;
}

/* Kiểu dáng cho các mục trong lựa chọn ngôn ngữ */
#language-options a {
    display: block;
    padding: 10px;
    color: #cbd5e1;  /* Màu văn bản */
    text-decoration: none;
    font-size: 14px;
    border-radius: 6px;  /* Bo tròn góc cho các mục */
}

#language-options a:hover {
    background-color: #1e293b;  /* Nền khi hover */
    color: #3b82f6;  /* Màu chữ khi hover */
}
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <div class="top-menu">

        <!-- SEARCH -->
        <form action="#" method="GET" class="search-container">
            <input type="text" name="q" placeholder="Tìm dịch vụ, tài khoản..." />
            <button type="submit">🔍</button>
        </form>

        <!-- USER -->
        <div class="user-menu">
            {{-- thêm số dư ví --}}
            <div class="wallet-container">
                <div class="wallet-icon">
                    <i class="fas fa-wallet"></i> <!-- Biểu tượng ví -->
                </div>
                <div class="wallet-info">
                    <span class="balance">Số dư: 0 đ</span> <!-- Hiển thị số dư ví -->
                    <button class="add-money-btn">+</button> <!-- Nút cộng thêm tiền vào ví -->
                </div>
            </div>
             <!-- Thêm biểu tượng ngôn ngữ (Globe icon) vào top menu -->
    <button onclick="toggleLanguageOptions()" class="language-btn">
        <i class="fas fa-globe"></i> <!-- Biểu tượng globe -->
    </button>

    <!-- Các lựa chọn ngôn ngữ sẽ được ẩn ban đầu -->
    <div id="language-options" style="display: none;">
        <a href="#" onclick="changeLanguage('en')" data-key="english">🌐 English</a>
        <a href="#" onclick="changeLanguage('vi')" data-key="vietnamese">🌐 Tiếng Việt</a>
    </div>
            
            @auth
                <span class="username">👤 {{ Auth::user()->name }}</span>
            @endauth

            <div class="dropdown">
                <button onclick="toggleUserMenu(event)" class="dropdown-btn">
                    Tài khoản ▼
                </button>
                
                <div id="userMenu" class="dropdown-menu">

                    @guest
                        <a href="{{ route('login') }}">🔐 Đăng nhập</a>
                        <a href="{{ route('register') }}">📝 Đăng ký</a>
                    @endguest

                    @auth
                        <a href="{{ route('profile.edit') }}">👤 Hồ sơ</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">🚪 Đăng xuất</button>
                        </form>
                    @endauth

                </div>
            </div>

        </div>
    </div>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>TRUNGMAN MMO</h4>
        <a href="/">🏠 Trang chủ</a>
        <a href="#">📦 Tài khoản</a>
        {{-- <a href="#">🛠 Dịch vụ</a> --}}
        <a href="#" onclick="toggleMenu()">🛠 Dịch vụ</a>
        <div id="submenu" class="submenu" style="display:none;">
            <a href="#" class="icon-link">
                <span class="material-icons">facebook</span>  Facebook
            </a>
            <a href="#" class="icon-link">
                <span class="material-icons">tiktok</span>  TikTok
            </a>
            <a href="#" class="icon-link">
                <i class="fab fa-youtube"></i> Mở khóa YouTube
            </a>
            <a href="#" class="icon-link">
                <i class="fab fa-instagram"></i> Mở khóa Instagram
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="main">
        @yield('content')
    </div>
    {{-- CallAPI --}}

</body>
{{-- @endsection --}}

<script>
    // Hàm để mở hoặc đóng submenu
    function toggleMenu() {
        var submenu = document.getElementById("submenu");
        if (submenu.style.display === "none") {
            submenu.style.display = "block"; // Hiện submenu
        } else {
            submenu.style.display = "none"; // Ẩn submenu
        }

    }
    // profile

    // mở / đóng menu profile
    function toggleUserMenu(event) {
        event.stopPropagation();

        let menu = document.getElementById("userMenu");
        menu.classList.toggle("show");
    }

    document.addEventListener("click", function() {
        let menu = document.getElementById("userMenu");
        menu.classList.remove("show");
    });
//    ngôn ngữ
function toggleLanguageOptions() {
    const languageOptions = document.getElementById("language-options");
    languageOptions.style.display = (languageOptions.style.display === "none") ? "block" : "none";
}
</script>

</html>
