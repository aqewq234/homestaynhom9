<?php include '../../core_shared/header.php'; ?>

<div style="max-width: 400px; margin: 0 auto; padding: 30px; border: 1px solid #ddd; border-radius: 10px;">
    <h2 style="text-align: center; color: #FF385C;">Đăng nhập</h2>
    <form action="api_auth.php" method="POST">
        <div style="margin-bottom: 15px;">
            <label>Email:</label>
            <input type="email" name="email" style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label>Mật khẩu:</label>
            <input type="password" name="password" style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Đăng nhập</button>
    </form>
</div>

<?php include '../../core_shared/footer.php'; ?>