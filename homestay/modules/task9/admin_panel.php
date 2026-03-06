<?php include '../../core_shared/header.php'; ?>

<div class="container mt-5" style="min-height: 70vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-danger"><i class="fa-solid fa-shield-halved me-2"></i> Quản trị Hệ thống</h1>
        <button class="btn btn-outline-danger fw-semibold">Đăng xuất Admin</button>
    </div>

    <div class="row">
        <div class="col-12 mb-5">
            <h4 class="fw-bold mb-3">Quản lý Tài khoản (Users)</h4>
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td class="fw-semibold">Host Minh Huy</td>
                            <td>chunha@gmail.com</td>
                            <td><span class="badge bg-primary">Chủ nhà</span></td>
                            <td><span class="badge bg-success">Hoạt động</span></td>
                            <td><button class="btn btn-sm btn-danger fw-semibold">Khóa tài khoản</button></td>
                        </tr>
                        <tr>
                            <td>#2</td>
                            <td class="fw-semibold">Trần Văn Spam</td>
                            <td>spam@gmail.com</td>
                            <td><span class="badge bg-secondary">Khách</span></td>
                            <td><span class="badge bg-danger">Bị khóa</span></td>
                            <td><button class="btn btn-sm btn-success fw-semibold">Mở khóa</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12">
            <h4 class="fw-bold mb-3">Duyệt & Quản lý Bài đăng (Rooms)</h4>
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>ID Phòng</th>
                            <th>Tên chỗ ở</th>
                            <th>Chủ nhà</th>
                            <th>Giá/Đêm</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#105</td>
                            <td class="fw-semibold"><a href="../task3/detail.php?id_phong=105" class="text-dark">Villa Vũng Tàu</a></td>
                            <td>Host Minh Huy</td>
                            <td>2.500.000 ₫</td>
                            <td><span class="badge bg-warning text-dark">Chờ duyệt</span></td>
                            <td>
                                <button class="btn btn-sm btn-success fw-semibold me-1">Duyệt hiển thị</button>
                                <button class="btn btn-sm btn-outline-danger fw-semibold">Từ chối</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>