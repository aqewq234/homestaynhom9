<?php include '../../core_shared/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-lg border-0 rounded-4" style="width: 100%; max-width: 500px;">
        <div class="card-header bg-white border-bottom text-center py-3 rounded-top-4">
            <h4 class="fw-bold mb-0">Đăng nhập hoặc đăng ký</h4>
        </div>
        <div class="card-body p-4 p-md-5">
            <h3 class="fw-semibold mb-4">Chào mừng bạn đến với HomeStay</h3>
            
            <form action="api_auth.php" method="POST">
                <div class="border rounded-3 mb-3">
                    <div class="form-floating border-bottom">
                        <input type="email" class="form-control border-0 shadow-none" id="emailInput" placeholder="name@example.com" required>
                        <label for="emailInput" class="text-muted">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control border-0 shadow-none" id="passInput" placeholder="Password" required>
                        <label for="passInput" class="text-muted">Mật khẩu</label>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mb-4 small">
                    <label class="form-check-label"><input type="checkbox" class="form-check-input me-1"> Nhớ tài khoản</label>
                    <a href="#" class="text-decoration-underline text-dark fw-semibold">Quên mật khẩu?</a>
                </div>

                <a href="../task2/index.php" class="btn btn-airbnb w-100 py-3 fs-5 mb-3">Tiếp tục</a>
            </form>

            <div class="d-flex align-items-center my-4">
                <hr class="flex-grow-1"><span class="mx-3 text-muted small">hoặc</span><hr class="flex-grow-1">
            </div>

            <button class="btn btn-outline-dark w-100 py-2 mb-3 fw-semibold rounded-3 d-flex align-items-center justify-content-center gap-2">
                <i class="fa-brands fa-google text-danger"></i> Tiếp tục với Google
            </button>
            <button class="btn btn-outline-dark w-100 py-2 fw-semibold rounded-3 d-flex align-items-center justify-content-center gap-2">
                <i class="fa-brands fa-facebook text-primary"></i> Tiếp tục với Facebook
            </button>
        </div>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>