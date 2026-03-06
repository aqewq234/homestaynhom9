<?php 
require_once '../../core_shared/database.php';
include '../../core_shared/header.php'; 

$id_phong = isset($_GET['id_phong']) ? (int)$_GET['id_phong'] : 0;
$stmt = $pdo->prepare("SELECT * FROM phong WHERE id_phong = :id");
$stmt->execute(['id' => $id_phong]);
$phong = $stmt->fetch();

if (!$phong) { echo "<div class='container mt-5'><h3>Phòng không tồn tại</h3></div>"; exit; }
?>

<div class="container mt-4">
    <h1 class="fw-bold mb-1"><?php echo htmlspecialchars($phong['ten_phong']); ?></h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="fw-semibold text-decoration-underline"><i class="fa-solid fa-star"></i> 5.0 · <?php echo htmlspecialchars($phong['dia_chi'] . ', ' . $phong['thanh_pho']); ?></div>
        <div class="fw-semibold text-decoration-underline cursor-pointer"><i class="fa-regular fa-heart"></i> Lưu</div>
    </div>

    <div class="row g-2 mb-5 rounded-4 overflow-hidden" style="height: 400px;">
        <div class="col-6 h-100">
            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800" class="w-100 h-100 object-fit-cover" alt="Ảnh chính">
        </div>
        <div class="col-6 h-100 d-flex flex-column gap-2">
            <img src="https://images.unsplash.com/photo-1502672260266-1c1de2d96200?w=500" class="w-100 h-50 object-fit-cover" alt="Ảnh phụ 1">
            <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?w=500" class="w-100 h-50 object-fit-cover" alt="Ảnh phụ 2">
        </div>
    </div>

    <div class="row position-relative">
        
        <div class="col-lg-8 pe-lg-5 mb-4">
            <h3 class="fw-semibold">Toàn bộ chỗ ở do Host quản lý</h3>
            <p class="text-muted fs-5"><?php echo $phong['so_khach_toi_da']; ?> khách · 1 phòng ngủ · 1 giường · 1 phòng tắm</p>
            <hr class="my-4">
            
            <div class="d-flex align-items-start gap-3 mb-4">
                <i class="fa-solid fa-door-open fs-3 text-dark"></i>
                <div>
                    <h5 class="mb-1 fw-semibold">Tự nhận phòng</h5>
                    <p class="text-muted mb-0">Tự nhận phòng bằng hộp khóa an toàn.</p>
                </div>
            </div>

            <hr class="my-4">
            <h4 class="fw-semibold mb-3">Giới thiệu về không gian này</h4>
            <p style="line-height: 1.7;"><?php echo nl2br(htmlspecialchars($phong['mo_ta'])); ?></p>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg border-0 rounded-4 p-4 sticky-top" style="top: 100px; z-index: 10;">
                <h4 class="fw-bold mb-4"><?php echo number_format($phong['gia_moi_dem']); ?> ₫ <span class="fs-6 fw-normal text-muted">/ đêm</span></h4>
                
                <form action="../task4/api_booking.php" method="POST">
                    <input type="hidden" name="id_phong" value="<?php echo $phong['id_phong']; ?>">
                    <input type="hidden" name="gia_moi_dem" value="<?php echo $phong['gia_moi_dem']; ?>">
                    
                    <div class="border rounded-3 mb-3">
                        <div class="d-flex border-bottom">
                            <div class="p-2 flex-fill border-end">
                                <label class="form-label text-uppercase fw-bold mb-0" style="font-size: 10px;">Nhận phòng</label>
                                <input type="date" class="form-control form-control-sm border-0 shadow-none px-0" name="ngay_nhan" required>
                            </div>
                            <div class="p-2 flex-fill">
                                <label class="form-label text-uppercase fw-bold mb-0" style="font-size: 10px;">Trả phòng</label>
                                <input type="date" class="form-control form-control-sm border-0 shadow-none px-0" name="ngay_tra" required>
                            </div>
                        </div>
                        <div class="p-2">
                            <label class="form-label text-uppercase fw-bold mb-0" style="font-size: 10px;">Khách</label>
                            <select class="form-select form-select-sm border-0 shadow-none px-0" name="so_khach">
                                <option value="1">1 khách</option>
                                <option value="2">2 khách</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-airbnb w-100 py-3 fs-5">Đặt phòng</button>
                    <div class="text-center mt-3 text-muted small">Bạn vẫn chưa bị trừ tiền</div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>