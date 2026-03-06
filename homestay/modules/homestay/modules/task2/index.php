<?php 
require_once '../../core_shared/database.php';
include '../../core_shared/header.php'; 

// XỬ LÝ LOGIC TÌM KIẾM & LỌC (BACKEND)
$diadiem = isset($_GET['diadiem']) ? trim($_GET['diadiem']) : '';
$danhmuc = isset($_GET['danhmuc']) ? trim($_GET['danhmuc']) : '';
$sokhach = isset($_GET['sokhach']) ? (int)$_GET['sokhach'] : 1;

$sql = "SELECT p.*, a.duong_dan_anh 
        FROM phong p 
        LEFT JOIN hinh_anh_phong a ON p.id_phong = a.id_phong AND a.la_anh_bia = 1 
        WHERE p.trang_thai = 'hoat_dong' AND p.so_khach_toi_da >= :sokhach";
$params = ['sokhach' => $sokhach];

if (!empty($diadiem)) {
    $sql .= " AND (p.thanh_pho LIKE :diadiem OR p.dia_chi LIKE :diadiem)";
    $params['diadiem'] = '%' . $diadiem . '%';
}
if (!empty($danhmuc)) {
    $sql .= " AND p.loai_phong = :danhmuc";
    $params['danhmuc'] = $danhmuc;
}
$sql .= " ORDER BY p.ngay_tao DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$danh_sach_phong = $stmt->fetchAll();
?>

