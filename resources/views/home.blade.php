@extends('layouts.mmo')
@section('content')
<style>
.but {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.but button {
    background: linear-gradient(135deg, #1e293b, #0f172a);
    color: #e2e8f0;

    border: 1px solid #334155;

    padding: 10px 18px;

    border-radius: 12px;

    font-size: 14px;
    font-weight: 500;

    cursor: pointer;

    transition: all 0.25s ease;

    box-shadow:
        0 4px 12px rgba(0,0,0,0.35),
        inset 0 1px 0 rgba(255,255,255,0.05);
}

/* hover */
.but button:hover {
    transform: translateY(-2px);

    border-color: #3b82f6;

    color: white;

    background: linear-gradient(135deg, #2563eb, #1d4ed8);

    box-shadow:
        0 8px 20px rgba(37,99,235,0.35);
}

/* click */
.but button:active {
    transform: scale(0.97);
}

/* active category */
.but button.active {
    background: linear-gradient(135deg, #3b82f6, #2563eb);

    border-color: #60a5fa;

    color: white;

    box-shadow:
        0 0 20px rgba(59,130,246,0.45);
}
/* HERO BANNER */
.hero-banner{
    position: relative;

    height: 260px;

    border-radius: 24px;

    overflow: hidden;

    background-image:
        url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1600');

    background-size: cover;
    background-position: center;

    margin-bottom: 30px;

    transition: 0.4s;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.45);
}

/* overlay */
.hero-overlay{
    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            135deg,
            rgba(15,23,42,0.88),
            rgba(30,41,59,0.65),
            rgba(59,130,246,0.35)
        );
}

/* hover */
.hero-banner:hover{
    transform: translateY(-4px) scale(1.01);

    box-shadow:
        0 20px 40px rgba(59,130,246,0.25);
}

/* content */
.hero-content{
    position: relative;
    z-index: 2;

    height: 100%;

    display: flex;
    flex-direction: column;
    justify-content: center;

    padding: 40px;
}

.hero-tag{
    width: fit-content;

    background: rgba(59,130,246,0.2);

    border: 1px solid rgba(96,165,250,0.3);

    color: #93c5fd;

    padding: 8px 14px;

    border-radius: 999px;

    font-size: 13px;

    margin-bottom: 18px;

    backdrop-filter: blur(10px);
}

.hero-content h1{
    font-size: 42px;

    margin: 0;

    color: white;

    text-shadow:
        0 4px 20px rgba(0,0,0,0.45);
}

.hero-content p{
    margin-top: 14px;

    color: #cbd5e1;

    font-size: 16px;

    max-width: 700px;

    line-height: 1.7;
}

/* button */
.hero-btn{
    margin-top: 25px;

    width: fit-content;

    padding: 12px 22px;

    border: none;

    border-radius: 14px;

    background:
        linear-gradient(135deg,#3b82f6,#2563eb);

    color: white;

    font-weight: 600;

    cursor: pointer;

    transition: 0.3s;
}

.hero-btn:hover{
    transform: scale(1.05);

    box-shadow:
        0 10px 25px rgba(59,130,246,0.4);
}
.hero-banner {
    margin-top: 20px;
    position: relative;
    z-index: 1;
}

.sidebar {
    z-index: 999;
}

.top-menu {
    z-index: 10;
}
.hero-banner{
    height: 300px;
}

.hero-content{
    padding: 32px 46px;
}

.hero-btn{
    margin-top: 16px;
    padding: 10px 18px;
}

.home-content {
    width: min(1240px, 100%);
    margin: 0 auto;
    padding: 18px 24px 55px;
}

.account-section {
    margin-top: 32px;
    padding: 25px;
    border: 1px solid rgba(148, 163, 184, .13);
    border-radius: 24px;
    background: radial-gradient(circle at top right, rgba(59, 130, 246, .12), transparent 32%), rgba(15, 23, 42, .62);
    box-shadow: 0 20px 55px rgba(0, 0, 0, .2);
}

.account-section-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 18px;
    margin-bottom: 20px;
}

.account-section-head .section-title {
    margin: 0 0 6px;
    color: #fff;
    font-size: 18px;
}

.account-section-head p {
    margin: 0;
    color: #94a3b8;
    font-size: 12px;
}

#account-list.account-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
}

.account-card {
    --account-accent: #3b82f6;
    position: relative;
    display: flex;
    min-width: 0;
    min-height: 285px;
    padding: 20px;
    overflow: hidden;
    border: 1px solid rgba(148, 163, 184, .14);
    border-radius: 20px;
    background: linear-gradient(155deg, rgba(18, 30, 53, .98), rgba(9, 17, 34, .98));
    box-shadow: 0 15px 35px rgba(0, 0, 0, .2);
    transition: transform .35s cubic-bezier(.16, 1, .3, 1), border-color .3s, box-shadow .3s;
    animation: accountCardIn .5s cubic-bezier(.16, 1, .3, 1) both;
    animation-delay: var(--delay, 0ms);
}

.account-card::before {
    content: "";
    position: absolute;
    width: 140px;
    height: 140px;
    top: -85px;
    right: -65px;
    border-radius: 50%;
    background: rgba(59, 130, 246, .2);
    filter: blur(8px);
    transition: .4s;
}

.account-card:hover {
    transform: translateY(-7px);
    border-color: rgba(96, 165, 250, .5);
    box-shadow: 0 22px 50px rgba(0, 0, 0, .3), 0 0 30px rgba(59, 130, 246, .16);
}

.account-card:hover::before {
    transform: translate(-22px, 22px) scale(1.2);
}

.account-card-body {
    position: relative;
    z-index: 2;
    display: flex;
    width: 100%;
    min-width: 0;
    flex-direction: column;
}

.account-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 18px;
}

