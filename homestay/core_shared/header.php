<?php 
// Lấy tên file hiện tại đang chạy (vd: index.php, detail.php, login.php)
$current_page = basename($_SERVER['PHP_SELF']); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homestay Booking - Trải nghiệm tuyệt vời</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        /* CSS TOÀN CỤC - HỆ THỐNG THIẾT KẾ (DESIGN SYSTEM) */
        :root { 
            --airbnb: #FF385C; 
            --bg-gray: #F7F7F7; 
            --text-dark: #222222;
            --text-muted: #717171;
        }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; color: var(--text-dark); background-color: #ffffff; }
        
        /* Tiện ích (Utilities) */
        .text-airbnb { color: var(--airbnb) !important; }
        .bg-airbnb { background-color: var(--airbnb) !important; color: white; }
        .btn-airbnb { background-color: var(--airbnb); color: white; font-weight: 600; border-radius: 0.5rem; transition: transform 0.2s, box-shadow 0.2s; }
        .btn-airbnb:hover { background-color: #E31C5F; color: white; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(227, 28, 95, 0.25); }
        .cursor-pointer { cursor: pointer; }

        /* Navbar Cao Cấp */
        .navbar-custom { background: white; border-bottom: 1px solid #EBEBEB; padding: 15px 0; z-index: 1030; }
        .brand-logo { color: var(--airbnb); font-size: 1.5rem; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: opacity 0.2s; }
        .brand-logo:hover { opacity: 0.8; color: var(--airbnb); }
        
        /* Thanh tìm kiếm thu nhỏ (Chỉ hiện ở các trang phụ) */
        .mini-search-bar { border: 1px solid #DDDDDD; border-radius: 40px; box-shadow: 0 1px 2px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.05); transition: box-shadow 0.2s ease; cursor: pointer; background: white; }
        .mini-search-bar:hover { box-shadow: 0 2px 4px rgba(0,0,0,0.18); }
        .mini-search-text { font-size: 14px; font-weight: 600; padding: 0 16px; border-right: 1px solid #DDDDDD; color: var(--text-dark); }
        .mini-search-text.light { color: var(--text-muted); font-weight: 400; border-right: none; }
        .mini-search-icon { background: var(--airbnb); color: white; border-radius: 50%; width: 32px; height: 32px; display: flex; justify-content: center; align-items: center; }

        /* Menu Tài khoản */
        .nav-link-custom { font-size: 14px; font-weight: 600; color: var(--text-dark); padding: 10px 15px; border-radius: 30px; transition: background 0.2s; text-decoration: none; }
        .nav-link-custom:hover { background: var(--bg-gray); color: var(--text-dark); }
        .user-dropdown-btn { border: 1px solid #DDDDDD; border-radius: 30px; padding: 5px 5px 5px 12px; background: white; transition: box-shadow 0.2s; }
        .user-dropdown-btn:hover { box-shadow: 0 2px 4px rgba(0,0,0,0.18); }
    </style>
</head>
<body>

    <nav class="navbar-custom sticky-top">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row align-items-center w-100 mx-0">
                
                <div class="col-4 col-lg-4 px-0">
                    <a class="brand-logo" href="../task2/index.php">
                        <i class="fa-brands fa-airbnb" style="font-size: 2.2rem;"></i>
                        <span class="d-none d-md-inline">HomeStay</span>
                    </a>
                </div>

                <div class="col-4 col-lg-4 px-0 d-flex justify-content-center">
                    <?php 
                    // NẾU KHÔNG PHẢI TRANG CHỦ (index.php) THÌ MỚI HIỂN THỊ THANH NÀY
                    if ($current_page !== 'index.php'): 
                    ?>
                    <a href="../task2/index.php" class="text-decoration-none d-none d-md-block">
                        <div class="mini-search-bar d-flex align-items-center py-2 px-2">
                            <span class="mini-search-text">Địa điểm bất kỳ</span>
                            <span class="mini-search-text">Tuần bất kỳ</span>
                            <span class="mini-search-text light">Thêm khách</span>
                            <div class="mini-search-icon"><i class="fa-solid fa-magnifying-glass" style="font-size: 13px;"></i></div>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>

                <div class="col-4 col-lg-4 px-0 d-flex justify-content-end align-items-center gap-2">
                    <a href="../task6/wizard.php" class="nav-link-custom d-none d-lg-block">Cho thuê chỗ ở</a>
                    <a href="../task8/chat_box.php" class="nav-link-custom d-none d-lg-block" title="Tin nhắn"><i class="fa-solid fa-globe fs-5"></i></a>
                    
                    <div class="dropdown">
                        <button class="btn user-dropdown-btn d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bars text-dark ms-1"></i>
                            <i class="fa-solid fa-circle-user fs-4 text-secondary"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2 py-2" style="width: 240px;">
                            <li><a class="dropdown-item fw-bold py-2" href="../task1/login.php">Đăng nhập</a></li>
                            <li><a class="dropdown-item py-2" href="../task1/register.php">Đăng ký</a></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li><a class="dropdown-item py-2" href="../task6/wizard.php">Cho thuê chỗ ở</a></li>
                            <li><a class="dropdown-item py-2" href="../task7/dashboard.php">Quản lý Kênh Host</a></li>
                            <li><a class="dropdown-item py-2" href="../task5/my_trips.php">Chuyến đi của tôi</a></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li><a class="dropdown-item py-2" href="../task8/chat_box.php">Tin nhắn</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    