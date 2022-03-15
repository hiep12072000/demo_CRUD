<?php
session_start();
//lấy ra tham số controller và action từ trình duyệt
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'category';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = ucfirst($controller); //Book
$controller .= "Controller"; //BookController
//controllers/BookController.php
$path_controller = "controllers/$controller.php";
//controller/BookController.php
//kiểm tra nếu đường dẫn
if (file_exists($path_controller) == false) {
  die('Trang bạn tìm không tồn tại');
}
require_once "$path_controller";
//khởi tạo đối tượng sau khi nhúng file
$object = new $controller(); //$object = new BookController()
if (method_exists($object, $action) == false) {
  die("Không tồn tại phương thức $action của class $controller");
}
//index.php?controller=book&action=create
$object->$action();
?>
