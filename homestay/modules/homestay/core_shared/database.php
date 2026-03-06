<?php
// homestay-project/core_shared/database.php
$host = 'localhost';
$db   = 'he_thong_homestay'; // Tên CSDL bạn vừa tạo bằng đoạn code trên
$user = 'root'; // Tài khoản mặc định của XAMPP
$pass = '';     // Mật khẩu mặc định của XAMPP thường để trống
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}
?>