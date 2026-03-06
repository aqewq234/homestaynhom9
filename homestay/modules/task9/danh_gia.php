<?php 
// modules/task9/danh_gia.php
include '../../core_shared/header.php'; 

// Dữ liệu giả lập
$ten_phong = "Đà Lạt View Núi - Cabin Gỗ";
$id_don_dat = 1005;
?>

<style>
    .review-page { background-color: #fcfcfc; padding: 60px 0; min-height: 80vh; }
    .review-container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee; }
    
    .room-preview { display: flex; align-items: center; gap: 15px; background: #f8f9fa; padding: 15px; border-radius: 12px; margin-bottom: 30px; }
    .room-preview img { width: 80px; height: 80px; border-radius: 10px; object-fit: cover; }
    
    /* Thiết kế Ngôi sao chấm điểm */
    .star-rating { display: flex; flex-direction: row-reverse; justify-content: center; gap: 10px; margin: 30px 0; }
    .star-rating input { display: none; }
    .star-rating label { font-size: 40px; color: #ddd; cursor: pointer; transition: 0.2s; }
    
    /* Hiệu ứng: Khi hover hoặc check, đổi màu vàng cho sao đó và các sao đứng trước (nhờ row-reverse) */
    .star-rating label:hover,
    .star-rating label:hover ~ label,
    .star-rating input:checked ~ label {
        color: #FFC107;
    }
    
    .review-textarea { border: 1px solid #ced4da; border-radius: 12px; padding: 15px; resize: none; box-shadow: none; font-size: 15px; }
    .review-textarea:focus { border-color: #FF385C; box-shadow: 0 0 0 0.25rem rgba(255, 56, 92, 0.15); }
    
    .btn-submit-review { background: #222; color: white; border-radius: 12px; padding: 12px; font-weight: 600; font-size: 16px; width: 100%; margin-top: 20px; transition: 0.3s; }
    .btn-submit-review:hover { background: #000; color: white; transform: translateY(-2px); }
</style>

<div class="review-page">
    <div class="container">
        <div class="review-container text-center">
            <h2 class="fw-bold mb-2">Đánh giá trải nghiệm</h2>
            <p class="text-muted mb-4">Chia sẻ cảm nhận của bạn để giúp các khách du lịch khác và chủ nhà.</p>
            
            <div class="room-preview text-start">
                <img src="https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=300" alt="Room">
                <div>
                    <span class="badge bg-success mb-1">Đã hoàn thành</span>
                    <h6 class="fw-bold mb-0"><?= $ten_phong ?></h6>
                    <small class="text-muted">Mã đơn: #<?= $id_don_dat ?></small>
                </div>
            </div>

            <form action="api_danh_gia.php" method="POST">
                <input type="hidden" name="id_don_dat" value="<?= $id_don_dat ?>">
                
                <h5 class="fw-bold mt-4">Bạn chấm chỗ ở này bao nhiêu sao?</h5>
                
                <div class="star-rating">
                    <input type="radio" id="star5" name="so_sao" value="5" required />
                    <label for="star5" title="Tuyệt vời"><i class="bi bi-star-fill"></i></label>
                    
                    <input type="radio" id="star4" name="so_sao" value="4" />
                    <label for="star4" title="Rất tốt"><i class="bi bi-star-fill"></i></label>
                    
                    <input type="radio" id="star3" name="so_sao" value="3" />
                    <label for="star3" title="Bình thường"><i class="bi bi-star-fill"></i></label>
                    
                    <input type="radio" id="star2" name="so_sao" value="2" />
                    <label for="star2" title="Tệ"><i class="bi bi-star-fill"></i></label>
                    
                    <input type="radio" id="star1" name="so_sao" value="1" />
                    <label for="star1" title="Rất tệ"><i class="bi bi-star-fill"></i></label>
                </div>

                <div class="text-start mt-4">
                    <label class="fw-bold mb-2">Bình luận của bạn</label>
                    <textarea class="form-control review-textarea" name="binh_luan" rows="4" placeholder="Chỗ ở sạch sẽ không? Host có nhiệt tình không? Ví trí có thuận tiện không?..." required></textarea>
                </div>

                <button type="submit" class="btn btn-submit-review">Gửi đánh giá</button>
            </form>
        </div>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>