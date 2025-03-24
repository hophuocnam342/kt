<?php
// Bật hiển thị lỗi cho dễ debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Bắt đầu session
session_start();

// Xác định controller và action
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Chuẩn hóa tên controller
$controller = ucfirst(strtolower($controller)) . 'Controller';
$controllerFile = 'controllers/' . $controller . '.php';

// Kiểm tra nếu file controller tồn tại
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerInstance = new $controller();
    
    // Kiểm tra nếu phương thức (action) tồn tại
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        // Nếu action không tồn tại, chuyển hướng về trang chủ
        header('Location: index.php');
    }
} else {
    // Tạo HomeController mặc định nếu không có controller được chỉ định
    require_once 'controllers/HomeController.php';
    $homeController = new HomeController();
    $homeController->index();
}