<?php 
// modules/task5/thanh_toan.php
include '../../core_shared/header.php'; 

// Giả lập dữ liệu nhận được từ trang Chi tiết phòng (Task 3 & 4)
$ten_phong = "Căn hộ Studio Sài Gòn Center";
$ngay_nhan = "15/05/2026";
$ngay_tra = "18/05/2026";
$so_khach = 2;
$so_dem = 3;
$gia_moi_dem = 1200000;
$phi_ve_sinh = 150000;
$phi_dich_vu = 200000;
$tong_tien = ($gia_moi_dem * $so_dem) + $phi_ve_sinh + $phi_dich_vu;
?>

<style>
    .payment-page { background-color: #f7f7f7; padding-bottom: 60px; }
    .checkout-title { font-weight: 700; font-size: 32px; margin-bottom: 30px; margin-top: 30px; }
    .section-title { font-weight: 600; font-size: 22px; margin-bottom: 20px; }
    
    /* Box chọn phương thức thanh toán */
    .payment-method-box { border: 1px solid #dee2e6; border-radius: 12px; overflow: hidden; background: white; }
    .payment-option { padding: 20px; border-bottom: 1px solid #dee2e6; cursor: pointer; transition: background 0.2s; display: flex; align-items: center; justify-content: space-between;}
    .payment-option:last-child { border-bottom: none; }
    .payment-option:hover { background: #f8f9fa; }
    .payment-option input[type="radio"] { transform: scale(1.5); accent-color: var(--primary-color, #FF385C); }
    
    /* Cột tóm tắt hóa đơn (Sticky) */
    .summary-card { position: sticky; top: 100px; background: white; border: 1px solid #dee2e6; border-radius: 16px; padding: 24px; box-shadow: 0 6px 16px rgba(0,0,0,0.08); }
    .summary-img { width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; }
    .price-row { display: flex; justify-content: space-between; margin-bottom: 12px; color: #495057; }
    .price-row.total { font-weight: 700; font-size: 18px; color: #212529; border-top: 1px solid #dee2e6; padding-top: 15px; margin-top: 15px; }
    
    .btn-confirm { background-color: #FF385C; color: white; padding: 14px 24px; font-size: 18px; font-weight: 600; border-radius: 12px; width: 100%; border: none; transition: 0.3s; }
    .btn-confirm:hover { background-color: #E31C5F; color: white; }
</style>

<div class="payment-page">
    <div class="container">
        <h1 class="checkout-title"><i class="bi bi-chevron-left me-2" style="cursor: pointer; font-size: 24px;" onclick="history.back()"></i> Yêu cầu đặt phòng</h1>
        
        <form action="api_payment.php" method="POST">
            <div class="row g-5">
                <div class="col-lg-7">
                    
                    <div class="mb-5 bg-white p-4 rounded-4 border">
                        <h2 class="section-title">Chuyến đi của bạn</h2>
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <h6 class="fw-bold mb-1">Ngày</h6>
                                <p class="text-muted mb-0"><?= $ngay_nhan ?> – <?= $ngay_tra ?></p>
                            </div>
                            <a href="#" class="text-dark fw-bold text-decoration-underline">Chỉnh sửa</a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="fw-bold mb-1">Khách</h6>
                                <p class="text-muted mb-0"><?= $so_khach ?> khách</p>
                            </div>
                            <a href="#" class="text-dark fw-bold text-decoration-underline">Chỉnh sửa</a>
                        </div>
                    </div>

                    <hr class="mb-5">

                    <div class="mb-5">
                        <h2 class="section-title">Thanh toán bằng</h2>
                        <div class="payment-method-box shadow-sm">
                            <label class="payment-option">
                                <div>
                                    <i class="bi bi-credit-card-2-front text-primary me-2 fs-4"></i>
                                    <span class="fw-bold">Thẻ Tín dụng / Ghi nợ</span>
                                </div>
                                <input type="radio" name="phuong_thuc" value="the_tin_dung" checked>
                            </label>
                            
                            <label class="payment-option">
                                <div>
                                    <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" alt="Momo" style="height: 24px; margin-right: 10px;">
                                    <span class="fw-bold">Ví MoMo</span>
                                </div>
                                <input type="radio" name="phuong_thuc" value="momo">
                            </label>

                            <label class="payment-option">
                                <div>
                                    <img src="https://vnpay.vn/s1/statics.vnpay.vn/2023/9/06ncktiwd6dc1694418186387.png" alt="VNPay" style="height: 24px; margin-right: 10px;">
                                    <span class="fw-bold">VNPay</span>
                                </div>
                                <input type="radio" name="phuong_thuc" value="vnpay">
                            </label>
                        </div>
                    </div>

                    <p class="text-muted" style="font-size: 13px;">Bằng việc chọn nút bên dưới, tôi đồng ý với Nội quy nhà của Chủ nhà, Quy chuẩn chung đối với khách và Chính sách đặt phòng của hệ thống.</p>
                    <button type="submit" class="btn-confirm mt-3">Xác nhận và thanh toán</button>
                </div>

                <div class="col-lg-5">
                    <div class="summary-card">
                        <div class="d-flex gap-3 border-bottom pb-4 mb-4">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=300" class="rounded-3" style="width: 120px; height: 100px; object-fit: cover;" alt="Phòng">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 13px;">Toàn bộ căn hộ</p>
                                <h5 class="fw-bold" style="font-size: 16px;"><?= $ten_phong ?></h5>
                                <p class="mb-0 mt-2" style="font-size: 14px;"><i class="bi bi-star-fill text-warning"></i> <span class="fw-bold">4.95</span> (120 đánh giá)</p>
                            </div>
                        </div>

                        <h4 class="fw-bold fs-5 mb-4">Chi tiết giá</h4>
                        
                        <div class="price-row">
                            <span><?= number_format($gia_moi_dem, 0, ',', '.') ?> ₫ x <?= $so_dem ?> đêm</span>
                            <span><?= number_format($gia_moi_dem * $so_dem, 0, ',', '.') ?> ₫</span>
                        </div>
                        <div class="price-row">
                            <span class="text-decoration-underline">Phí vệ sinh</span>
                            <span><?= number_format($phi_ve_sinh, 0, ',', '.') ?> ₫</span>
                        </div>
                        <div class="price-row">
                            <span class="text-decoration-underline">Phí dịch vụ hệ thống</span>
                            <span><?= number_format($phi_dich_vu, 0, ',', '.') ?> ₫</span>
                        </div>
                        
                        <div class="price-row total">
                            <span>Tổng tiền (VND)</span>
                            <span><?= number_format($tong_tien, 0, ',', '.') ?> ₫</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>