.account-platform {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 10px;
    border: 1px solid rgba(96, 165, 250, .28);
    border-radius: 10px;
    color: #bfdbfe;
    background: rgba(59, 130, 246, .12);
    font-size: 11px;
    font-weight: 700;
    text-transform: capitalize;
}

.account-availability {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #86efac;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
}

.account-availability::before {
    content: "";
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 12px rgba(34, 197, 94, .8);
}

.account-card-title {
    margin: 0 0 9px;
    overflow: hidden;
    color: #fff;
    font-size: 17px;
    line-height: 1.4;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.account-username {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 0;
    margin-bottom: 18px;
    color: #94a3b8;
    font-size: 12px;
}

.account-username span {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.account-price-label {
    margin-top: auto;
    color: #64748b;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .8px;
    text-transform: uppercase;
}

.account-price {
    margin: 5px 0 17px;
    color: #fb7185;
    font-size: clamp(20px, 2vw, 25px);
    font-weight: 800;
    line-height: 1.2;
    overflow-wrap: anywhere;
}

.account-buy-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    width: 100%;
    min-height: 46px;
    overflow: hidden;
    border: 0;
    border-radius: 13px;
    color: #fff;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    box-shadow: 0 12px 26px rgba(37, 99, 235, .25);
    cursor: pointer;
    font-weight: 800;
    transition: transform .25s, box-shadow .25s, filter .25s;
}

.account-buy-btn::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, .25), transparent 70%);
    transform: translateX(-120%);
    transition: transform .65s ease;
}

.account-buy-btn:hover {
    transform: translateY(-2px);
    filter: brightness(1.1);
    box-shadow: 0 16px 34px rgba(37, 99, 235, .38);
}

.account-buy-btn:hover::before {
    transform: translateX(120%);
}

.account-buy-btn:active {
    transform: scale(.98);
}

.account-buy-btn.loading {
    pointer-events: none;
    opacity: .8;
}

.account-card.sold {
    opacity: .62;
    filter: grayscale(.45);
}

.account-card.sold .account-availability {
    color: #fca5a5;
}

.account-card.sold .account-availability::before {
    background: #ef4444;
    box-shadow: 0 0 12px rgba(239, 68, 68, .65);
}

.account-buy-btn.sold {
    background: #334155;
    box-shadow: none;
    cursor: not-allowed;
}

.account-state {
    grid-column: 1 / -1;
    display: grid;
    min-height: 190px;
    place-items: center;
    padding: 25px;
    border: 1px dashed rgba(148, 163, 184, .2);
    border-radius: 18px;
    color: #94a3b8;
    text-align: center;
    background: rgba(15, 23, 42, .45);
}

