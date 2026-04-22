<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            margin: 0;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #1e1e2f, #2c2c54);
            color: white;
            position: fixed;
            padding-top: 20px;
            transition: all 0.3s ease;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ccc;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        /* 🔥 HOVER ANIMATION */
        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-left: 3px solid #0d6efd;
            transform: translateX(5px);
        }

        /* CONTENT */
        .content {
            margin-left: 250px;
            width: 100%;
            padding: 20px;
        }

        /* NAVBAR */
        .navbar {
            background: white;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.05);
        }

        /* CARD STYLE */
        .card-custom {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        /* 🔥 CARD HOVER */
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* TABLE */
        table {
            border-radius: 10px;
            overflow: hidden;
        }

        /* 🔥 ROW HOVER */
        tbody tr:hover {
            background: #f1f3f5;
            transition: 0.2s;
        }

    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>🔥 ADMIN</h4>
    <a href="{{ route('admin.accounts') }}">📦Accounts</a>
    <a href="{{ route('admin.categories.index') }}">📦Categories</a>
    <a href="/admin/services">🛠 Services</a>
    <a href="#">👤 Users</a>
</div>

<!-- CONTENT -->
<div class="content">

    <!-- NAVBAR -->
    <div class="navbar mb-4">
        <strong>Dashboard</strong>
    </div>

    @yield('content')

</div>

</body>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
</html>