<style>
    /* 1. KHU VỰC TÌM KIẾM ĐỔ NỀN GRADIENT */
    .hero-section { 
        background: linear-gradient(180deg, #FFF0F2 0%, #FFFFFF 100%); 
        padding: 40px 0 20px 0; 
        border-bottom: 1px solid var(--border-light);
    }
    
    .hero-title { text-align: center; font-weight: 800; font-size: 32px; margin-bottom: 24px; color: var(--airbnb); }

    /* Thanh tìm kiếm nổi bật 3D */
    .search-pill-form { 
        background: #ffffff; 
        border: 1px solid rgba(0,0,0,0.05); 
        border-radius: 60px; 
        box-shadow: 0 16px 32px rgba(255, 56, 92, 0.15); /* Đổ bóng ám hồng */
        display: flex; align-items: center; padding: 10px 12px; 
        width: 100%; max-width: 900px; margin: 0 auto;
        transition: transform 0.2s ease; 
    }
    .search-pill-form:hover { transform: translateY(-2px); box-shadow: 0 20px 40px rgba(255, 56, 92, 0.2); }
    
    .search-input-group { flex: 1; padding: 8px 24px; border-right: 1px solid var(--border-light); }
    .search-input-group:last-of-type { border-right: none; }
    .search-input-group:hover { background: #F7F7F7; border-radius: 40px; }
    
    .search-label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 2px; }
    .search-input { border: none; background: transparent; outline: none; width: 100%; font-size: 15px; color: var(--text-dark); font-weight: 600; }
    .search-input::placeholder { color: #A0A0A0; font-weight: 400; }
    
    .search-btn-large { background: var(--airbnb); color: white; border: none; border-radius: 50px; padding: 14px 32px; font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 10px; transition: 0.2s; }
    .search-btn-large:hover { background: #E31C5F; }

    /* 2. KHU VỰC DANH MỤC: ĐỔI THÀNH NÚT BẤM (PILLS) */
    .categories-bar { display: flex; gap: 16px; overflow-x: auto; padding: 20px 40px; scrollbar-width: none; background: white; }
    .categories-bar::-webkit-scrollbar { display: none; }
    
    .category-item { 
        display: flex; align-items: center; gap: 10px; 
        background-color: #ffffff; border: 1px solid var(--border-light); 
        border-radius: 40px; padding: 12px 24px; 
        color: var(--text-dark); text-decoration: none; min-width: max-content; 
        transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .category-item:hover { border-color: var(--text-dark); box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    
    /* Trạng thái đang chọn (Active) - Tương phản mạnh */
    .category-item.active { background-color: var(--text-dark); color: white; border-color: var(--text-dark); }
    .category-item.active .cat-text { color: white; }
    
    .cat-icon { font-size: 20px; }
    .cat-text { font-size: 15px; font-weight: 600; }
    
    /* 3. LÀM NỔI BẬT KHU VỰC CHỨA PHÒNG */
    .main-listings-bg { background-color: #FAFAFA; padding-top: 30px; padding-bottom: 60px; min-height: 50vh; }
</style>

<div class="hero-section">
    <div class="container">
        <h1 class="hero-title">Tìm chỗ ở hoàn hảo cho chuyến đi của bạn</h1>
        
        <form action="index.php" method="GET" class="search-pill-form">
            <div class="search-input-group">
                <label class="search-label">Địa điểm</label>
                <input type="text" name="diadiem" class="search-input" placeholder="Bạn muốn đến đâu?" value="<?php echo htmlspecialchars($diadiem); ?>">
            </div>
            <div class="search-input-group d-none d-md-block">
                <label class="search-label">Nhận phòng</label>
                <input type="date" name="ngaynhan" class="search-input text-muted">
            </div>
            <div class="search-input-group d-none d-md-block">
                <label class="search-label">Trả phòng</label>
                <input type="date" name="ngaytra" class="search-input text-muted">
            </div>
            <div class="search-input-group pe-3">
                <label class="search-label">Khách</label>
                <input type="number" name="sokhach" class="search-input" placeholder="Số lượng" min="1" value="<?php echo $sokhach; ?>">
            </div>
            <button type="submit" class="search-btn-large">
                <i class="fa-solid fa-magnifying-glass"></i> <span class="d-none d-lg-inline">Tìm kiếm</span>
            </button>
        </form>
    </div>
</div>

<div class="categories-bar">
    <a href="index.php" class="category-item <?php echo empty($danhmuc) ? 'active' : ''; ?>">
        <span class="cat-icon">✨</span><span class="cat-text">Tất cả</span>
    </a>
    <a href="index.php?danhmuc=Thịnh hành" class="category-item <?php echo ($danhmuc == 'Thịnh hành') ? 'active' : ''; ?>">
        <span class="cat-icon">🔥</span><span class="cat-text">Thịnh hành</span>
    </a>
    <a href="index.php?danhmuc=Biệt thự" class="category-item <?php echo ($danhmuc == 'Biệt thự') ? 'active' : ''; ?>">
        <span class="cat-icon">🏡</span><span class="cat-text">Biệt thự</span>
    </a>
    <a href="index.php?danhmuc=Cabin" class="category-item <?php echo ($danhmuc == 'Cabin') ? 'active' : ''; ?>">
        <span class="cat-icon">🏕️</span><span class="cat-text">Cabin</span>
    </a>
    <a href="index.php?danhmuc=Gần biển" class="category-item <?php echo ($danhmuc == 'Gần biển') ? 'active' : ''; ?>">
        <span class="cat-icon">🌊</span><span class="cat-text">Gần biển</span>
    </a>
</div>

<div class="main-listings-bg">
    <div class="content-container">
        
        <?php if (count($danh_sach_phong) > 0): ?>
            <div class="row g-4">
                <?php foreach ($danh_sach_phong as $phong): ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-premium h-100 position-relative border-0 bg-white" style="box-shadow: 0 4px 12px rgba(0,0,0,0.04);">
                        
                        <button class="btn btn-link position-absolute top-0 end-0 p-3 text-white" style="z-index: 10; font-size: 1.5rem; opacity: 0.8; transition: 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                            <i class="fa-regular fa-heart" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));"></i>
                        </button>
                        
                        <div class="ratio" style="--bs-aspect-ratio: 95%;">
                            <img src="<?php echo htmlspecialchars($phong['duong_dan_anh'] ? $phong['duong_dan_anh'] : 'https://via.placeholder.com/600x600?text=Chua+co+anh'); ?>" class="img-premium w-100" style="object-fit: cover;" alt="Hình ảnh phòng">
                        </div>
                        
                        <div class="card-body px-2 py-3">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="fw-bold mb-0 text-truncate pe-2" style="font-size: 15px; color: var(--text-dark);">
                                    <?php echo htmlspecialchars($phong['thanh_pho']); ?>, Việt Nam
                                </h6>
                                <span class="text-dark d-flex align-items-center" style="font-size: 14px;"><i class="fa-solid fa-star me-1" style="font-size: 12px;"></i> 4.96</span>
                            </div>
                            <p class="text-muted mb-0 text-truncate" style="font-size: 15px;"><?php echo htmlspecialchars($phong['ten_phong']); ?></p>
                            <p class="text-muted mb-2" style="font-size: 15px;">Tối đa <?php echo $phong['so_khach_toi_da']; ?> khách</p>
                            <p class="mb-0 fw-semibold text-dark" style="font-size: 15px;">
                                <?php echo number_format($phong['gia_moi_dem'], 0, ',', '.'); ?> ₫ <span class="fw-normal text-muted">/ đêm</span>
                            </p>
                        </div>
    
                        <a href="../task3/detail.php?id_phong=<?php echo $phong['id_phong']; ?>" class="stretched-link"></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5 my-5 bg-white rounded-4 shadow-sm border" style="max-width: 600px; margin: 0 auto;">
                <div class="bg-light rounded-circle d-inline-flex justify-content-center align-items-center mb-4" style="width: 80px; height: 80px;">
                    <i class="fa-solid fa-magnifying-glass fs-2 text-muted"></i>
                </div>
                <h3 class="fw-bold">Không tìm thấy kết quả nào</h3>
                <p class="text-muted mb-4">Thử thay đổi địa điểm hoặc bỏ bớt các bộ lọc để xem thêm kết quả.</p>
                <a href="index.php" class="btn btn-outline-dark fw-semibold px-4 py-2 rounded-pill">Xóa tất cả bộ lọc</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../../core_shared/footer.php'; ?>