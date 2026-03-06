<?php
require_once '../../core_shared/database.php';

// Giả lập user đang đăng nhập là Khách hàng có ID = 2 (Do Task 1 chưa làm xong auth)
$id_khach_hang = 2; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_phong = $_POST['id_phong'];
    $gia_moi_dem = $_POST['gia_moi_dem'];
    $ngay_nhan = $_POST['ngay_nhan'];
    $ngay_tra = $_POST['ngay_tra'];

    // 1. Validate ngày tháng
    if (strtotime($ngay_nhan) >= strtotime($ngay_tra)) {
        die("Lỗi: Ngày trả phòng phải sau ngày nhận phòng! <a href='javascript:history.back()'>Quay lại</a>");
    }

    // 2. TÍNH TỔNG TIỀN (Số đêm x Giá)
    $so_dem = (strtotime($ngay_tra) - strtotime($ngay_nhan)) / (60 * 60 * 24);
    $tong_tien = $so_dem * $gia_moi_dem;

    // 3. LOGIC KIỂM TRA PHÒNG TRỐNG (CHECK AVAILABILITY)
    // Kiểm tra xem có đơn đặt phòng nào trùng lịch không (Trạng thái khác 'tu_choi', 'da_huy')
    $sql_check = "SELECT id_don_dat FROM don_dat_phong 
                  WHERE id_phong = :id_phong 
                  AND trang_thai NOT IN ('tu_choi', 'da_huy')
                  AND (
                        (ngay_nhan_phong <= :ngay_tra AND ngay_tra_phong >= :ngay_nhan)
                  )";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([
        'id_phong' => $id_phong,
        'ngay_nhan' => $ngay_nhan,
        'ngay_tra' => $ngay_tra
    ]);

    if ($stmt_check->rowCount() > 0) {
        // Đã có người đặt
        die("Rất tiếc! Phòng đã có người đặt trong khoảng thời gian này. <a href='javascript:history.back()'>Chọn ngày khác</a>");
    }

    // 4. THÊM VÀO DATABASE (Tạo đơn hàng mới)
    $sql_insert = "INSERT INTO don_dat_phong (id_phong, id_khach_hang, ngay_nhan_phong, ngay_tra_phong, tong_tien, trang_thai) 
                   VALUES (:id_phong, :id_khach, :ngay_nhan, :ngay_tra, :tong_tien, 'cho_thanh_toan')";
    $stmt_insert = $pdo->prepare($sql_insert);
    
    try {
        $stmt_insert->execute([
            'id_phong' => $id_phong,
            'id_khach' => $id_khach_hang,
            'ngay_nhan' => $ngay_nhan,
            'ngay_tra' => $ngay_tra,
            'tong_tien' => $tong_tien
        ]);
        
        // Lấy ID của đơn vừa tạo
        $id_don_dat_moi = $pdo->lastInsertId();

        // 5. THÀNH CÔNG -> CHUYỂN HƯỚNG SANG TASK 5 (Thanh toán)
        // Lưu ý: Tích hợp n8n Webhook có thể chèn tại đây trước khi chuyển trang.
        header("Location: ../task5/checkout.php?id_don=" . $id_don_dat_moi);
        exit();

    } catch (Exception $e) {
        die("Lỗi hệ thống khi tạo đơn: " . $e->getMessage());
    }
} else {
    die("Truy cập không hợp lệ!");
}
?>