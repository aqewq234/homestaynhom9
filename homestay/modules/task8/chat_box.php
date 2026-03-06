<?php include '../../core_shared/header.php'; ?>

<style>
    /* CSS Custom tối thiểu cho những thành phần đặc thù */
    .chat-layout { height: calc(100vh - 140px); min-height: 500px; }
    
    /* Tách màu: Sidebar nền xám nhạt, Main window nền trắng */
    .sidebar-bg { background-color: #F7F7F7; }
    .main-bg { background-color: #FFFFFF; }

    /* Nút Tab chuyển đổi */
    .tab-btn { flex: 1; padding: 8px 0; border: none; background: transparent; border-radius: 8px; font-weight: 600; color: #717171; transition: 0.2s; }
    .tab-btn.active { background: white; color: #222222; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }

    /* Danh sách hội thoại/thông báo */
    .list-group-item-action { cursor: pointer; border-left: 4px solid transparent; transition: 0.2s; }
    .list-group-item-action:hover { background-color: #EBEBEB; }
    .list-group-item-action.active { background-color: #FFFFFF; border-left-color: var(--airbnb); }
    .unread-indicator { width: 10px; height: 10px; border-radius: 50%; background-color: var(--airbnb); display: inline-block; }

    /* Bong bóng Chat */
    .chat-history { overflow-y: auto; scrollbar-width: thin; padding-right: 10px; }
    .msg-bubble { padding: 12px 16px; border-radius: 20px; font-size: 15px; max-width: 75%; position: relative; line-height: 1.4; }
    .msg-received { background-color: #EBEBEB; color: #222222; border-bottom-left-radius: 4px; }
    .msg-sent { background-color: var(--airbnb); color: white; border-bottom-right-radius: 4px; }

    /* Khu vực nhập liệu */
    .chat-input-wrapper { background-color: #F7F7F7; border-radius: 40px; padding: 5px 10px; display: flex; align-items: center; }
    .chat-input { border: none; background: transparent; box-shadow: none !important; }
    .btn-send { width: 40px; height: 40px; border-radius: 50%; background-color: var(--airbnb); color: white; border: none; display: flex; align-items: center; justify-content: center; transition: 0.2s; }
    .btn-send:hover { background-color: #E31C5F; transform: scale(1.05); }
</style>

<div class="container-fluid px-0 px-lg-4 mt-3 mb-4">
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden chat-layout d-flex flex-row">
        
        <div class="sidebar-bg border-end d-flex flex-column" style="width: 380px; flex-shrink: 0;">
            <div class="p-4 border-bottom bg-white">
                <h3 class="fw-bold mb-3">Hộp thư</h3>
                <div class="d-flex bg-light rounded-3 p-1">
                    <button class="tab-btn active" id="btn-chat" onclick="switchTab('chat')">Tin nhắn</button>
                    <button class="tab-btn" id="btn-noti" onclick="switchTab('noti')">Thông báo <span class="badge bg-danger ms-1">2</span></button>
                </div>
            </div>

            <div class="list-group list-group-flush overflow-auto flex-grow-1" id="list-chat">
                <div class="list-group-item list-group-item-action active p-3 d-flex align-items-center bg-white border-bottom">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" class="rounded-circle object-fit-cover me-3" style="width: 50px; height: 50px;" alt="Avatar">
                    <div class="flex-grow-1 min-width-0">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="fw-bold mb-0 text-dark">Host Minh Huy</h6>
                            <small class="text-muted">10:45</small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0 text-dark fw-semibold text-truncate small">Căn hộ Sài Gòn đã sẵn sàng...</p>
                            <span class="unread-indicator"></span>
                        </div>
                    </div>
                </div>

                <div class="list-group-item list-group-item-action p-3 d-flex align-items-center border-bottom bg-transparent">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150" class="rounded-circle object-fit-cover me-3" style="width: 50px; height: 50px;" alt="Avatar">
                    <div class="flex-grow-1 min-width-0">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="fw-semibold mb-0 text-dark">Chị Lan (Đà Lạt)</h6>
                            <small class="text-muted">Hôm qua</small>
                        </div>
                        <p class="mb-0 text-muted text-truncate small">Cảm ơn bạn đã giữ phòng sạch sẽ nhé.</p>
                    </div>
                </div>
            </div>

            <div class="list-group list-group-flush overflow-auto flex-grow-1 d-none" id="list-noti">
                <div class="list-group-item list-group-item-action p-3 d-flex align-items-start border-bottom bg-white">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex justify-content-center align-items-center me-3" style="width: 45px; height: 45px; flex-shrink: 0;">
                        <i class="fa-solid fa-check fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="fw-bold mb-0 text-dark">Đặt phòng thành công</h6>
                            <small class="text-muted">Vừa xong</small>
                        </div>
                        <p class="mb-0 text-dark fw-semibold small lh-sm">Thanh toán 2.750.000đ cho Căn hộ Studio đã được xác nhận.</p>
                    </div>
                </div>

                <div class="list-group-item list-group-item-action p-3 d-flex align-items-start border-bottom bg-transparent">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex justify-content-center align-items-center me-3" style="width: 45px; height: 45px; flex-shrink: 0;">
                        <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="fw-semibold mb-0 text-dark">Nhắc nhở nhận phòng</h6>
                            <small class="text-muted">2 ngày</small>
                        </div>
                        <p class="mb-0 text-muted small lh-sm">Bạn có lịch nhận phòng tại Đà Lạt vào ngày mai.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-bg flex-grow-1 d-flex flex-column" id="chat-window">
            
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" class="rounded-circle object-fit-cover me-3" style="width: 45px; height: 45px;" alt="Avatar">
                    <div>
                        <h5 class="fw-bold mb-0">Host Minh Huy</h5>
                        <small class="text-muted">Phản hồi trong vòng 1 giờ</small>
                    </div>
                </div>
                <a href="../task3/detail.php?id_phong=2" class="btn btn-outline-dark btn-sm fw-semibold rounded-pill px-3 py-2">Xem chi tiết phòng</a>
            </div>

            <div class="chat-history flex-grow-1 p-4 d-flex flex-column gap-3">
                <div class="text-center w-100 mb-3"><span class="badge bg-light text-muted fw-normal px-3 py-1 rounded-pill">Hôm nay, 24 tháng 2, 2026</span></div>
                
                <div class="d-flex justify-content-end align-items-end gap-2">
                    <div class="d-flex flex-column align-items-end">
                        <div class="msg-bubble msg-sent shadow-sm">
                            Chào anh Huy, mai em bay chuyến 14h, khoảng 15h30 em tới check-in được không ạ?
                        </div>
                        <small class="text-muted mt-1" style="font-size: 11px;">10:40 AM</small>
                    </div>
                </div>

                <div class="d-flex justify-content-start align-items-end gap-2">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" class="rounded-circle object-fit-cover mb-4" style="width: 30px; height: 30px;" alt="Avatar">
                    <div class="d-flex flex-column align-items-start">
                        <div class="msg-bubble msg-received shadow-sm mb-1">
                            Chào bạn, hoàn toàn được nhé. Căn hộ Sài Gòn đã sẵn sàng đón bạn!
                        </div>
                        <div class="msg-bubble msg-received shadow-sm">
                            Mật khẩu cửa cuốn là 123456, bạn cứ bấm mã rồi vào nha.
                        </div>
                        <small class="text-muted mt-1" style="font-size: 11px;">10:46 AM</small>
                    </div>
                </div>
            </div>

            <div class="p-3 border-top bg-white">
                <div class="chat-input-wrapper">
                    <button class="btn btn-link text-muted px-3 text-decoration-none fs-5"><i class="fa-solid fa-paperclip"></i></button>
                    <input type="text" class="form-control chat-input" placeholder="Viết tin nhắn...">
                    <button class="btn-send"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </div>

        <div class="sidebar-bg flex-grow-1 d-none flex-column justify-content-center align-items-center" id="noti-window">
            <div class="text-center text-muted p-5 bg-white rounded-4 shadow-sm border" style="max-width: 400px;">
                <div class="rounded-circle bg-light d-inline-flex justify-content-center align-items-center mb-4" style="width: 80px; height: 80px;">
                    <i class="fa-regular fa-bell fs-1"></i>
                </div>
                <h4 class="fw-bold text-dark">Chi tiết thông báo</h4>
                <p class="mb-0">Chọn một thông báo từ danh sách bên trái để xem chi tiết cập nhật về chuyến đi của bạn.</p>
            </div>
        </div>

    </div>
</div>

<script>
    function switchTab(tab) {
        // Cập nhật trạng thái nút
        document.getElementById('btn-chat').classList.remove('active');
        document.getElementById('btn-noti').classList.remove('active');
        document.getElementById('btn-' + tab).classList.add('active');

        // Cập nhật danh sách (Sidebar)
        const listChat = document.getElementById('list-chat');
        const listNoti = document.getElementById('list-noti');
        if (tab === 'chat') {
            listChat.classList.remove('d-none');
            listNoti.classList.add('d-none');
        } else {
            listChat.classList.add('d-none');
            listNoti.classList.remove('d-none');
        }

        // Cập nhật màn hình chính (Main Window)
        const chatWindow = document.getElementById('chat-window');
        const notiWindow = document.getElementById('noti-window');
        if (tab === 'chat') {
            chatWindow.classList.remove('d-none');
            chatWindow.classList.add('d-flex');
            notiWindow.classList.add('d-none');
            notiWindow.classList.remove('d-flex');
        } else {
            chatWindow.classList.add('d-none');
            chatWindow.classList.remove('d-flex');
            notiWindow.classList.remove('d-none');
            notiWindow.classList.add('d-flex');
        }
    }
</script>

<?php include '../../core_shared/footer.php'; ?>