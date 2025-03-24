<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Sinh viên</title>
    <style>
        :root {
            --light-green: #4ade80;
            --medium-green: #22c55e;
            --dark-green: #16a34a;
            --light-bg: #ffffff;
            --light-gray: #f8f9fa;
            --border-color: #e9ecef;
            --text-color: #333333;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light-bg);
            color: var(--text-color);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .navbar {
            background-color: var(--medium-green);
            color: white;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        
        .navbar li {
            float: left;
        }
        
        .navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 5px;
            margin: 0 5px;
        }
        
        .navbar li a:hover {
            background-color: var(--dark-green);
        }
        
        h1, h2, h3 {
            color: var(--dark-green);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: var(--light-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        th {
            background-color: var(--light-gray);
            color: var(--dark-green);
            font-weight: bold;
        }
        
        tr:hover {
            background-color: var(--light-gray);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-weight: bold;
        }
        
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            background-color: var(--light-bg);
            color: var(--text-color);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            box-shadow: 0 0 5px var(--medium-green);
            border-color: var(--medium-green);
        }
        
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: var(--medium-green);
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        
        .btn:hover {
            background-color: var(--dark-green);
        }
        
        .btn-danger {
            background-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #bb2d3b;
        }
        
        .btn-info {
            background-color: #0dcaf0;
        }
        
        .btn-info:hover {
            background-color: #0aa2c0;
        }
        
        /* Card Style */
        .card {
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-color);
        }
        
        /* Message alerts */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }
        
        /* Image styling */
        img {
            border-radius: 5px;
            border: 1px solid var(--border-color);
        }
        
        /* Trang chủ styling */
        .hero {
            text-align: center;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        
        .hero h1 {
            color: var(--dark-green);
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .feature-card {
            flex: 1;
            min-width: 250px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: var(--light-bg);
            border-top: 4px solid var(--medium-green);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .feature-card h2 {
            color: var(--dark-green);
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="index.php?controller=student&action=index">Sinh Viên</a></li>
            <li><a href="index.php?controller=course&action=index">Học Phần</a></li>
            <li><a href="index.php?controller=registration&action=register">Đăng Ký</a></li>
            <?php if(isset($_SESSION['MaSV'])): ?>
                <li style="float:right"><a href="index.php?controller=auth&action=logout">Đăng xuất</a></li>
                <li style="float:right"><a href="#"><?php echo $_SESSION['HoTen'] ?? ''; ?></a></li>
            <?php else: ?>
                <li style="float:right"><a href="index.php?controller=auth&action=login">Đăng nhập</a></li>
            <?php endif; ?>
        </ul>
    </div>
    
    <div class="container">
