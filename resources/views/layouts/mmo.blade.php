<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMO</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Be Vietnam Pro', 'Segoe UI', Arial, sans-serif;
            background: #0f172a;
            color: white;
        }

        .sidebar {
            width: 300px;
            height: 100vh;

            position: fixed;

            background: linear-gradient(180deg, #0f172a, #020617);

            padding: 20px;

            overflow-y: auto;
            overflow-x: hidden;

            box-sizing: border-box;

            padding-bottom: 100px;

            scrollbar-width: thin;
            scrollbar-color: #334155 #020617;
            box-sizing: border-box;
            padding-bottom: 80px;
        }

        /* SCROLLBAR */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #020617;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #3b82f6;
        }

        .main {
            margin-left: 300px;
            padding: 20px;
        }
    </style>
    <style>
        body {
            margin: 0;
            background: #060c1a;
            font-family: 'Be Vietnam Pro', 'Segoe UI', Arial, sans-serif;
            color: white;
        }

        /* layout */
        .mmo {
            display: flex;
        }

        /* sidebar */
        .sidebar {
            width: 300px;
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
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 13px;
            margin-bottom: 8px;
            color: #94a3b8;
            border: 1px solid transparent;
            border-radius: 14px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 700;
            letter-spacing: .1px;
            transition: background .22s ease, border-color .22s ease, color .22s ease, transform .22s ease, box-shadow .22s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background:
                radial-gradient(circle at 12% 50%, rgba(59, 130, 246, .18), transparent 34%),
                rgba(30, 41, 59, .72);
            border-color: rgba(96, 165, 250, .28);
            color: white;
            transform: translateX(3px);
            box-shadow: inset 3px 0 0 rgba(59, 130, 246, .85), 0 10px 22px rgba(0, 0, 0, .18);
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

        .sidebar-menu-title {
            display: block;
            margin: 8px 0 12px;
            color: #64748b;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .sidebar-nav-icon {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            color: #93c5fd;
            background:
                radial-gradient(circle at 30% 20%, rgba(96, 165, 250, .2), transparent 48%),
                rgba(15, 23, 42, .82);
            box-shadow: inset 0 0 0 1px rgba(148, 163, 184, .1);
            transition: transform .22s ease, color .22s ease, box-shadow .22s ease;
        }

        .sidebar a:hover .sidebar-nav-icon,
        .sidebar a.active .sidebar-nav-icon {
            color: white;
            transform: scale(1.04);
            box-shadow: inset 0 0 0 1px rgba(147, 197, 253, .26), 0 0 18px rgba(59, 130, 246, .22);
        }

        .sidebar-nav-text {
            min-width: 0;
            line-height: 1.25;
        }

        /* Ẩn submenu mặc định */
        .submenu {
            display: none;
            margin: 2px 0 12px 12px;
            padding-left: 12px;
            border-left: 1px solid rgba(148, 163, 184, .14);
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

        /* ===== MMO THEME SWITCH ===== */
        .theme-toggle {
            width: 54px;
            height: 54px;
            border: none;
            border-radius: 18px;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: white;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .08);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .28);
            transition: .3s;
            z-index: 10001;
        }

        .theme-toggle:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 0 30px rgba(59, 130, 246, .45);
        }

        .theme-icon {
            font-size: 24px;
            position: relative;
            z-index: 2;
        }

        .theme-wave {
            position: fixed;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%) scale(0);
            z-index: 9999;
            background: radial-gradient(circle, #f8fafc 0%, #e2e8f0 45%, transparent 70%);
        }

        .theme-wave.active {
            animation: themeSpread .75s ease forwards;
        }

        @keyframes themeSpread {
            from {
                transform: translate(-50%, -50%) scale(0);
                opacity: .9;
            }

            to {
                transform: translate(-50%, -50%) scale(90);
                opacity: 0;
            }
        }

        /* LIGHT MODE */
        body.light-mode {
            background: #f1f5f9 !important;
            color: #0f172a !important;
        }

        body.light-mode .top-menu,
        body.light-mode .service-box,
        body.light-mode .wallet-container,
        body.light-mode .profile-btn,
        body.light-mode .search-box,
        body.light-mode .service-group {
            background: #ffffff !important;
            color: #0f172a !important;
            border-color: #e2e8f0 !important;
        }

        body.light-mode .sidebar {
            background: linear-gradient(180deg, #ffffff, #e2e8f0) !important;
        }

        body.light-mode .sidebar a,
        body.light-mode .profile-info span,
        body.light-mode .balance,
        body.light-mode .search-box input,
        body.light-mode .service-header,
        body.light-mode .service-child a {
            color: #0f172a !important;
        }

        body.light-mode .profile-info small,
        body.light-mode .wallet-text small {
            color: #64748b !important;
        }

        body.light-mode .main {
            background: #f1f5f9 !important;
        }


        .sold {
            opacity: 0.6;
            position: relative;
        }

        .sold-badge {
            position: absolute;
            top: 10px;
            right: 10px;

            background: #ef4444;
            color: white;

            padding: 5px 10px;

            border-radius: 8px;

            font-size: 12px;
            font-weight: bold;
        }

        .sold-btn {
            width: 100%;

            background: #475569;
            color: white;

            border: none;
            padding: 10px;

            border-radius: 10px;

            cursor: not-allowed;
        }

        .sold {
            opacity: 0.6;
            transform: scale(0.98);
        }

        /* update menu */
        /* SERVICE MENU */
        .service-group {
            background: #0f172a;

            border: 1px solid #1e293b;

            border-radius: 14px;

            margin-bottom: 14px;

            overflow: hidden;

            transition: 0.3s;
        }

        .service-group:hover {
            border-color: #3b82f6;

            box-shadow: 0 0 15px rgba(59, 130, 246, 0.2);
        }

        .service-header {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 14px;

            color: white;

            font-size: 16px;
            font-weight: 600;
        }

        .service-logo {
            position: relative;
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            display: grid;
            place-items: center;
            overflow: hidden;
            border-radius: 17px;
            background:
                radial-gradient(circle at 30% 20%, rgba(56, 189, 248, .2), transparent 42%),
                linear-gradient(145deg, rgba(15, 23, 42, .98), rgba(2, 6, 23, .96));
            box-shadow:
                inset 0 0 0 1px rgba(148, 163, 184, .11),
                0 10px 22px rgba(0, 0, 0, .28),
                0 0 20px rgba(56, 189, 248, .12);
            transition: transform .35s ease, box-shadow .35s ease, border-radius .35s ease;
        }

        .service-logo::before {
            content: "";
            position: absolute;
            inset: -55%;
            background:
                conic-gradient(from 90deg,
                    transparent 0 18%,
                    rgba(34, 211, 238, .85) 24%,
                    rgba(99, 102, 241, .72) 38%,
                    rgba(236, 72, 153, .68) 52%,
                    transparent 68% 100%);
            opacity: .78;
            animation: serviceLogoSpin 7.5s linear infinite;
        }

        .service-logo::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 14px;
            background:
                linear-gradient(145deg, rgba(15, 23, 42, .98), rgba(8, 13, 30, .98)),
                #0b1228;
            box-shadow: inset 0 0 18px rgba(56, 189, 248, .08);
        }

        .service-logo i {
            position: relative;
            z-index: 1;
            font-size: 21px;
            color: #dbeafe;
            filter: drop-shadow(0 0 7px rgba(56, 189, 248, .35));
            transition: transform .35s ease, color .35s ease, filter .35s ease;
        }

        .service-group:hover .service-logo {
            transform: translateY(-2px) scale(1.03);
            border-radius: 18px;
            box-shadow:
                inset 0 0 0 1px rgba(125, 211, 252, .24),
                0 12px 26px rgba(0, 0, 0, .32),
                0 0 24px rgba(56, 189, 248, .24);
        }

        .service-group:hover .service-logo::before {
            opacity: 1;
            animation-duration: 3.2s;
        }

        .service-group:hover .service-logo i {
            color: #ffffff;
            transform: scale(1.08);
            filter: drop-shadow(0 0 10px rgba(125, 211, 252, .55));
        }

        @keyframes serviceLogoSpin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .service-logo::before {
                animation-duration: 18s;
            }

            .service-group:hover .service-logo {
                transform: none;
            }
        }

        .service-child {
            border-top: 1px solid #1e293b;

            padding: 12px;
        }

        .service-child a {
            display: flex;
            align-items: flex-start;
            gap: 9px;

            padding: 11px 12px;

            margin-bottom: 7px;

            border-radius: 10px;

            color: #cbd5e1;

            text-decoration: none;
            font-size: 13px;
            line-height: 1.45;
            overflow-wrap: anywhere;

            transition: 0.25s;
        }

        .service-child a:hover {
            background: #1e293b;

            color: #60a5fa;

            transform: translateX(4px);
        }

        .emergency-contact {
            position: relative;
            margin-bottom: 16px;
            padding: 16px;
            overflow: hidden;
            border: 1px solid rgba(248, 113, 113, .4);
            border-radius: 18px;
            background:
                radial-gradient(circle at top right, rgba(239, 68, 68, .2), transparent 45%),
                linear-gradient(145deg, rgba(30, 41, 59, .98), rgba(15, 23, 42, .98));
            box-shadow: 0 14px 28px rgba(0, 0, 0, .22);
        }

        .emergency-contact::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 3px;
            background: linear-gradient(#fb7185, #ef4444);
        }

        .emergency-contact.support-focus {
            animation: supportFocus .9s ease;
        }

        .emergency-label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 13px;
            color: #fda4af;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .emergency-label i {
            color: #fb7185;
            animation: emergencyPulse 1.8s ease-in-out infinite;
        }

        @keyframes emergencyPulse {
            50% {
                opacity: .45;
            }
        }

        @keyframes supportFocus {
            0%, 100% {
                box-shadow: 0 14px 28px rgba(0, 0, 0, .22);
            }

            50% {
                box-shadow: 0 0 0 2px rgba(248, 113, 113, .75), 0 0 34px rgba(248, 113, 113, .35);
            }
        }

        .admin-contact-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 13px;
        }

        .admin-contact-avatar {
            position: relative;
            flex: 0 0 48px;
            width: 48px;
            height: 48px;
            overflow: hidden;
            border: 2px solid rgba(96, 165, 250, .75);
            border-radius: 15px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            box-shadow: 0 0 20px rgba(59, 130, 246, .28);
        }

        .admin-contact-avatar img {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .admin-contact-fallback {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            color: white;
            font-size: 14px;
            font-weight: 800;
        }

        .admin-contact-online {
            position: absolute;
            z-index: 3;
            right: -1px;
            bottom: -1px;
            width: 12px;
            height: 12px;
            border: 2px solid #0f172a;
            border-radius: 50%;
            background: #22c55e;
        }

        .admin-contact-name {
            min-width: 0;
        }

        .admin-contact-name strong {
            display: block;
            margin-bottom: 3px;
            overflow: hidden;
            color: #fff;
            font-size: 15px;
            white-space: normal;
            text-overflow: ellipsis;
        }

        .admin-contact-name span {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.45;
        }

        .admin-contact-links {
            display: grid;
            gap: 7px;
        }

        .admin-contact-links a {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
            padding: 10px 11px;
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 10px;
            color: #cbd5e1;
            background: rgba(15, 23, 42, .62);
            font-size: 12px;
            text-decoration: none;
            transition: .2s;
        }

        .admin-contact-links a:hover {
            color: #fff;
            border-color: rgba(96, 165, 250, .45);
            background: rgba(37, 99, 235, .14);
            transform: translateX(3px);
        }

        .admin-contact-links i {
            width: 15px;
            color: #60a5fa;
            text-align: center;
        }

        .admin-contact-links span {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .contact-socials {
            display: grid;
            grid-template-columns: 1fr;
            gap: 9px;
            margin-top: 10px;
        }

        .contact-socials a {
            justify-content: flex-start;
            color: #fff;
            font-weight: 800;
            min-height: 52px;
            overflow: hidden;
            position: relative;
            isolation: isolate;
            gap: 10px;
            padding: 9px 11px;
            font-size: 14px;
            line-height: 1.15;
            background:
                radial-gradient(circle at 20% 15%, rgba(56, 189, 248, .16), transparent 40%),
                rgba(15, 23, 42, .76);
            box-shadow: inset 0 0 0 1px rgba(148, 163, 184, .08);
        }

        .contact-socials .facebook-contact {
            background:
                radial-gradient(circle at 20% 15%, rgba(59, 130, 246, .2), transparent 42%),
                rgba(30, 64, 175, .24);
        }

        .contact-socials .zalo-contact {
            background:
                radial-gradient(circle at 20% 15%, rgba(14, 165, 233, .2), transparent 42%),
                rgba(8, 47, 73, .34);
        }

        .contact-social-logo {
            position: relative;
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            display: grid;
            place-items: center;
            overflow: hidden;
            border-radius: 12px;
            background: #07152e;
            box-shadow: 0 0 18px rgba(56, 189, 248, .16);
        }

        .contact-social-logo::before {
            content: "";
            position: absolute;
            inset: -55%;
            opacity: .72;
            background:
                conic-gradient(from 90deg,
                    transparent 0 18%,
                    rgba(34, 211, 238, .86) 24%,
                    rgba(99, 102, 241, .72) 38%,
                    rgba(236, 72, 153, .64) 52%,
                    transparent 68% 100%);
            animation: serviceLogoSpin 7.5s linear infinite;
        }

        .contact-social-logo::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 9px;
            background: linear-gradient(145deg, rgba(15, 23, 42, .98), rgba(8, 13, 30, .98));
        }

        .contact-social-logo i {
            position: relative;
            z-index: 1;
            color: #dbeafe;
            font-size: 16px;
            filter: drop-shadow(0 0 7px rgba(56, 189, 248, .35));
            transition: transform .35s ease, filter .35s ease;
        }

        .contact-socials a:hover .contact-social-logo::before {
            opacity: 1;
            animation-duration: 3.2s;
        }

        .contact-socials a:hover .contact-social-logo i {
            transform: scale(1.08);
            filter: drop-shadow(0 0 10px rgba(125, 211, 252, .55));
        }

        body.light-mode .emergency-contact {
            background:
                radial-gradient(circle at top right, rgba(239, 68, 68, .13), transparent 45%),
                #fff !important;
        }

        body.light-mode .admin-contact-name strong {
            color: #0f172a;
        }

        body.light-mode .admin-contact-links a {
            color: #334155;
            background: #f8fafc;
        }

        .app-modal {
            position: fixed;
            z-index: 20000;
            inset: 0;
            display: grid;
            place-items: center;
            padding: 20px;
            visibility: hidden;
            opacity: 0;
            transition: visibility .28s, opacity .28s ease;
        }

        .app-modal.show {
            visibility: visible;
            opacity: 1;
        }

        .app-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(2, 6, 23, .76);
            backdrop-filter: blur(12px);
        }

        .app-modal-card {
            position: relative;
            width: min(440px, 100%);
            overflow: hidden;
            padding: 25px;
            border: 1px solid rgba(96, 165, 250, .25);
            border-radius: 24px;
            background:
                radial-gradient(circle at top right, rgba(124, 58, 237, .2), transparent 42%),
                linear-gradient(145deg, rgba(15, 23, 42, .98), rgba(7, 13, 29, .98));
            box-shadow: 0 28px 80px rgba(0, 0, 0, .5), 0 0 45px rgba(59, 130, 246, .14);
            transform: translateY(22px) scale(.94);
            opacity: 0;
            transition: transform .36s cubic-bezier(.16, 1, .3, 1), opacity .25s ease;
        }

        .app-modal.show .app-modal-card {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .app-modal-card::before {
            content: "";
            position: absolute;
            width: 160px;
            height: 160px;
            top: -100px;
            right: -60px;
            border-radius: 50%;
            background: rgba(59, 130, 246, .24);
            filter: blur(18px);
            animation: modalGlow 3.5s ease-in-out infinite alternate;
        }

        @keyframes modalGlow {
            to {
                transform: translate(-35px, 25px) scale(1.15);
                background: rgba(168, 85, 247, .22);
            }
        }

        .app-modal-close {
            position: absolute;
            z-index: 2;
            top: 14px;
            right: 14px;
            width: 34px;
            height: 34px;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 11px;
            color: #94a3b8;
            background: rgba(15, 23, 42, .72);
            cursor: pointer;
            transition: .2s;
        }

        .app-modal-close:hover {
            color: #fff;
            border-color: rgba(248, 113, 113, .4);
            background: rgba(239, 68, 68, .13);
            transform: rotate(90deg);
        }

        .app-modal-icon {
            position: relative;
            display: grid;
            place-items: center;
            width: 62px;
            height: 62px;
            margin-bottom: 18px;
            border-radius: 19px;
            color: #fff;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            box-shadow: 0 0 30px rgba(59, 130, 246, .32);
            font-size: 23px;
        }

        .app-modal-icon::after {
            content: "";
            position: absolute;
            inset: -7px;
            border: 1px solid rgba(96, 165, 250, .25);
            border-radius: 23px;
            animation: appIconPulse 2s ease-out infinite;
        }

        @keyframes appIconPulse {
            70%, 100% {
                transform: scale(1.22);
                opacity: 0;
            }
        }

        .app-modal-eyebrow {
            margin-bottom: 6px;
            color: #60a5fa;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .app-modal-title {
            margin: 0 40px 8px 0;
            color: #fff;
            font-size: 22px;
            line-height: 1.25;
        }

        .app-modal-description {
            margin: 0;
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.7;
        }

        .app-modal-target {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 18px;
            padding: 12px 13px;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 13px;
            color: #bfdbfe;
            background: rgba(30, 41, 59, .62);
            font-size: 12px;
        }

        .app-modal-target span {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .app-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1.25fr;
            gap: 10px;
            margin-top: 21px;
        }

        .app-modal-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 13px;
            color: #cbd5e1;
            background: rgba(30, 41, 59, .65);
            cursor: pointer;
            font-weight: 700;
            transition: .22s;
        }

        .app-modal-button:hover {
            color: #fff;
            transform: translateY(-2px);
        }

        .app-modal-button.primary {
            border-color: transparent;
            color: #fff;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            box-shadow: 0 10px 25px rgba(37, 99, 235, .24);
        }

        body.light-mode .app-modal-card {
            border-color: #dbeafe;
            background: #fff;
        }

        body.light-mode .app-modal-title {
            color: #0f172a;
        }

        body.light-mode .app-modal-description {
            color: #64748b;
        }

        body.light-mode .app-modal-target {
            color: #1d4ed8;
            background: #f8fafc;
        }

        @media (prefers-reduced-motion: reduce) {
            .app-modal,
            .app-modal-card,
            .app-modal-card::before,
            .app-modal-icon::after {
                animation: none !important;
                transition-duration: .01ms !important;
            }
        }

        .sidebar {
            top: 0;
            left: 0;
            height: 100vh;
            max-height: 100vh;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            box-sizing: border-box;
            padding-bottom: 180px !important;
            z-index: 999;
        }

        .main {
            margin-left: 300px;
        }

        .top-menu {
            margin-left: 300px;
            position: relative;
            z-index: 10;
        }

        /* NÂNG CẤP USER MENU */
        /* ===== USER MENU NEW ===== */

        .user-menu {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        /* WALLET */

        .wallet-container {
            display: flex;
            align-items: center;
            justify-content: space-between;

            min-width: 170px;

            padding: 10px 14px;

            border-radius: 18px;

            background: linear-gradient(135deg,
                    rgba(30, 41, 59, .95),
                    rgba(15, 23, 42, .95));

            border: 1px solid rgba(255, 255, 255, .05);

            box-shadow:
                0 10px 30px rgba(0, 0, 0, .25),
                inset 0 1px 0 rgba(255, 255, 255, .03);
        }

        .wallet-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .wallet-icon {
            width: 38px;
            height: 38px;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(135deg, #3b82f6, #2563eb);

            color: white;

            font-size: 15px;
        }

        .wallet-text {
            display: flex;
            flex-direction: column;
        }

        .wallet-text small {
            color: #94a3b8;
            font-size: 11px;
        }

        .balance {
            color: white;
            font-size: 17px;
            font-weight: 700;
        }

        .add-money-btn {
            width: 32px;
            height: 32px;

            border: none;
            border-radius: 10px;

            background: #3b82f6;
            color: white;

            font-size: 18px;
            cursor: pointer;

            transition: .25s;
        }

        .add-money-btn:hover {
            transform: scale(1.08);
            background: #2563eb;
        }

        /* PROFILE */

        .profile-dropdown {
            position: relative;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 12px;

            background: rgba(15, 23, 42, .95);

            border: 1px solid rgba(255, 255, 255, .05);

            padding: 10px 14px;

            border-radius: 18px;

            color: white;

            cursor: pointer;

            transition: .25s;
        }

        .profile-btn:hover {
            border-color: #3b82f6;

            box-shadow:
                0 0 20px rgba(59, 130, 246, .25);
        }

        .avatar {
            width: 42px;
            height: 42px;

            border-radius: 50%;
            overflow: hidden;

            background: linear-gradient(135deg,
                    #7c3aed,
                    #3b82f6);

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: bold;
            font-size: 16px;

            color: white;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .profile-info span {
            font-size: 14px;
            font-weight: 600;
        }

        .profile-info small {
            font-size: 11px;
            color: #94a3b8;
        }

        /* LOGIN */

        .login-btn {
            padding: 12px 20px;

            border-radius: 14px;

            background: #2563eb;

            color: white;

            text-decoration: none;

            font-weight: 600;

            transition: .25s;
        }

        .login-btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        /* DROPDOWN */

        .dropdown-menu {
            top: 70px !important;

            right: 0;

            width: 220px;

            background: #0f172a;

            border: 1px solid #1e293b;

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 20px 40px rgba(0, 0, 0, .45);
        }

        .dropdown-menu a,
        .dropdown-menu button {
            padding: 14px 16px;

            transition: .25s;

            font-size: 14px;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #1e293b;
            color: #60a5fa;
        }

        /* NÂNG CẤP TÌM KIẾM */
        /* ===== SEARCH NEW ===== */
        .search-box {
            width: 380px;
            height: 48px;

            display: flex;
            align-items: center;
            gap: 12px;

            background: rgba(15, 23, 42, .95);

            border: 1px solid rgba(255, 255, 255, .06);

            border-radius: 16px;

            padding: 0 14px;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, .22),
                inset 0 1px 0 rgba(255, 255, 255, .03);

            transition: .25s;
        }

        .search-box:focus-within {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px rgba(59, 130, 246, .15),
                0 10px 25px rgba(0, 0, 0, .25);
        }

        .search-box i {
            color: #60a5fa;
            font-size: 16px;
        }

        .search-box input {
            flex: 1;

            background: transparent;

            border: none;

            outline: none;

            color: white;

            font-size: 14px;
        }

        .search-box input::placeholder {
            color: #64748b;
        }

        .search-clear {
            width: 28px;
            height: 28px;

            border: none;

            border-radius: 8px;

            background: #1e293b;

            color: #94a3b8;

            cursor: pointer;

            display: none;

            transition: .25s;
        }

        .search-clear:hover {
            background: #334155;
            color: white;
        }

        .mobile-menu-btn,
        .sidebar-backdrop {
            display: none;
        }

        @media (max-width: 900px) {
            body {
                overflow-x: hidden;
            }

            .mobile-menu-btn {
                width: 46px;
                height: 46px;
                flex: 0 0 46px;
                display: grid;
                place-items: center;
                border: 1px solid rgba(96, 165, 250, .24);
                border-radius: 15px;
                color: white;
                background:
                    radial-gradient(circle at 25% 20%, rgba(59, 130, 246, .22), transparent 44%),
                    rgba(15, 23, 42, .92);
                box-shadow: 0 10px 24px rgba(0, 0, 0, .24);
            }

            .sidebar {
                width: min(86vw, 320px) !important;
                transform: translateX(-104%);
                transition: transform .32s ease, box-shadow .32s ease;
                z-index: 20010;
                border-right: 1px solid rgba(96, 165, 250, .18);
                box-shadow: none;
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
                box-shadow: 24px 0 60px rgba(0, 0, 0, .42);
            }

            .sidebar-backdrop {
                position: fixed;
                inset: 0;
                z-index: 20000;
                display: block;
                visibility: hidden;
                opacity: 0;
                background: rgba(2, 6, 23, .68);
                backdrop-filter: blur(8px);
                transition: opacity .28s ease, visibility .28s ease;
            }

            body.sidebar-open .sidebar-backdrop {
                visibility: visible;
                opacity: 1;
            }

            .top-menu,
            .main {
                margin-left: 0 !important;
                width: 100%;
            }

            .top-menu {
                position: sticky;
                top: 0;
                z-index: 15000;
                display: grid;
                grid-template-columns: auto 1fr;
                gap: 12px;
                align-items: center;
                padding: 12px;
                border-radius: 0 0 18px 18px;
            }

            .search-box {
                width: 100%;
                min-width: 0;
            }

            .user-menu {
                grid-column: 1 / -1;
                width: 100%;
                display: grid;
                grid-template-columns: 1fr auto auto;
                gap: 10px;
            }

            .wallet-container {
                min-width: 0;
            }

            .profile-btn {
                padding: 8px;
            }

            .profile-info {
                display: none;
            }

            .main {
                padding: 14px;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .admin-contact-name strong,
            .admin-contact-name span,
            .service-child a {
                word-break: break-word;
            }
        }

        @media (max-width: 520px) {
            .top-menu {
                grid-template-columns: auto 1fr;
            }

            .user-menu {
                grid-template-columns: 1fr auto;
            }

            .profile-dropdown {
                justify-self: end;
            }

            .theme-toggle {
                width: 46px;
                height: 46px;
                border-radius: 15px;
            }

            .wallet-text small {
                font-size: 10px;
            }

            .balance {
                font-size: 14px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <div class="sidebar-backdrop" onclick="closeSidebar()" aria-hidden="true"></div>

    <div class="top-menu">

        <button type="button" class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Mở menu">
            <i class="fas fa-bars"></i>
        </button>

        <!-- SEARCH -->
        <div class="search-box">
            <i class="fas fa-search"></i>

            <input type="text" id="globalSearch" placeholder="Tìm dịch vụ, tài khoản..." onkeyup="handleSearch()">

            <button onclick="clearSearch()" class="search-clear" id="clearSearchBtn">
                ✕
            </button>
        </div>

        <!-- USER -->
        <div class="user-menu">

            {{-- SEARCH QUICK --}}

            {{-- WALLET --}}
            <div class="wallet-container">

                <div class="wallet-left">
                    <div class="wallet-icon">
                        <i class="fas fa-wallet"></i>
                    </div>

                    <div class="wallet-text">
                        <small>Số dư</small>

                        <span class="balance">
                            @if (auth()->check())
                                {{ number_format(auth()->user()->balance) }}đ
                            @endif
                        </span>
                    </div>
                </div>

                <button class="add-money-btn" onclick="goDeposit()">
                    +
                </button>

            </div>

            {{-- LANGUAGE --}}
            {{-- THEME SWITCH --}}
            <button onclick="toggleTheme(event)" class="theme-toggle" id="themeToggle">
                <span class="theme-icon" id="themeIcon">🌙</span>
            </button>

            <div class="theme-wave" id="themeWave"></div>

            {{-- PROFILE --}}
            @auth
                <div class="profile-dropdown">

                    <button onclick="toggleUserMenu(event)" class="profile-btn">

                        <div class="avatar">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                    alt="Ảnh đại diện của {{ Auth::user()->name }}">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>

                        <div class="profile-info">
                            <span>{{ Auth::user()->name }}</span>
                            <small>Thành viên</small>
                        </div>

                        <i class="fas fa-chevron-down"></i>

                    </button>

                    <div id="userMenu" class="dropdown-menu">

                        <a href="{{ route('profile.edit') }}">
                            👤 Hồ sơ
                        </a>

                        <a href="/my-orders">
                            📦 Đơn hàng
                        </a>

                        <a href="/deposit">
                            💳 Nạp tiền
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">
                                🚪 Đăng xuất
                            </button>
                        </form>

                    </div>

                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="login-btn">
                    Đăng nhập
                </a>
            @endguest

        </div>
    </div>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>TRUNG TÂM MMO</h4>
        <span class="sidebar-menu-title">Trang chính</span>
        <a href="/">
            <span class="sidebar-nav-icon"><i class="fas fa-home"></i></span>
            <span class="sidebar-nav-text">Trang chủ</span>
        </a>
        <a href="#" onclick="togglePolicyMenu()">
            <span class="sidebar-nav-icon"><i class="fas fa-shield-alt"></i></span>
            <span class="sidebar-nav-text">Chính sách & Hỗ trợ</span>
        </a>

        <div id="policyMenu" class="submenu" style="display:none;">

            <a href="/gioi-thieu-he-thong" class="icon-link">
                <i class="fas fa-info-circle"></i> Giới thiệu
            </a>


            <a href="/chinh-sach-dich-vu" class="icon-link">
                <i class="fas fa-file-alt"></i> Chính sách dịch vụ
            </a>
            <a href="/chinh-sach-he-thong" class="icon-link">
                <i class="fas fa-shield-alt"></i> Chính sách hệ thống
            </a>

        </div>
        <a href="/my-orders">
            <span class="sidebar-nav-icon"><i class="fas fa-box-open"></i></span>
            <span class="sidebar-nav-text">Acc đã mua</span>
        </a>

        <a href="#" onclick="toggleMenu()">
            <span class="sidebar-nav-icon"><i class="fas fa-tools"></i></span>
            <span class="sidebar-nav-text">Dịch vụ</span>
        </a>
        <div id="submenu" class="submenu" style="display:none;">

            @php
                $supportAdmin = \App\Models\User::where('email', 'tp11102004@gmail.com')->first();
                $supportAvatar = $supportAdmin?->avatar
                    ? asset('storage/' . $supportAdmin->avatar)
                    : (auth()->user()?->avatar
                        ? asset('storage/' . auth()->user()->avatar)
                        : 'https://graph.facebook.com/pham.tuan.333566/picture?type=large');
            @endphp

            <div class="emergency-contact" id="emergency-support">
                <div class="emergency-label">
                    <i class="fas fa-circle"></i>
                    Liên hệ khẩn cấp
                </div>

                <div class="admin-contact-profile">
                    <div class="admin-contact-avatar">
                        <span class="admin-contact-fallback">PT</span>
                        <img src="{{ $supportAvatar }}"
                            alt="Ảnh đại diện của Phạm Tuấn"
                            onerror="this.style.display='none'">
                        <span class="admin-contact-online"></span>
                    </div>

                    <div class="admin-contact-name">
                        <strong>Phạm Tuấn</strong>
                        <span>Admin hỗ trợ tài khoản MXH</span>
                        <span>Ưu tiên trường hợp khẩn cấp</span>
                    </div>
                </div>

                <div class="admin-contact-links">
                    <a href="tel:0565701052" data-app-link data-app-name="Điện thoại"
                        data-app-description="Bạn sắp gọi trực tiếp cho admin hỗ trợ khẩn cấp."
                        data-app-icon="fa-phone-alt" data-app-target="0565 701 052">
                        <i class="fas fa-phone-alt"></i>
                        <span>0565 701 052</span>
                    </a>
                </div>

                <div class="contact-socials">
                    <a href="https://www.facebook.com/pham.tuan.333566" target="_blank" rel="noopener"
                        class="facebook-contact">
                        <span class="contact-social-logo"><i class="fab fa-facebook-f"></i></span>
                        Facebook
                    </a>
                    <a href="https://zalo.me/0565701052" target="_blank" rel="noopener" class="zalo-contact"
                        data-app-link data-app-name="Zalo"
                        data-app-description="Bạn sắp mở Zalo để trao đổi trực tiếp với admin."
                        data-app-icon="fa-comment-dots" data-app-target="0565 701 052">
                        <span class="contact-social-logo"><i class="fas fa-comment-dots"></i></span>
                        Zalo
                    </a>
                </div>
            </div>

            <!-- FACEBOOK -->
            <div class="service-group">
                <div class="service-header">
                    <span class="service-logo"><i class="fab fa-facebook"></i></span>
                    <span>Facebook</span>
                </div>

                <div class="service-child">
                    <a href="/service/facebook/mo-khoa-checkpoint" class="service-link">
                        Mở khóa checkpoint
                    </a>
                    <a href="/service/facebook/mo-khoa-282" class="service-link">
                        Mở khóa 282
                    </a>

                    <a href="/service/facebook/khoi-phuc-hack" class="service-link">
                        Khôi phục bị hack
                    </a>

                    <a href="/service/facebook/doi-mail-sdt" class="service-link">
                        Đổi mail / SĐT
                    </a>
                    <a href="/service/facebook/bat-bao-mat-2fa" class="service-link">
                        Bật bảo mật 2FA
                    </a>
                    <a href="/service/facebook/xoa-tai-khoan" class="service-link">
                        Xóa tài khoản
                    </a>
                    <a href="/service/facebook/tang-follow-like" class="service-link">
                        Tăng follow / like
                    </a>
                </div>
            </div>

            <!-- TIKTOK -->
            <div class="service-group">
                <div class="service-header">
                    <span class="service-logo"><i class="fab fa-tiktok"></i></span>
                    <span>TikTok</span>
                </div>

                <div class="service-child">
                    <a href="/service/tiktok/khoi-phuc-tai-khoan-bi-dinh-chi" class="service-link">Khôi phục tài khoản bị đình chỉ</a>
                    <a href="/service/tiktok/khoi-phuc-tai-khoan-bi-cam-vinh-vien" class="service-link">Khôi phục tài khoản bị cấm vĩnh viễn</a>
                    <a href="/service/tiktok/khoi-phuc-trang-thai-live" class="service-link">Khôi phục trạng thái LIVE</a>
                    <a href="/service/tiktok/khoi-phuc-tai-khoan-bi-dinh-chi-tinh-nang-nhan-tin" class="service-link">Khôi phục tài khoản bị đình chỉ tính năng nhắn tin</a>
                    <a href="/service/tiktok/khoi-phuc-trang-thai-tai-khoan" class="service-link">Khôi phục trạng thái tài khoản</a>
                    <a href="/service/tiktok/xac-minh-danh-tinh" class="service-link">Xác minh danh tính</a>
                    <a href="/service/tiktok/xac-minh-do-tuoi" class="service-link">Xác minh độ tuổi</a>
                    <a href="/service/tiktok/xac-minh-huy-hieu-mau-xanh" class="service-link">Xác minh huy hiệu màu xanh</a>
                    <a href="/service/tiktok/khoi-phuc-gio-hang-bi-cam" class="service-link">Khôi phục giỏ hàng bị cấm</a>
                    <a href="/service/tiktok/khoi-phuc-trang-thai-de-xuat" class="service-link">Khôi phục trạng thái đề xuất</a>
                </div>
            </div>

            <!-- ZALO -->
            <div class="service-group">
                <div class="service-header">
                    <span class="service-logo"><i class="fas fa-comment-dots"></i></span>
                    <span>Zalo</span>
                </div>

                <div class="service-child">
                    <a href="/service/zalo/khoi-phuc-tai-khoan-bi-khoa" class="service-link">Khôi phục tài khoản bị khoá</a>
                    <a href="/service/zalo/khoi-phuc-tai-khoan-bi-vo-hieu-hoa" class="service-link">Khôi phục tài khoản bị vô hiệu hoá</a>
                    <a href="/service/zalo/khoi-phuc-tai-khoan-mat-quyen-truy-cap" class="service-link">Khôi phục tài khoản mất quyền truy cập</a>
                    <a href="#emergency-support">Vấn đề khác</a>
                </div>
            </div>

            <!-- WHATSAPP -->
            <div class="service-group">
                <div class="service-header">
                    <span class="service-logo"><i class="fab fa-whatsapp"></i></span>
                    <span>WhatsApp</span>
                </div>

                <div class="service-child">
                    <a href="/service/whatsapp/khoi-phuc-tai-khoan-mat-quyen-truy-cap" class="service-link">Khôi phục tài khoản mất quyền truy cập</a>
                    <a href="/service/whatsapp/khoi-phuc-tai-khoan-bi-vo-hieu-hoa" class="service-link">Khôi phục tài khoản bị vô hiệu hoá</a>
                    <a href="/service/whatsapp/khoi-phuc-trinh-tao-ma" class="service-link">Khôi phục trình tạo mã</a>
                    <a href="/service/whatsapp/khoi-phuc-cac-han-che-tren-tai-khoan" class="service-link">Khôi phục các hạn chế trên tài khoản</a>
                    <a href="#emergency-support">Vấn đề khác</a>
                </div>
            </div>

            <!-- ICLOUD -->
            <div class="service-group">
                <div class="service-header">
                    <span class="service-logo"><i class="fab fa-apple"></i></span>
                    <span>iCloud</span>
                </div>

                <div class="service-child">
                    <a href="/service/icloud/khoi-phuc-tai-khoan-mat-quyen-truy-cap" class="service-link">Khôi phục tài khoản mất quyền truy cập</a>
                    <a href="/service/icloud/khoi-phuc-mat-khau-icloud" class="service-link">Khôi phục mật khẩu iCloud</a>
                    <a href="/service/icloud/khoi-phuc-tai-khoan-bi-khoa" class="service-link">Khôi phục tài khoản bị khoá</a>
                    <a href="/service/icloud/khoi-phuc-trinh-tao-ma-2fa" class="service-link">Khôi phục trình tạo mã 2FA</a>
                    <a href="#emergency-support">Vấn đề khác</a>
                </div>
            </div>

            <!-- INSTAGRAM -->
            <div class="service-group">
                <div class="service-header">
                    <span class="service-logo"><i class="fab fa-instagram"></i></span>
                    <span>Instagram</span>
                </div>

                <div class="service-child">
                    <a href="/service/instagram/khoi-phuc-tai-khoan-bi-dinh-chi" class="service-link">Khôi phục tài khoản bị đình chỉ</a>
                    <a href="/service/instagram/khoi-phuc-tai-khoan-bi-vo-hieu-hoa" class="service-link">Khôi phục tài khoản bị vô hiệu hoá</a>
                    <a href="/service/instagram/khoi-phuc-cac-han-che-tren-tai-khoan" class="service-link">Khôi phục các hạn chế trên tài khoản</a>
                    <a href="/service/instagram/khoi-phuc-tai-khoan-mat-quyen-truy-cap" class="service-link">Khôi phục tài khoản mất quyền truy cập</a>
                    <a href="/service/instagram/khoi-phuc-trinh-tao-ma-2fa" class="service-link">Khôi phục trình tạo mã 2FA</a>
                    <a href="#emergency-support">Vấn đề khác</a>
                </div>
            </div>

            <!-- GOOGLE -->
            <div class="service-group">
                <div class="service-header">
                    <span class="service-logo"><i class="fab fa-google"></i></span>
                    <span>Google</span>
                </div>

                <div class="service-child">
                    <a href="/service/google/khoi-phuc-tai-khoan-mat-quyen-truy-cap" class="service-link">Khôi phục tài khoản mất quyền truy cập</a>
                    <a href="/service/google/khoi-phuc-tai-khoan-bi-han-che" class="service-link">Khôi phục tài khoản bị hạn chế</a>
                    <a href="/service/google/khoi-phuc-tai-khoan-bi-vo-hieu-hoa" class="service-link">Khôi phục tài khoản bị vô hiệu hoá</a>
                    <a href="/service/google/khoi-phuc-trang-doanh-nghiep-google-map-bi-han-che-vo-hieu-hoa-vinh-vien" class="service-link">Khôi phục trang doanh nghiệp trên Google Map bị hạn chế - vô hiệu hoá vĩnh viễn</a>
                    <a href="/service/google/tach-trang-doanh-nghiep-bi-trung-lap" class="service-link">Tách trang doanh nghiệp bị trùng lặp</a>
                    <a href="/service/google/tach-danh-gia-bi-gop" class="service-link">Tách đánh giá bị gộp</a>
                    <a href="/service/google/khoi-phuc-tai-khoan-google-ads" class="service-link">Khôi phục tài khoản Google Ads</a>
                    <a href="/service/google/khoi-phuc-trang-doanh-nghiep-bi-doi-thong-tin" class="service-link">Khôi phục trang doanh nghiệp bị đổi thông tin</a>
                    <a href="/service/google/xac-minh-trang-doanh-nghiep-tren-google-map" class="service-link">Xác minh trang doanh nghiệp trên Google Map</a>
                    <a href="#emergency-support">Vấn đề khác</a>
                </div>
            </div>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="main">
        @yield('content')
    </div>
    {{-- CallAPI --}}

    <div class="app-modal" id="appLaunchModal" aria-hidden="true">
        <div class="app-modal-backdrop" data-close-app-modal></div>

        <div class="app-modal-card" role="dialog" aria-modal="true" aria-labelledby="appModalTitle">
            <button type="button" class="app-modal-close" data-close-app-modal aria-label="Đóng">
                <i class="fas fa-times"></i>
            </button>

            <div class="app-modal-icon">
                <i class="fas fa-external-link-alt" id="appModalIcon"></i>
            </div>

            <div class="app-modal-eyebrow">MMO Secure Connect</div>
            <h3 class="app-modal-title" id="appModalTitle">Mở ứng dụng liên hệ?</h3>
            <p class="app-modal-description" id="appModalDescription">
                Xác nhận trước khi chuyển sang ứng dụng bên ngoài.
            </p>

            <div class="app-modal-target">
                <i class="fas fa-shield-alt"></i>
                <span id="appModalTarget"></span>
            </div>

            <div class="app-modal-actions">
                <button type="button" class="app-modal-button" data-close-app-modal>
                    Hủy
                </button>
                <button type="button" class="app-modal-button primary" id="confirmAppLaunch">
                    <i class="fas fa-external-link-alt"></i>
                    Mở ứng dụng
                </button>
            </div>
        </div>
    </div>

    @include('components.mmo-notifications')

</body>
{{-- @endsection --}}

<script>
    function toggleSidebar() {
        document.body.classList.toggle("sidebar-open");
    }

    function closeSidebar() {
        document.body.classList.remove("sidebar-open");
    }

    document.querySelectorAll(".sidebar a[href]:not([href='#'])").forEach(link => {
        link.addEventListener("click", () => {
            if (window.matchMedia("(max-width: 900px)").matches) {
                closeSidebar();
            }
        });
    });

    document.addEventListener("keydown", event => {
        if (event.key === "Escape") {
            closeSidebar();
        }
    });

    // Hàm để mở hoặc đóng submenu
    // Đóng/mở sidebar trên màn hình nhỏ.
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
    // Đóng/mở menu tài khoản người dùng.
    function toggleUserMenu(event) {
        event.stopPropagation();

        let menu = document.getElementById("userMenu");
        menu.classList.toggle("show");
    }

    document.addEventListener("click", function() {
        let menu = document.getElementById("userMenu");
        menu.classList.remove("show");
    });
    //    SÁNG TỐI
    // Chuyển đổi giao diện sáng/tối và lưu lựa chọn cục bộ.
    function toggleTheme(event) {
        const wave = document.getElementById("themeWave");
        const icon = document.getElementById("themeIcon");

        wave.style.left = event.clientX + "px";
        wave.style.top = event.clientY + "px";

        wave.classList.remove("active");
        void wave.offsetWidth;
        wave.classList.add("active");

        setTimeout(() => {
            document.body.classList.toggle("light-mode");

            const isLight = document.body.classList.contains("light-mode");

            icon.innerText = isLight ? "☀️" : "🌙";

            localStorage.setItem("theme", isLight ? "light" : "dark");
        }, 220);
    }

    window.addEventListener("DOMContentLoaded", function() {
        const theme = localStorage.getItem("theme");
        const icon = document.getElementById("themeIcon");

        if (theme === "light") {
            document.body.classList.add("light-mode");
            if (icon) icon.innerText = "☀️";
        }
    });
    // nạp tiền
    // Chuyển nhanh đến trang nạp tiền.
    function goDeposit() {
        window.location.href = "/deposit";
    }
    // chính sách hỗ trợ
    // Đóng/mở nhóm liên kết chính sách.
    function togglePolicyMenu() {
        var menu = document.getElementById("policyMenu");

        if (menu.style.display === "none") {
            menu.style.display = "block";
        } else {
            menu.style.display = "none";
        }
    }

    document.querySelectorAll('a[href="#emergency-support"]').forEach(link => {
        link.addEventListener("click", event => {
            event.preventDefault();

            const support = document.getElementById("emergency-support");

            if (!support) {
                return;
            }

            support.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
            support.classList.remove("support-focus");
            void support.offsetWidth;
            support.classList.add("support-focus");
        });
    });

    // tìm kiếm
    // Lọc và hiển thị kết quả tìm kiếm chức năng trong layout MMO.
    function handleSearch() {
        const input = document.getElementById("globalSearch");
        const keyword = input.value.toLowerCase().trim();
        const clearBtn = document.getElementById("clearSearchBtn");

        clearBtn.style.display = keyword ? "block" : "none";

        const accounts = document.querySelectorAll(".service-box.account");
        const services = document.querySelectorAll(".service-child a, .service-header span");

        accounts.forEach(item => {
            const text = item.innerText.toLowerCase();

            if (text.includes(keyword)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });

        services.forEach(item => {
            const text = item.innerText.toLowerCase();

            if (text.includes(keyword)) {
                item.style.background = keyword ? "#1e293b" : "";
                item.style.color = keyword ? "#60a5fa" : "";
            } else {
                item.style.background = "";
                item.style.color = "";
            }
        });
    }

    // Xóa từ khóa và đóng danh sách kết quả tìm kiếm.
    function clearSearch() {
        const input = document.getElementById("globalSearch");

        input.value = "";

        document.getElementById("clearSearchBtn").style.display = "none";

        document.querySelectorAll(".service-box.account").forEach(item => {
            item.style.display = "block";
        });

        document.querySelectorAll(".service-child a, .service-header span").forEach(item => {
            item.style.background = "";
            item.style.color = "";
        });
    }

    const appLaunchModal = document.getElementById("appLaunchModal");
    const appModalTitle = document.getElementById("appModalTitle");
    const appModalDescription = document.getElementById("appModalDescription");
    const appModalTarget = document.getElementById("appModalTarget");
    const appModalIcon = document.getElementById("appModalIcon");
    const confirmAppLaunch = document.getElementById("confirmAppLaunch");
    let pendingAppLink = null;

    // Mở modal xác nhận trước khi chuyển sang liên kết ứng dụng ngoài.
    function openAppModal(link) {
        pendingAppLink = link;
        appModalTitle.textContent = `Mở ${link.dataset.appName}?`;
        appModalDescription.textContent = link.dataset.appDescription;
        appModalTarget.textContent = link.dataset.appTarget;
        appModalIcon.className = `fas ${link.dataset.appIcon}`;
        appLaunchModal.classList.add("show");
        appLaunchModal.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";

        setTimeout(() => confirmAppLaunch.focus(), 180);
    }

    // Đóng modal mở ứng dụng ngoài và đặt lại trạng thái.
    function closeAppModal() {
        appLaunchModal.classList.remove("show");
        appLaunchModal.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
        pendingAppLink = null;
    }

    document.querySelectorAll("[data-app-link]").forEach(link => {
        link.addEventListener("click", event => {
            event.preventDefault();
            openAppModal(link);
        });
    });

    document.querySelectorAll("[data-close-app-modal]").forEach(button => {
        button.addEventListener("click", closeAppModal);
    });

    confirmAppLaunch.addEventListener("click", () => {
        if (!pendingAppLink) {
            return;
        }

        const href = pendingAppLink.href;
        const openNewTab = pendingAppLink.target === "_blank";

        closeAppModal();

        if (openNewTab) {
            window.open(href, "_blank", "noopener");
        } else {
            window.location.href = href;
        }
    });

    document.addEventListener("keydown", event => {
        if (event.key === "Escape" && appLaunchModal.classList.contains("show")) {
            closeAppModal();
        }
    });
</script>

</html>
