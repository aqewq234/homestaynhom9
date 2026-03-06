<?php include '../../core_shared/header.php'; ?>

<div class="container mt-5" style="min-height: 60vh;">
    <h1 class="fw-bold mb-4">Chuyến đi của bạn</h1>

    <ul class="nav nav-tabs fs-5 mb-4" id="tripTabs">
        <li class="nav-item">
            <a class="nav-link active text-dark fw-semibold" data-bs-toggle="tab" href="#upcoming">Sắp tới</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted" data-bs-toggle="tab" href="#completed">Đã hoàn thành</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted" data-bs-toggle="tab" href="#cancelled">Đã hủy</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="upcoming">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=500" class="img-fluid h-100 object-fit-cover" alt="Sài Gòn">
                    </div>
                    <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                        <div class="text-muted mb-1">05 tháng 5 - 10 tháng 5, 2026</div>
                        <h4 class="fw-bold mb-2">Căn hộ Studio Quận 1</h4>
                        <p class="text-muted mb-0">Quận 1, TP. Hồ Chí Minh</p>
                    </div>
                    <div class="col-md-3 bg-light p-4 d-flex flex-column justify-content-center border-start">
                        <span class="badge bg-warning text-dark align-self-start mb-2 fs-6">Chờ thanh toán</span>
                        <h4 class="fw-bold mb-3">6.000.000 ₫</h4>
                        
                        <a href="thanh_toan.php?id_don=1" class="btn btn-danger w-100 fw-semibold py-2">Thanh toán ngay</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="completed">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="row g-0 opacity-75">
                    <div class="col-md-3">
                        <img src="https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=500" class="img-fluid h-100 object-fit-cover">
                    </div>
                    <div class="col-md-6 p-4">
                        <div class="text-muted mb-1">12 tháng 4 - 15 tháng 4, 2026</div>
                        <h5 class="fw-bold">Cabin Đà Lạt View Núi</h5>
                        <p class="text-muted">Đã thanh toán: 2.550.000 ₫</p>
                    </div>
                    <div class="col-md-3 p-4 border-start d-flex align-items-center">
                        
                        <a href="../task9/danh_gia.php?id_don=2" class="btn btn-outline-dark w-100 fw-semibold py-2">Đánh giá chỗ ở</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="cancelled">
            <div class="p-5 text-center text-muted">
                <i class="bi bi-airplane-engines fs-1 mb-3"></i>
                <h5>Bạn không có chuyến đi nào bị hủy</h5>
            </div>
        </div>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>