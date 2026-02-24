<?php include '../../core_shared/header.php'; ?>

<div class="container" style="margin-top: 30px;">
    <h1 style="margin-bottom: 10px;">Căn hộ Studio trung tâm Sài Gòn</h1>
    <p style="color: var(--text-gray); margin-bottom: 20px;">⭐ 4.95 (120 đánh giá) · Quận 1, TP. Hồ Chí Minh</p>

    <div style="display: flex; gap: 10px; height: 400px; border-radius: 16px; overflow: hidden;">
        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800" style="flex: 2; object-fit: cover; width: 100%;">
        <div style="flex: 1; display: flex; flex-direction: column; gap: 10px;">
            <img src="https://images.unsplash.com/photo-1502672260266-1c1de2d96200?w=400" style="flex: 1; object-fit: cover; width: 100%;">
            <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?w=400" style="flex: 1; object-fit: cover; width: 100%;">
        </div>
    </div>

    <div class="split-layout">
        <div class="main-content">
            <h2>Toàn bộ căn hộ được cho thuê bởi Host Huy</h2>
            <p style="color: var(--text-gray);">2 khách · 1 phòng ngủ · 1 giường · 1 phòng tắm</p>
            <hr style="border: 0; border-top: 1px solid var(--border); margin: 30px 0;">
            
            <h3>Nơi này có những gì cho bạn</h3>
            <ul style="line-height: 2; padding-left: 20px; color: var(--text-dark);">
                <li>Bếp đầy đủ dụng cụ</li>
                <li>Wi-fi tốc độ cao</li>
                <li>Điều hòa nhiệt độ</li>
                <li>Bể bơi vô cực trên sân thượng</li>
            </ul>
        </div>

        <div class="sidebar">
            <div class="sticky-widget">
                <h2 style="margin-top: 0;">1.200.000 ₫ <span style="font-size: 16px; font-weight: normal; color: var(--text-gray);">/ đêm</span></h2>
                
                <form action="../task4/checkout.php" method="GET" style="margin-top: 20px;">
                    <input type="hidden" name="room_id" value="2">
                    <div style="border: 1px solid var(--border); border-radius: 8px; overflow: hidden; margin-bottom: 16px;">
                        <div style="display: flex; border-bottom: 1px solid var(--border);">
                            <div style="flex: 1; padding: 10px; border-right: 1px solid var(--border);">
                                <label style="font-size: 10px; font-weight: bold;">NHẬN PHÒNG</label>
                                <input type="date" name="check_in" style="width: 100%; border: none; outline: none; margin-top: 5px;">
                            </div>
                            <div style="flex: 1; padding: 10px;">
                                <label style="font-size: 10px; font-weight: bold;">TRẢ PHÒNG</label>
                                <input type="date" name="check_out" style="width: 100%; border: none; outline: none; margin-top: 5px;">
                            </div>
                        </div>
                        <div style="padding: 10px;">
                            <label style="font-size: 10px; font-weight: bold;">KHÁCH</label>
                            <select name="guests" style="width: 100%; border: none; outline: none; margin-top: 5px;">
                                <option value="1">1 khách</option>
                                <option value="2">2 khách</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Đặt phòng (Sang Task 4)</button>
                </form>
                
                <p style="text-align: center; color: var(--text-gray); font-size: 14px; margin-top: 15px;">Bạn vẫn chưa bị trừ tiền</p>
            </div>
        </div>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>