.account-loading-dots {
    display: flex;
    justify-content: center;
    gap: 7px;
    margin-bottom: 12px;
}

.account-loading-dots span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #60a5fa;
    animation: accountDot 1s ease-in-out infinite alternate;
}

.account-loading-dots span:nth-child(2) { animation-delay: .16s; }
.account-loading-dots span:nth-child(3) { animation-delay: .32s; }

@keyframes accountCardIn {
    from { opacity: 0; transform: translateY(18px) scale(.97); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes accountDot {
    to { transform: translateY(-7px); opacity: .45; }
}

@media(max-width: 1050px) {
    #account-list.account-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media(max-width: 700px) {
    .home-content {
        padding: 12px;
    }

    .account-section {
        padding: 17px;
    }

    .account-section-head {
        align-items: flex-start;
        flex-direction: column;
    }

    #account-list.account-grid {
        grid-template-columns: 1fr;
    }
}

body.light-mode .account-section,
body.light-mode .account-card,
body.light-mode .account-state {
    border-color: #dbe3ee;
    background: #fff;
}

body.light-mode .account-card-title,
body.light-mode .account-section-head .section-title {
    color: #0f172a;
}

body.light-mode .account-username,
body.light-mode .account-section-head p {
    color: #64748b;
}

@media(prefers-reduced-motion: reduce) {
    .account-card,
    .account-card::before,
    .account-buy-btn,
    .account-buy-btn::before,
    .account-loading-dots span {
        animation: none !important;
        transition-duration: .01ms !important;
    }
}
</style>
{{-- {{ dd($accounts) }} --}}
<div class="mmo">

    <!-- SIDEBAR -->
    {{-- <div class="sidebar">
        <div class="logo">TRUNGMAN<span>MMO</span></div>

        <a class="active">🏠 Trang chủ</a>
        <a>📦 Tài khoản</a>
        <a>🛠 Dịch vụ</a>
        <a>💰 Nạp tiền</a>
    </div> --}}

    <!-- MAIN -->
    <div class="home-content">

        <!-- TOP -->
       <div class="hero-banner">

    <div class="hero-overlay"></div>

    <div class="hero-content">
        <span class="hero-tag">
            🚀 TRUNG TÂM MMO SYSTEM
        </span>

        <h1>
            Chào mừng trở lại 👋
        </h1>

        <p>
            Hệ thống dịch vụ MMO • Auto MXH • Mở khóa Facebook • Tăng tương tác
        </p>

        <button class="hero-btn" onclick="document.getElementById('accounts').scrollIntoView({ behavior: 'smooth' })">
            Khám phá dịch vụ
        </button>
    </div>

</div>

        <!-- SERVICES -->
        <h5 class="section-title">DỊCH VỤ NỔI BẬT</h5>

        <div class="service-grid">

            @php $i = 1; @endphp
            @foreach([
                'Tăng tương tác',
                'Auto MXH',
                'Tài nguyên',
                'AI Manager',
                'Chat Support',
                'Forum MMO',
                'Find Job',
                'Chợ MMO'
            ] as $item)

            <div class="service-box">
                <span class="number">{{ str_pad($i++, 2, '0', STR_PAD_LEFT) }}</span>
                <div class="content">
                    <h6>{{ $item }}</h6>
                    <p>Dịch vụ MMO chất lượng cao</p>
                </div>
            </div>

            @endforeach

        </div>

        <!-- ACCOUNT -->
<section class="account-section" id="accounts">
    <div class="account-section-head">
        <div>
            <h5 class="section-title">TÀI KHOẢN MMO</h5>
            <p>Tài nguyên được kiểm tra, sẵn sàng bàn giao ngay sau khi mua.</p>
        </div>

        <div class="but">
            <button class="active" data-account-filter onclick="loadAccounts('', this)">Tất cả</button>
            <button data-account-filter onclick="loadAccounts('facebook', this)">Facebook</button>
            <button data-account-filter onclick="loadAccounts('tiktok', this)">TikTok</button>
        </div>
    </div>

    <div id="account-list" class="account-grid"></div>
</section>

<script src="/js/account.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadAccounts();
    });
</script>
    </div>
</div>

@endsection
