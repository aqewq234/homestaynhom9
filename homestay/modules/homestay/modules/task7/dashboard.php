<?php include '../../core_shared/header.php'; ?>

<div class="container-fluid mt-4 px-lg-5">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-center gap-3 mb-4 px-2 mt-2">
                    <div class="bg-dark text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px; font-size: 20px;">H</div>
                    <div>
                        <h5 class="fw-bold mb-0">Host Minh Huy</h5>
                        <a href="../task3/detail.php?id_phong=2" class="text-muted small text-decoration-underline">Xem hồ sơ</a>
                    </div>
                </div>
                <div class="list-group list-group-flush gap-2">
                    <a href="#" class="list-group-item list-group-item-action border-0 rounded-3 active bg-light text-dark fw-semibold"><i class="fa-solid fa-chart-line me-2"></i> Tổng quan</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 rounded-3"><i class="fa-solid fa-book-open me-2"></i> Đơn đặt phòng</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 rounded-3"><i class="fa-solid fa-calendar-days me-2"></i> Lịch & Khóa phòng</a>
                    <a href="../task6/wizard.php" class="list-group-item list-group-item-action border-0 rounded-3"><i class="fa-solid fa-plus me-2"></i> Thêm phòng mới (T6)</a>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <h2 class="fw-bold mb-4">Tổng quan hôm nay</h2>
            
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-airbnb text-white">
                        <p class="mb-1 opacity-75 fw-semibold">Thu nhập tháng này</p>
                        <h2 class="fw-bold mb-0">12.500.000 ₫</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <p class="text-muted mb-1 fw-semibold">Đơn chờ duyệt</p>
                        <h2 class="fw-bold text-dark mb-0">3 <i class="fa-solid fa-bell text-warning fs-5 ms-2"></i></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <p class="text-muted mb-1 fw-semibold">Đánh giá trung bình</p>
                        <h2 class="fw-bold text-dark mb-0">4.95 <i class="fa-solid fa-star text-warning fs-5 ms-2"></i></h2>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Đơn đặt phòng gần đây</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Khách hàng</th>
                                <th>Phòng</th>
                                <th>Ngày nhận - trả</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="fw-semibold">Nguyễn Văn A</div><div class="small text-muted">0901234567</div></td>
                                <td>Căn hộ Studio Quận 1</td>
                                <td>05/05/2026 - 10/05/2026</td>
                                <td class="fw-semibold">6.000.000 ₫</td>
                                <td><span class="badge bg-success">Đã thanh toán</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-dark fw-semibold">Duyệt</button>
                                    <a href="../task8/chat_box.php" class="btn btn-sm btn-light border"><i class="fa-regular fa-comment"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>