<?php 
// Lấy dữ liệu demo từ URL (Do form ở trang detail truyền sang)
$check_in = isset($_GET['check_in']) ? $_GET['check_in'] : '2026-03-01';
$check_out = isset($_GET['check_out']) ? $_GET['check_out'] : '2026-03-03';
include '../../core_shared/header.php'; 
?>

<div class="container" style="margin-top: 40px; max-width: 1000px;">
    <h1>Yêu cầu đặt phòng</h1>

    <div class="split-layout">
        <div class="main-content">
            <h3 style="margin-bottom: 20px;">Chuyến đi của bạn</h3>
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <div>
                    <strong>Ngày</strong>
                    <p style="margin: 5px 0 0 0; color: var(--text-gray);"><?php echo $check_in; ?> đến <?php echo $check_out; ?></p>
                </div>
            </div>

            <hr style="border: 0; border-top: 1px solid var(--border); margin: 30px 0;">

            <h3>Phương thức thanh toán</h3>
            <div style="border: 1px solid var(--border); border-radius: 8px; padding: 20px; margin-top: 20px;">
                <label style="display: block; margin-bottom: 15px;">
                    <input type="radio" name="payment" checked> Thanh toán qua thẻ tín dụng
                </label>
                <label style="display: block; margin-bottom: 15px;">
                    <input type="radio" name="payment"> Momo / VNPay
                </label>
                <label style="display: block;">
                    <input type="radio" name="payment"> Tiền mặt khi nhận phòng
                </label>
            </div>

            <button class="btn btn-primary" style="margin-top: 30px; padding: 15px 40px; font-size: 16px;">Xác nhận và Thanh toán</button>
        </div>

        <div class="sidebar">
            <div class="sticky-widget">
                <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=150" style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover;">
                    <div>
                        <p style="margin: 0; font-size: 14px; color: var(--text-gray);">Toàn bộ căn hộ</p>
                        <p style="margin: 5px 0 0 0; font-weight: 600;">Căn hộ Studio trung tâm Sài Gòn</p>
                    </div>
                </div>
                
                <hr style="border: 0; border-top: 1px solid var(--border); margin: 20px 0;">
                
                <h3 style="margin-top: 0;">Chi tiết giá</h3>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color: var(--text-gray);">1.200.000 ₫ x 2 đêm</span>
                    <span>2.400.000 ₫</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color: var(--text-gray);">Phí vệ sinh</span>
                    <span>150.000 ₫</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color: var(--text-gray);">Phí dịch vụ hệ thống</span>
                    <span>200.000 ₫</span>
                </div>
                
                <hr style="border: 0; border-top: 1px solid var(--border); margin: 20px 0;">
                
                <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px;">
                    <span>Tổng tiền (VND)</span>
                    <span>2.750.000 ₫</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>