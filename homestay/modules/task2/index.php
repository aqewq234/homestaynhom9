<?php 
require_once '../../core_shared/database.php';
include '../../core_shared/header.php'; 

$diadiem  = isset($_GET['diadiem'])  ? trim($_GET['diadiem'])  : '';
$danhmuc  = isset($_GET['danhmuc'])  ? trim($_GET['danhmuc'])  : '';
$sokhach  = isset($_GET['sokhach'])  ? max(1,(int)$_GET['sokhach']) : 1;
$ngaynhan = isset($_GET['ngaynhan']) ? trim($_GET['ngaynhan']) : '';
$ngaytra  = isset($_GET['ngaytra'])  ? trim($_GET['ngaytra'])  : '';
$gia_max  = isset($_GET['gia_max'])  ? (int)$_GET['gia_max']  : 5000000;
$tiennghi = isset($_GET['tiennghi']) && is_array($_GET['tiennghi']) ? $_GET['tiennghi'] : [];

$sql = "SELECT p.*, a.duong_dan_anh 
        FROM phong p 
        LEFT JOIN hinh_anh_phong a ON p.id_phong = a.id_phong AND a.la_anh_bia = 1 
        WHERE p.trang_thai = 'hoat_dong' 
          AND p.so_khach_toi_da >= :sokhach
          AND p.gia_moi_dem <= :gia_max";
$params = ['sokhach'=>$sokhach, 'gia_max'=>$gia_max];

if (!empty($diadiem)) {
    $sql .= " AND (p.thanh_pho LIKE :diadiem OR p.dia_chi LIKE :diadiem2)";
    $params['diadiem']  = '%'.$diadiem.'%';
    $params['diadiem2'] = '%'.$diadiem.'%';
}
if (!empty($danhmuc)) {
    $sql .= " AND p.loai_phong = :danhmuc";
    $params['danhmuc'] = $danhmuc;
}
if (!empty($tiennghi)) {
    foreach ($tiennghi as $i => $tn) {
        $k = 'tn'.$i;
        $sql .= " AND p.tien_nghi LIKE :{$k}";
        $params[$k] = '%'.trim($tn).'%';
    }
}
$sql .= " ORDER BY p.ngay_tao DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rooms = $stmt->fetchAll();

$has_search     = !empty($diadiem) || !empty($danhmuc) || $sokhach > 1;
$active_filters = count($tiennghi) + ($gia_max < 5000000 ? 1 : 0);
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,700;0,800;1,700;1,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.pg-home {
    --brand:#FF385C; --brand2:#E8194B; --ink:#1A1A2E;
    --muted:#888; --border:rgba(0,0,0,0.09); --bg:#F7F7F9;
    --sha:0 2px 16px rgba(0,0,0,0.07); --shb:0 12px 40px rgba(0,0,0,0.13);
    font-family:'Plus Jakarta Sans',-apple-system,sans-serif; color:var(--ink);
}
.pg-home *,.pg-home *::before,.pg-home *::after{box-sizing:border-box;font-family:inherit;}

