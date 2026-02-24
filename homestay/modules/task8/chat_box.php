<?php include '../../core_shared/header.php'; ?>

<style>
    /* Ghi đè container mặc định để Chat box rộng hơn và không bị cuộn toàn trang */
    .chat-container {
        max-width: 1200px;
        margin: 20px auto;
        height: calc(100vh - 120px); /* Trừ đi chiều cao của header */
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: var(--shadow);
        display: flex;
        overflow: hidden;
    }

    /* === CỘT TRÁI: SIDEBAR (Danh sách) === */
    .chat-sidebar {
        width: 350px;
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        background: #fff;
    }

    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid var(--border);
    }

    .sidebar-header h2 { margin: 0 0 15px 0; font-size: 22px; }

    /* Nút chuyển đổi Tin nhắn / Thông báo */
    .tab-switch {
        display: flex;
        background: var(--bg-light);
        border-radius: 8px;
        padding: 4px;
    }
    .tab-btn {
        flex: 1;
        text-align: center;
        padding: 8px 0;
        border: none;
        background: transparent;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        color: var(--text-gray);
        transition: all 0.2s;
    }
    .tab-btn.active { background: white; color: var(--text-dark); box-shadow: 0 1px 3px rgba(0,0,0,0.1); }

    /* Danh sách hội thoại */
    .item-list {
        flex: 1;
        overflow-y: auto;
    }
    .list-item {
        display: flex;
        padding: 15px 20px;
        border-bottom: 1px solid var(--border);
        cursor: pointer;
        transition: background 0.2s;
    }
    .list-item:hover { background: var(--bg-light); }
    .list-item.active { background: #F0F4F8; border-left: 4px solid var(--primary); }
    .list-item.unread .item-name { font-weight: 800; }
    .list-item.unread .item-preview { color: var(--text-dark); font-weight: 600; }

    .item-avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; margin-right: 15px; }
    .item-info { flex: 1; overflow: hidden; }
    .item-top { display: flex; justify-content: space-between; margin-bottom: 4px; }
    .item-name { margin: 0; font-size: 15px; font-weight: 600; color: var(--text-dark); }
    .item-time { font-size: 12px; color: var(--text-gray); }
    .item-preview { margin: 0; font-size: 14px; color: var(--text-gray); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* === CỘT PHẢI: KHUNG CHAT (Nội dung chính) === */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #fdfdfd;
    }

    .chat-header-main {
        padding: 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
    }
    .chat-header-info { display: flex; align-items: center; }
    .chat-header-text h3 { margin: 0 0 4px 0; font-size: 16px; }
    .chat-header-text p { margin: 0; font-size: 13px; color: var(--text-gray); }

    /* Khu vực tin nhắn */
    .chat-history {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .message { display: flex; max-width: 70%; }
    .message.received { align-self: flex-start; }
    .message.sent { align-self: flex-end; flex-direction: row-reverse; }

    .msg-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin: 0 10px; align-self: flex-end;}
    .msg-bubble { padding: 12px 16px; border-radius: 18px; font-size: 15px; line-height: 1.4; position: relative;}
    
    .message.received .msg-bubble { background: #EBEBEB; color: var(--text-dark); border-bottom-left-radius: 4px; }
    .message.sent .msg-bubble { background: var(--primary); color: white; border-bottom-right-radius: 4px; }

    .msg-time { display: block; font-size: 11px; margin-top: 5px; color: var(--text-gray); text-align: right; }
    .message.sent .msg-time { color: rgba(255,255,255,0.8); }

    /* Khu vực nhập tin nhắn */
    .chat-input-area {
        padding: 20px;
        border-top: 1px solid var(--border);
        background: white;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .chat-input {
        flex: 1;
        padding: 14px 20px;
        border: 1px solid var(--border);
        border-radius: 30px;
        outline: none;
        font-size: 15px;
    }
    .chat-input:focus { border-color: var(--primary); }
    .btn-send {
        background: var(--primary);
        color: white;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
    }

    /* Icon giả lập (Vì chưa nhúng FontAwesome) */
    .icon-placeholder { font-style: normal; }
</style>

<div class="chat-container">
    
    <div class="chat-sidebar">
        <div class="sidebar-header">
            <h2>Hộp thư</h2>
            <div class="tab-switch">
                <button class="tab-btn active" id="btn-chat" onclick="switchTab('chat')">Tin nhắn</button>
                <button class="tab-btn" id="btn-noti" onclick="switchTab('noti')">Thông báo <span style="background: var(--primary); color: white; border-radius: 50%; padding: 2px 6px; font-size: 11px; margin-left: 5px;">2</span></button>
            </div>
        </div>

        <div class="item-list" id="list-chat">
            <div class="list-item unread active">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" class="item-avatar">
                <div class="item-info">
                    <div class="item-top">
                        <p class="item-name">Host Minh Huy</p>
                        <span class="item-time">10:45 AM</span>
                    </div>
                    <p class="item-preview">Căn hộ Sài Gòn đã sẵn sàng đón bạn!</p>
                </div>
            </div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150" class="item-avatar">
                <div class="item-info">
                    <div class="item-top">
                        <p class="item-name">Chị Lan (Đà Lạt)</p>
                        <span class="item-time">Hôm qua</span>
                    </div>
                    <p class="item-preview">Cảm ơn bạn đã giữ phòng sạch sẽ nhé.</p>
                </div>
            </div>
        </div>

        <div class="item-list" id="list-noti" style="display: none;">
            <div class="list-item unread">
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #E8F5E9; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 20px;">✅</div>
                <div class="item-info">
                    <div class="item-top">
                        <p class="item-name">Đặt phòng thành công</p>
                        <span class="item-time">Vừa xong</span>
                    </div>
                    <p class="item-preview">Thanh toán 2.750.000đ cho Căn hộ Studio đã được xác nhận.</p>
                </div>
            </div>
            <div class="list-item">
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #FFF3E0; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 20px;">⚠️</div>
                <div class="item-info">
                    <div class="item-top">
                        <p class="item-name">Nhắc nhở nhận phòng</p>
                        <span class="item-time">2 ngày trước</span>
                    </div>
                    <p class="item-preview">Bạn có lịch nhận phòng tại Đà Lạt vào ngày mai.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="chat-main" id="chat-window">
        <div class="chat-header-main">
            <div class="chat-header-info">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" class="item-avatar" style="width: 40px; height: 40px;">
                <div class="chat-header-text">
                    <h3>Host Minh Huy</h3>
                    <p>Phản hồi trong vòng 1 giờ</p>
                </div>
            </div>
            <div>
                <a href="../task3/detail.php?id=2" class="btn btn-outline" style="padding: 8px 15px; font-size: 13px;">Xem chi tiết phòng</a>
            </div>
        </div>

        <div class="chat-history">
            <div style="text-align: center; color: var(--text-gray); font-size: 12px; margin: 10px 0;">Hôm nay, 24 tháng 2, 2026</div>
            
            <div class="message sent">
                <img src="https://via.placeholder.com/150/FF385C/FFFFFF?text=Me" class="msg-avatar">
                <div class="msg-bubble">
                    Chào anh Huy, mai em bay chuyến 14h, khoảng 15h30 em tới check-in được không ạ?
                    <span class="msg-time">10:40 AM</span>
                </div>
            </div>

            <div class="message received">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" class="msg-avatar">
                <div class="msg-bubble">
                    Chào bạn, hoàn toàn được nhé. Căn hộ Sài Gòn đã sẵn sàng đón bạn!
                    <span class="msg-time">10:45 AM</span>
                </div>
            </div>
            
            <div class="message received">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" class="msg-avatar" style="visibility: hidden;"> <div class="msg-bubble">
                    Mật khẩu cửa cuốn là 123456, bạn cứ bấm mã rồi vào nha.
                    <span class="msg-time">10:46 AM</span>
                </div>
            </div>
        </div>

        <div class="chat-input-area">
            <button style="border: none; background: transparent; font-size: 20px; color: var(--text-gray); cursor: pointer;">📎</button>
            <input type="text" class="chat-input" placeholder="Nhập tin nhắn...">
            <button class="btn-send">➤</button>
        </div>
    </div>
    
    <div class="chat-main" id="noti-window" style="display: none; justify-content: center; align-items: center; background: var(--bg-light);">
        <div style="text-align: center; color: var(--text-gray);">
            <div style="font-size: 40px; margin-bottom: 15px;">🔔</div>
            <h3>Chọn một thông báo để xem chi tiết</h3>
            <p>Tất cả cập nhật về chuyến đi của bạn sẽ hiển thị ở đây.</p>
        </div>
    </div>

</div>

<script>
    function switchTab(tab) {
        // Cập nhật nút bấm
        document.getElementById('btn-chat').classList.remove('active');
        document.getElementById('btn-noti').classList.remove('active');
        document.getElementById('btn-' + tab).classList.add('active');

        // Cập nhật danh sách bên trái
        document.getElementById('list-chat').style.display = (tab === 'chat') ? 'block' : 'none';
        document.getElementById('list-noti').style.display = (tab === 'noti') ? 'block' : 'none';

        // Cập nhật màn hình bên phải
        document.getElementById('chat-window').style.display = (tab === 'chat') ? 'flex' : 'none';
        document.getElementById('noti-window').style.display = (tab === 'noti') ? 'flex' : 'none';
    }
</script>

<?php include '../../core_shared/footer.php'; ?>