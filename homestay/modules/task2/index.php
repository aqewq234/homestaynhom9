<?php include '../../core_shared/header.php'; ?>

<div class="container" style="margin-top: 40px; margin-bottom: 40px;">
    <div style="background: white; border: 1px solid var(--border); border-radius: 40px; padding: 10px; display: flex; align-items: center; box-shadow: var(--shadow); max-width: 800px; margin: 0 auto;">
        <input type="text" placeholder="Địa điểm bất kỳ" style="flex: 1; border: none; padding: 10px 20px; outline: none; border-right: 1px solid var(--border);">
        <input type="date" style="flex: 1; border: none; padding: 10px 20px; outline: none; border-right: 1px solid var(--border);">
        <input type="number" placeholder="Số khách" style="flex: 1; border: none; padding: 10px 20px; outline: none;">
        <button class="btn btn-primary" style="border-radius: 50%; width: 48px; height: 48px; padding: 0;">🔍</button>
    </div>
</div>

<div class="container">
    <h2 style="margin-bottom: 20px;">Điểm đến thịnh hành</h2>
    <div class="room-grid">
        <a href="../task3/detail.php?id=1" class="room-card">
            <img src="https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=500" class="room-img" alt="Phòng Đạt Lạt">
            <h3 class="room-title">Đà Lạt, Lâm Đồng</h3>
            <p class="room-desc">Nhìn ra núi thung lũng</p>
            <p class="room-price">850.000 ₫ <span style="font-weight: normal;">/ đêm</span></p>
        </a>

        <a href="../task3/detail.php?id=2" class="room-card">
            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=500" class="room-img" alt="Căn hộ HCM">
            <h3 class="room-title">Quận 1, TP. Hồ Chí Minh</h3>
            <p class="room-desc">Căn hộ Studio trung tâm</p>
            <p class="room-price">1.200.000 ₫ <span style="font-weight: normal;">/ đêm</span></p>
        </a>

        <a href="../task3/detail.php?id=3" class="room-card">
            <img src="https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=500" class="room-img" alt="Vũng Tàu">
            <h3 class="room-title">Vũng Tàu, Bà Rịa</h3>
            <p class="room-desc">Cách bãi biển 50m</p>
            <p class="room-price">950.000 ₫ <span style="font-weight: normal;">/ đêm</span></p>
        </a>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>