/* HERO */
.pg-home .hero{position:relative;height:calc(100vh - var(--nh,70px));min-height:560px;max-height:820px;background:#0a0a18;}
.pg-home .hero-slides{position:absolute;inset:0;overflow:hidden;}
.pg-home .hs{position:absolute;inset:0;background-size:cover;background-position:center;opacity:0;transition:opacity 1.5s ease-in-out;}
.pg-home .hs.on{opacity:1;animation:kb 9s ease-in-out forwards;}
@keyframes kb{from{transform:scale(1)}to{transform:scale(1.07)}}
.pg-home .hs-1{background-image:url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1800&q=80');}
.pg-home .hs-2{background-image:url('https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1800&q=80');}
.pg-home .hs-3{background-image:url('https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=1800&q=80');}
.pg-home .hs-4{background-image:url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1800&q=80');}
.pg-home .hs-5{background-image:url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1800&q=80');}
.pg-home .hero-fog{position:absolute;inset:0;z-index:1;pointer-events:none;background:linear-gradient(to bottom,rgba(10,10,24,.25) 0%,rgba(10,10,24,.55) 45%,rgba(10,10,24,.82) 100%);}
.pg-home .hero-txt{position:absolute;z-index:2;top:0;left:0;right:0;bottom:160px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:0 20px;}
.pg-home .hero-kicker{display:inline-flex;align-items:center;gap:8px;color:var(--brand);font-size:12px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;margin-bottom:16px;}
.pg-home .hero-kicker::before,.pg-home .hero-kicker::after{content:'';display:block;width:22px;height:1px;background:var(--brand);opacity:.7;}
.pg-home .hero-h1{font-family:'Cormorant Garamond',serif;font-size:clamp(38px,5.8vw,72px);font-weight:800;color:#fff;line-height:1.08;margin-bottom:16px;text-shadow:0 4px 32px rgba(0,0,0,.5);}
.pg-home .hero-h1 em{font-style:italic;color:var(--brand);}
.pg-home .hero-sub{color:rgba(255,255,255,.80);font-size:16px;}
.pg-home .hero-dots{position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:8px;z-index:3;}
.pg-home .hd{width:8px;height:8px;background:rgba(255,255,255,.35);border-radius:50%;border:none;cursor:pointer;padding:0;transition:background .3s,transform .3s;}
.pg-home .hd.on{background:#fff;transform:scale(1.5);}

/* SEARCH PILL */
.pg-home .sb-wrap{position:absolute;bottom:48px;left:0;right:0;margin:0 auto;width:94%;max-width:1060px;z-index:5;}
.pg-home .sb-pill{display:flex;align-items:stretch;background:#fff;border-radius:18px;box-shadow:0 8px 40px rgba(0,0,0,.28),0 2px 8px rgba(0,0,0,.12);width:100%;}
.pg-home .sb-field{flex:1;display:flex;align-items:center;gap:12px;padding:16px 20px;border-right:1px solid var(--border);min-width:0;transition:background .15s;}
.pg-home .sb-field:first-child{border-radius:18px 0 0 18px;}
.pg-home .sb-field:last-of-type{border-right:none;flex:0 0 auto;min-width:175px;}
.pg-home .sb-field:hover{background:#FAFAFA;}
.pg-home .sb-icon{color:var(--brand);font-size:16px;flex-shrink:0;width:18px;text-align:center;}
.pg-home .sb-fg{display:flex;flex-direction:column;min-width:0;flex:1;}
.pg-home .sb-lbl{font-size:10px;font-weight:800;letter-spacing:.09em;text-transform:uppercase;color:var(--ink);margin-bottom:3px;}
.pg-home .sb-inp{border:none!important;outline:none!important;box-shadow:none!important;background:transparent!important;border-radius:0!important;font-size:14px;font-weight:500;color:var(--ink);width:100%;padding:0!important;font-family:'Plus Jakarta Sans',sans-serif;}
.pg-home .sb-inp::placeholder{color:#BBBBC8;font-weight:400;}
.pg-home .sb-inp[type=date]{color:#BBBBC8;font-size:13px;}
.pg-home .sb-inp[type=date]:valid{color:var(--ink);}
.pg-home .gc{display:flex;align-items:center;gap:10px;}
.pg-home .gv{font-size:15px;font-weight:700;min-width:20px;text-align:center;}
.pg-home .gb{width:28px;height:28px;border:1.5px solid rgba(0,0,0,.18);border-radius:50%;background:transparent;color:var(--ink);font-size:16px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:border-color .2s;padding:0;}
.pg-home .gb:hover{border-color:var(--brand);color:var(--brand);}
.pg-home .gb:disabled{opacity:.3;cursor:default;}
.pg-home .sb-btn{flex-shrink:0;background:var(--brand);border:none;border-radius:0 18px 18px 0;color:#fff;font-size:15px;font-weight:700;padding:0 30px;display:flex;align-items:center;gap:9px;cursor:pointer;transition:background .2s;font-family:'Plus Jakarta Sans',sans-serif;white-space:nowrap;}
.pg-home .sb-btn:hover{background:var(--brand2);}

/* RESULT BAR */
.pg-home .result-bar{background:#fff;border-bottom:1px solid rgba(0,0,0,.07);padding:16px 32px;display:flex;align-items:center;justify-content:space-between;gap:16px;box-shadow:0 2px 12px rgba(0,0,0,0.06);}
.pg-home .result-left{display:flex;flex-direction:column;gap:6px;}
.pg-home .result-chips{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.pg-home .result-chip{display:inline-flex;align-items:center;gap:7px;padding:7px 14px;border-radius:40px;border:1.5px solid rgba(0,0,0,.12);background:#fff;font-size:13px;font-weight:600;color:var(--ink);text-decoration:none;cursor:pointer;transition:border-color .2s;}
.pg-home .result-chip:hover{border-color:var(--ink);color:var(--ink);}
.pg-home .result-chip i{font-size:12px;color:var(--brand);}
.pg-home .chip-x{font-size:16px;color:var(--muted);margin-left:2px;}
.pg-home .result-summary{font-size:14px;color:#555;margin:0;}
.pg-home .result-summary strong{color:var(--ink);font-weight:700;}
.pg-home .filter-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 22px;border-radius:40px;border:1.5px solid rgba(0,0,0,.12);background:#fff;font-size:14px;font-weight:700;color:var(--ink);cursor:pointer;transition:all .2s;font-family:inherit;position:relative;white-space:nowrap;}
.pg-home .filter-btn:hover{border-color:var(--ink);}
.pg-home .filter-btn.active{border-color:var(--brand);color:var(--brand);}
.pg-home .filter-badge{position:absolute;top:-7px;right:-7px;width:18px;height:18px;border-radius:50%;background:var(--brand);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center;}

/* IMAGE CATEGORIES */

.pg-home .ic-card{position:relative;border-radius:16px;overflow:hidden;aspect-ratio:3/4;display:block;text-decoration:none;background:#ddd;transition:transform .3s,box-shadow .3s;}
.pg-home .ic-card:hover{transform:translateY(-7px);box-shadow:var(--shb);}
.pg-home .ic-card img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s;}
.pg-home .ic-card:hover img{transform:scale(1.09);}
.pg-home .ic-fog{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,8,20,.72) 0%,transparent 60%);}
.pg-home .ic-lbl{position:absolute;bottom:18px;left:18px;display:flex;align-items:center;gap:9px;color:#fff;}
.pg-home .ic-ico{width:32px;height:32px;background:rgba(255,255,255,.18);backdrop-filter:blur(8px);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;}
.pg-home .ic-nm{font-size:17px;font-weight:700;text-shadow:0 1px 8px rgba(0,0,0,.55);}

/* FILTER PILLS */
.pg-home .fp-bar{background:#fff;border-bottom:1px solid rgba(0,0,0,.07);}
.pg-home .fp-sc{max-width:1440px;margin:0 auto;padding:14px 40px;display:flex;gap:10px;overflow-x:auto;scrollbar-width:none;}
.pg-home .fp-sc::-webkit-scrollbar{display:none;}
.pg-home .fpp{display:inline-flex;align-items:center;gap:8px;padding:9px 22px;border-radius:40px;border:1.5px solid rgba(0,0,0,.10);background:#fff;color:#555;text-decoration:none;font-size:14px;font-weight:600;white-space:nowrap;transition:all .2s;flex-shrink:0;}
.pg-home .fpp:hover{border-color:var(--ink);color:var(--ink);}
.pg-home .fpp.on{background:var(--ink);border-color:var(--ink);color:#fff;}

/* LISTINGS */
.pg-home .ls-sec{background:var(--bg);padding:40px 0 80px;min-height:40vh;}
.pg-home .ls-in{max-width:1440px;margin:0 auto;padding:0 40px;}
.pg-home .ls-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(270px,1fr));gap:26px;}
.pg-home .rc{background:#fff;border-radius:16px;overflow:hidden;box-shadow:var(--sha);transition:transform .25s,box-shadow .25s;text-decoration:none;display:block;color:inherit;}
.pg-home .rc:hover{transform:translateY(-6px);box-shadow:var(--shb);color:inherit;}
.pg-home .rc-img{position:relative;padding-top:65%;overflow:hidden;background:#f0f0f0;}
.pg-home .rc-img img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .4s;}
.pg-home .rc:hover .rc-img img{transform:scale(1.06);}
.pg-home .rc-bdg{position:absolute;top:12px;left:12px;background:rgba(255,255,255,.93);backdrop-filter:blur(4px);border-radius:20px;padding:4px 12px;font-size:11.5px;font-weight:700;color:var(--ink);z-index:2;}
.pg-home .rc-lov{position:absolute;top:10px;right:10px;background:rgba(255,255,255,.88);border:none;border-radius:50%;width:34px;height:34px;display:flex;align-items:center;justify-content:center;cursor:pointer;z-index:3;font-size:15px;color:#888;transition:color .2s,transform .2s;}
.pg-home .rc-lov:hover{transform:scale(1.2);color:var(--brand);}
.pg-home .rc-lov.ok{color:var(--brand);}
.pg-home .rc-body{padding:14px 16px 18px;}
.pg-home .rc-loc{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:4px;}
.pg-home .rc-nm{font-size:15px;font-weight:700;color:var(--ink);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:3px;}
.pg-home .rc-met{font-size:13px;color:var(--muted);margin-bottom:11px;}
.pg-home .rc-ft{display:flex;align-items:center;justify-content:space-between;}
.pg-home .rc-pri{font-size:15px;font-weight:700;color:var(--ink);}
.pg-home .rc-pri em{font-style:normal;font-size:13px;font-weight:400;color:var(--muted);}
.pg-home .rc-str{display:flex;align-items:center;gap:4px;font-size:13px;font-weight:600;}
.pg-home .rc-str i{color:#FFB700;font-size:12px;}
.pg-home .ls-mt{display:flex;flex-direction:column;align-items:center;text-align:center;padding:72px 24px;background:#fff;border-radius:16px;box-shadow:var(--sha);max-width:520px;margin:0 auto;}
.pg-home .ls-mt .ei{font-size:42px;margin-bottom:18px;}
.pg-home .ls-mt h3{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:800;color:var(--ink);margin-bottom:8px;}
.pg-home .ls-mt p{font-size:15px;color:var(--muted);margin-bottom:24px;}
.pg-home .ls-mt a{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;background:var(--ink);color:#fff;border-radius:40px;font-size:14px;font-weight:700;text-decoration:none;}
.pg-home .ls-mt a:hover{background:var(--brand);color:#fff;}

/* ============================================
   FILTER DRAWER
   Dùng ID selector (không phụ thuộc .pg-home)
   vì position:fixed thoát ra khỏi DOM flow
============================================ */
#pgFilterOverlay{
    display:none; position:fixed; inset:0; z-index:9998;
    background:rgba(0,0,0,0.5);
}
#pgFilterOverlay.open{ display:block; }

#pgFilterDrawer{
    position:fixed; top:0; right:0;
    width:400px; max-width:92vw; height:100vh;
    z-index:9999; background:#fff;
    box-shadow:-4px 0 32px rgba(0,0,0,.18);
    display:flex; flex-direction:column;
    /* Dùng transform thay vì right âm — đáng tin cậy hơn */
    transform:translateX(110%);
    transition:transform .35s cubic-bezier(0.77,0,0.18,1);
    font-family:'Plus Jakarta Sans',-apple-system,sans-serif;
}
#pgFilterDrawer.open{ transform:translateX(0); }

#pgFilterDrawer .dw-head{padding:20px 24px;border-bottom:1px solid #eee;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;}
#pgFilterDrawer .dw-head h3{font-size:17px;font-weight:800;color:#1A1A2E;margin:0;}
#pgFilterDrawer .dw-close{width:32px;height:32px;border-radius:50%;border:none;background:#f0f0f0;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:15px;color:#555;}
#pgFilterDrawer .dw-close:hover{background:#e0e0e0;}
#pgFilterDrawer .dw-body{flex:1;overflow-y:auto;padding:24px;}
#pgFilterDrawer .dw-stitle{font-size:11px;font-weight:800;letter-spacing:.10em;text-transform:uppercase;color:#FF385C;margin-bottom:14px;}
#pgFilterDrawer .dw-price-labels{display:flex;justify-content:space-between;font-size:12px;color:#888;margin-bottom:6px;}
#pgFilterDrawer .dw-price-val{text-align:center;font-size:16px;font-weight:800;color:#FF385C;margin-bottom:16px;}
#pgFilterDrawer .dw-slider{-webkit-appearance:none;appearance:none;width:100%;height:4px;border-radius:2px;outline:none;cursor:pointer;border:none!important;box-shadow:none!important;background:linear-gradient(to right,#FF385C 0%,#FF385C var(--pct,100%),#E0E0E0 var(--pct,100%),#E0E0E0 100%);margin-bottom:8px;}
#pgFilterDrawer .dw-slider::-webkit-slider-thumb{-webkit-appearance:none;width:22px;height:22px;border-radius:50%;background:#fff;border:2.5px solid #FF385C;box-shadow:0 2px 10px rgba(255,56,92,.3);cursor:pointer;}
#pgFilterDrawer .dw-slider::-moz-range-thumb{width:22px;height:22px;border-radius:50%;background:#fff;border:2.5px solid #FF385C;cursor:pointer;}
#pgFilterDrawer .dw-div{height:1px;background:#eee;margin:22px 0;}
#pgFilterDrawer .dw-tn-list{display:flex;flex-direction:column;}
#pgFilterDrawer .dw-tn-row{display:flex;align-items:center;padding:11px 0;border-bottom:1px solid #f0f0f0;cursor:pointer;}
#pgFilterDrawer .dw-tn-row:last-child{border-bottom:none;}
#pgFilterDrawer .dw-cb{display:none;}
#pgFilterDrawer .dw-box{width:22px;height:22px;flex-shrink:0;border-radius:6px;border:1.5px solid rgba(0,0,0,.2);background:#fff;display:flex;align-items:center;justify-content:center;margin-right:12px;transition:all .2s;}
#pgFilterDrawer .dw-cb:checked ~ .dw-box{background:#FF385C;border-color:#FF385C;}
#pgFilterDrawer .dw-cb:checked ~ .dw-box::after{content:'';display:block;width:5px;height:9px;border:2px solid #fff;border-top:none;border-left:none;transform:rotate(45deg);margin-top:-2px;}
#pgFilterDrawer .dw-lbl{display:flex;align-items:center;gap:10px;font-size:14px;font-weight:500;color:#1A1A2E;flex:1;}
#pgFilterDrawer .dw-ico{font-size:18px;}
#pgFilterDrawer .dw-foot{padding:16px 24px;border-top:1px solid #eee;display:flex;gap:12px;flex-shrink:0;background:#fff;}
#pgFilterDrawer .dw-reset{flex:1;padding:13px;border-radius:12px;border:1.5px solid rgba(0,0,0,.12);background:#fff;font-size:14px;font-weight:700;color:#1A1A2E;cursor:pointer;font-family:inherit;}
#pgFilterDrawer .dw-reset:hover{border-color:#1A1A2E;}
#pgFilterDrawer .dw-apply{flex:1.6;padding:13px;border-radius:12px;border:none;background:#FF385C;color:#fff;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;}
#pgFilterDrawer .dw-apply:hover{background:#E8194B;}

@media(max-width:768px){
    .pg-home .hero{height:calc(100vh - 60px);min-height:520px;}
    .pg-home .sb-wrap{bottom:44px;width:96%;}
    .pg-home .sb-pill{flex-direction:column;border-radius:14px;}
    .pg-home .sb-field{border-right:none;border-bottom:1px solid var(--border);}
    .pg-home .sb-field:first-child{border-radius:14px 14px 0 0;}
    .pg-home .sb-field:last-of-type{border-bottom:none;min-width:unset;}
    .pg-home .sb-btn{border-radius:0 0 14px 14px;padding:16px;justify-content:center;}
    .pg-home .hero-txt{bottom:240px;}
    .pg-home .ic-grid{grid-template-columns:repeat(3,1fr);}
    .pg-home .ls-grid{grid-template-columns:1fr 1fr;gap:14px;}
    #pgFilterDrawer{width:100%;max-width:100%;border-radius:20px 20px 0 0;top:auto;height:85vh;transform:translateY(110%);}
    #pgFilterDrawer.open{transform:translateY(0);}
}
</style>

<div class="pg-home">

<?php if (!$has_search): ?>
<!-- ══ HERO ══ -->
<section class="hero">
    <div class="hero-slides">
        <div class="hs hs-1 on"></div>
        <div class="hs hs-2"></div>
        <div class="hs hs-3"></div>
        <div class="hs hs-4"></div>
        <div class="hs hs-5"></div>
    </div>
    <div class="hero-fog"></div>
    <div class="hero-txt">
        <span class="hero-kicker">Khám phá Việt Nam</span>
        <h1 class="hero-h1">Tìm nơi nghỉ ngơi<br><em>hoàn hảo</em> cho bạn</h1>
        <p class="hero-sub">Hơn 500 homestay được tuyển chọn trên khắp Việt Nam</p>
    </div>
    <div class="sb-wrap">
        <form class="sb-pill" action="index.php" method="GET">
            <div class="sb-field">
                <i class="fa-solid fa-location-dot sb-icon"></i>
                <div class="sb-fg">
                    <label class="sb-lbl" for="sb1">Địa điểm</label>
                    <input id="sb1" class="sb-inp" type="text" name="diadiem" placeholder="Bạn muốn đến đâu?" value="<?= htmlspecialchars($diadiem) ?>">
                </div>
            </div>
            <div class="sb-field">
                <i class="fa-regular fa-calendar sb-icon"></i>
                <div class="sb-fg">
                    <label class="sb-lbl" for="sb2">Ngày đặt</label>
                    <input id="sb2" class="sb-inp" type="date" name="ngaynhan" value="<?= htmlspecialchars($ngaynhan) ?>">
                </div>
            </div>
            <div class="sb-field">
                <i class="fa-regular fa-calendar sb-icon"></i>
                <div class="sb-fg">
                    <label class="sb-lbl" for="sb3">Ngày trả</label>
                    <input id="sb3" class="sb-inp" type="date" name="ngaytra" value="<?= htmlspecialchars($ngaytra) ?>">
                </div>
            </div>
            <div class="sb-field">
                <i class="fa-solid fa-user-group sb-icon"></i>
                <div class="sb-fg">
                    <span class="sb-lbl">Số lượng người</span>
                    <div class="gc">
                        <button type="button" class="gb" id="sbM" onclick="pgG(-1)">−</button>
                        <span class="gv" id="sbD"><?= $sokhach ?></span>
                        <button type="button" class="gb" onclick="pgG(1)">+</button>
                    </div>
                </div>
                <input type="hidden" name="sokhach" id="sbV" value="<?= $sokhach ?>">
            </div>
            <button type="submit" class="sb-btn"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
        </form>
    </div>
    <div class="hero-dots">
        <button class="hd on" data-i="0"></button>
        <button class="hd" data-i="1"></button>
        <button class="hd" data-i="2"></button>
        <button class="hd" data-i="3"></button>
        <button class="hd" data-i="4"></button>
    </div>
</section>

<!-- Danh mục ảnh -->

<br><br>
<!-- Filter pills -->
<nav class="fp-bar">
    <div class="fp-sc">
        <a href="index.php" class="fpp <?= empty($danhmuc)?'on':'' ?>">✨ Tất cả</a>
        <?php foreach (['Thịnh hành'=>'🔥','Biệt thự'=>'🏡','Cabin'=>'🏕️','Gần biển'=>'🌊','Trung tâm'=>'🏙️','Hồ bơi'=>'🏊'] as $nm=>$ic): ?>
        <a href="index.php?danhmuc=<?= urlencode($nm) ?>" class="fpp <?= ($danhmuc===$nm)?'on':'' ?>"><?= $ic.' '.$nm ?></a>
        <?php endforeach; ?>
    </div>
</nav>

<?php else: ?>
<!-- ══ RESULT BAR (thay banner khi có tìm kiếm) ══ -->
<div class="result-bar">
    <div class="result-left">
        <div class="result-chips">
            <?php if ($diadiem): ?>
            <a href="index.php?sokhach=<?= $sokhach ?>" class="result-chip">
                <i class="fa-solid fa-location-dot"></i><?= htmlspecialchars($diadiem) ?><span class="chip-x">×</span>
            </a>
            <?php endif; ?>
            <?php if ($sokhach > 1): ?>
            <a href="index.php?diadiem=<?= urlencode($diadiem) ?>" class="result-chip">
                <i class="fa-solid fa-user-group"></i><?= $sokhach ?> Khách<span class="chip-x">×</span>
            </a>
            <?php endif; ?>
        </div>
        <p class="result-summary">
            Tìm thấy <strong><?= count($rooms) ?></strong> phòng
            <?php if ($diadiem): ?> tại "<strong><?= htmlspecialchars($diadiem) ?></strong>"<?php endif; ?>
        </p>
    </div>
    <button type="button" class="filter-btn <?= $active_filters>0?'active':'' ?>" onclick="pgOpenFilter()">
        <i class="fa-solid fa-sliders"></i> Bộ Lọc
        <?php if ($active_filters > 0): ?><span class="filter-badge"><?= $active_filters ?></span><?php endif; ?>
    </button>
</div>
<?php endif; ?>

<!-- ══ LISTINGS ══ -->
<section class="ls-sec">
    <div class="ls-in">
        <?php if ($rooms): ?>
        <div class="ls-grid">
            <?php foreach ($rooms as $p):
                $img = !empty($p['duong_dan_anh']) ? htmlspecialchars($p['duong_dan_anh']) : 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=600&q=70';
            ?>
            <a href="../task3/detail.php?id_phong=<?= (int)$p['id_phong'] ?>" class="rc">
                <div class="rc-img">
                    <img src="<?= $img ?>" alt="<?= htmlspecialchars($p['ten_phong']) ?>" loading="lazy">
                    <?php if (!empty($p['loai_phong'])): ?>
                    <span class="rc-bdg"><?= htmlspecialchars($p['loai_phong']) ?></span>
                    <?php endif; ?>
                    <button class="rc-lov" type="button" onclick="pgW(event,this)"><i class="fa-regular fa-heart"></i></button>
                </div>
                <div class="rc-body">
                    <p class="rc-loc"><?= htmlspecialchars($p['thanh_pho']) ?>, Việt Nam</p>
                    <p class="rc-nm"><?= htmlspecialchars($p['ten_phong']) ?></p>
                    <p class="rc-met">Tối đa <?= (int)$p['so_khach_toi_da'] ?> khách</p>
                    <div class="rc-ft">
                        <span class="rc-pri"><?= number_format($p['gia_moi_dem'],0,',','.') ?> ₫ <em>/ đêm</em></span>
                        <span class="rc-str"><i class="fa-solid fa-star"></i> 4.96</span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="ls-mt">
            <div class="ei">🔍</div>
            <h3>Không tìm thấy kết quả nào</h3>
            <p>Thử thay đổi địa điểm hoặc bỏ bớt bộ lọc.</p>
            <a href="index.php"><i class="fa-solid fa-rotate-left"></i> Xóa bộ lọc</a>
        </div>
        <?php endif; ?>
    </div>
</section>

</div><!-- /.pg-home -->

<!-- ══ FILTER DRAWER — đặt ngoài .pg-home, dùng ID ══ -->
<div id="pgFilterOverlay" onclick="pgCloseFilter()"></div>
<div id="pgFilterDrawer">
    <div class="dw-head">
        <h3>Bộ lọc</h3>
        <button type="button" class="dw-close" onclick="pgCloseFilter()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form class="dw-body" id="filterForm" action="index.php" method="GET">
        <input type="hidden" name="diadiem"  value="<?= htmlspecialchars($diadiem) ?>">
        <input type="hidden" name="ngaynhan" value="<?= htmlspecialchars($ngaynhan) ?>">
        <input type="hidden" name="ngaytra"  value="<?= htmlspecialchars($ngaytra) ?>">
        <input type="hidden" name="sokhach"  value="<?= $sokhach ?>">
        <?php if ($danhmuc): ?><input type="hidden" name="danhmuc" value="<?= htmlspecialchars($danhmuc) ?>"><?php endif; ?>

        <p class="dw-stitle">Lọc theo giá (VNĐ/đêm)</p>
        <div class="dw-price-labels"><span>0đ</span><span>5tr+</span></div>
        <div class="dw-price-val" id="dwPriceVal"><?= $gia_max>=5000000?'5.000.000đ+':number_format($gia_max,0,',','.').'đ' ?></div>
        <input type="range" class="dw-slider" id="dwSlider" name="gia_max" min="0" max="5000000" step="100000" value="<?= $gia_max ?>">

        <div class="dw-div"></div>
        <p class="dw-stitle">Lọc theo tiện nghi</p>
        <div class="dw-tn-list">
            <?php foreach ([
                ['🌿','Ban công / Sân vườn'],['🏊','Bể bơi'],
                ['🍳','Bếp riêng'],['🍽️','Bữa sáng bao gồm'],
                ['🔥','Lò sưởi'],['👕','Máy giặt'],
                ['📺','TV màn hình phẳng'],['🌐','WiFi tốc độ cao'],
                ['🅿️','Bãi đỗ xe'],['❄️','Điều hòa'],['🛁','Bồn tắm'],
            ] as [$ico,$txt]): ?>
            <label class="dw-tn-row">
                <input class="dw-cb" type="checkbox" name="tiennghi[]" value="<?= htmlspecialchars($txt) ?>" <?= in_array($txt,$tiennghi)?'checked':'' ?>>
                <span class="dw-box"></span>
                <span class="dw-lbl"><span class="dw-ico"><?= $ico ?></span><?= $txt ?></span>
            </label>
            <?php endforeach; ?>
        </div>
    </form>
    <div class="dw-foot">
        <button type="button" class="dw-reset" onclick="pgResetFilter()">Đặt lại</button>
        <button type="button" class="dw-apply" onclick="document.getElementById('filterForm').submit()">Áp dụng</button>
    </div>
</div>

<script>
(function(){
    /* Navbar height */
    function setNH(){
        var nb=document.querySelector('.navbar')||document.querySelector('nav')||document.querySelector('header');
        document.documentElement.style.setProperty('--nh',(nb?nb.getBoundingClientRect().height:70)+'px');
    }
    setNH(); window.addEventListener('load',setNH); window.addEventListener('resize',setNH);

    /* Slideshow */
    var slides=document.querySelectorAll('.pg-home .hs'), dots=document.querySelectorAll('.pg-home .hd');
    if(slides.length){
        var cur=0,tid;
        function goTo(i){
            slides[cur].classList.remove('on'); dots[cur].classList.remove('on');
            cur=((i%slides.length)+slides.length)%slides.length;
            slides[cur].classList.add('on'); dots[cur].classList.add('on');
        }
        dots.forEach(function(d){d.addEventListener('click',function(){clearInterval(tid);goTo(+d.dataset.i);tid=setInterval(function(){goTo(cur+1);},5000);});});
        tid=setInterval(function(){goTo(cur+1);},5000);
    }

    /* Guest counter */
    var gc=<?= (int)$sokhach ?>;
    var sbD=document.getElementById('sbD'),sbV=document.getElementById('sbV'),sbM=document.getElementById('sbM');
    window.pgG=function(d){gc=Math.max(1,gc+d);if(sbD)sbD.textContent=gc;if(sbV)sbV.value=gc;if(sbM)sbM.disabled=gc<=1;};
    if(sbM)sbM.disabled=gc<=1;

    /* ── FILTER DRAWER ── */
    var overlay=document.getElementById('pgFilterOverlay');
    var drawer=document.getElementById('pgFilterDrawer');

    window.pgOpenFilter=function(){
        console.log('open filter', overlay, drawer);
        overlay.classList.add('open');
        drawer.classList.add('open');
        document.body.style.overflow='hidden';
    };
    window.pgCloseFilter=function(){
        overlay.classList.remove('open');
        drawer.classList.remove('open');
        document.body.style.overflow='';
    };

    /* Price slider */
    var slider=document.getElementById('dwSlider'), pVal=document.getElementById('dwPriceVal');
    function updS(){
        var v=parseInt(slider.value), pct=(v/5000000*100).toFixed(1)+'%';
        slider.style.setProperty('--pct',pct);
        pVal.textContent=v>=5000000?'5.000.000đ+':new Intl.NumberFormat('vi-VN').format(v)+'đ';
    }
    if(slider){slider.addEventListener('input',updS);updS();}

    /* Reset */
    window.pgResetFilter=function(){
        document.querySelectorAll('#pgFilterDrawer .dw-cb').forEach(function(c){c.checked=false;});
        if(slider){slider.value=5000000;updS();}
    };

    /* Wishlist */
    window.pgW=function(e,btn){
        e.preventDefault();e.stopPropagation();
        btn.classList.toggle('ok');
        btn.querySelector('i').className=btn.classList.contains('ok')?'fa-solid fa-heart':'fa-regular fa-heart';
    };
})();
</script>

<?php include '../../core_shared/footer.php'; ?>
