<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <section class="space-page">

        <canvas id="spaceCanvas"></canvas>

        <div class="space-overlay"></div>

        <div class="space-nav">
            <div class="space-logo">COSMIC MMO</div>

            <div class="space-links">
                <a href="/">Trang chủ</a>
                <a href="#account-list">Tài khoản</a>
                <a href="/deposit">Nạp tiền</a>
                <a href="/my-orders">Đã mua</a>
            </div>
        </div>

        <section class="space-hero">
            <div class="hero-content">
                <span class="hero-badge">PREMIUM ACCOUNT STORE</span>

                <h1>
                    KHÁM PHÁ<br>
                    VŨ TRỤ TÀI KHOẢN
                </h1>

                <p>
                    Hệ thống bán tài khoản tự động, nhanh chóng, bảo mật
                    và chuyên nghiệp như một marketplace MMO thực thụ.
                </p>

                <div class="hero-actions">
                    <a href="#account-list" class="space-btn primary">Khám phá ngay</a>
                    <a href="/deposit" class="space-btn secondary">Nạp tiền</a>
                </div>
            </div>

            <div class="planet planet-main"></div>
            <div class="planet planet-small"></div>
        </section>

        <section class="space-about">
            <div class="about-card">
                <span>HÀNH TRÌNH BẮT ĐẦU</span>
                <h2>Bay tới trung tâm<br>vũ trụ MMO</h2>

                <p>
                    Mỗi tài khoản giống như một hành tinh riêng biệt.
                    Bạn chọn, thanh toán bằng ví, hệ thống xử lý và lưu lại
                    lịch sử mua hàng để bạn xem bất cứ lúc nào.
                </p>

                <div class="about-stats">
                    <div>
                        <strong>24/7</strong>
                        <small>Tự động</small>
                    </div>
                    <div>
                        <strong>FAST</strong>
                        <small>Xử lý nhanh</small>
                    </div>
                    <div>
                        <strong>SAFE</strong>
                        <small>Bảo mật</small>
                    </div>
                </div>
            </div>

            <div class="astronaut-wrap">
                <div class="astronaut-body">🧑‍🚀</div>
                <div class="jet"></div>
            </div>
        </section>

    </section>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: #02030f;
            color: #fff;
            overflow-x: hidden;
            font-family: 'Segoe UI', sans-serif;
        }

        .space-page {
            position: relative;
            background: #02030f;
            overflow: hidden;
        }

        #spaceCanvas {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background: radial-gradient(circle at 50% 40%, #11154a 0%, #040514 45%, #01020a 100%);
        }

        .space-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background:
                radial-gradient(circle at 50% 42%, rgba(170, 80, 255, 0.18), transparent 22%),
                radial-gradient(circle at 75% 70%, rgba(60, 110, 255, 0.16), transparent 25%),
                linear-gradient(180deg, rgba(2, 3, 15, 0.1), rgba(2, 3, 15, 0.8));
        }

        .space-nav {
            position: fixed;
            top: 22px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 80px);
            max-width: 1180px;
            z-index: 20;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 22px;
            border: 1px solid rgba(160, 120, 255, 0.25);
            border-radius: 18px;
            background: rgba(5, 7, 25, 0.48);
            backdrop-filter: blur(16px);
            box-shadow: 0 0 40px rgba(90, 80, 255, 0.18);
        }

        .space-logo {
            font-weight: 900;
            letter-spacing: 2px;
            color: #fff;
            text-shadow: 0 0 18px rgba(180, 100, 255, 0.8);
        }

        .space-links {
            display: flex;
            gap: 22px;
        }

        .space-links a {
            color: #cfd3ff;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .space-links a:hover {
            color: #fff;
            text-shadow: 0 0 12px #b66cff;
        }

        .space-hero,
        .space-about {
            position: relative;
            z-index: 5;
            min-height: 100vh;
        }

        .space-hero {
            display: flex;
            align-items: center;
            padding: 120px 8%;
        }

        .hero-content {
            max-width: 680px;
            animation: revealUp 1.1s ease forwards;
        }

        .hero-badge {
            display: inline-block;
            margin-bottom: 22px;
            padding: 9px 16px;
            border: 1px solid rgba(190, 130, 255, 0.35);
            border-radius: 999px;
            color: #d9b6ff;
            background: rgba(120, 60, 255, 0.12);
            letter-spacing: 2px;
            font-size: 12px;
        }

        .hero-content h1 {
            font-size: clamp(48px, 8vw, 105px);
            line-height: 0.95;
            margin: 0;
            font-weight: 950;
            letter-spacing: 4px;
            background: linear-gradient(90deg, #fff, #aebaff, #df7cff);
            -webkit-background-clip: text;
            color: transparent;
            filter: drop-shadow(0 0 24px rgba(175, 95, 255, 0.55));
            animation: titlePulse 3s ease-in-out infinite alternate;
        }

        .hero-content p {
            width: min(560px, 100%);
            margin: 28px 0 34px;
            color: #c9cceb;
            font-size: 18px;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .space-btn {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 14px;
            text-decoration: none;
            color: #fff;
            font-weight: 800;
            transition: 0.35s;
        }

        .space-btn.primary {
            background: linear-gradient(135deg, #5364ff, #b32dff);
            box-shadow: 0 0 32px rgba(170, 80, 255, 0.65);
        }

        .space-btn.secondary {
            border: 1px solid rgba(200, 160, 255, 0.35);
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
        }

        .space-btn:hover {
            transform: translateY(-5px) scale(1.03);
        }

        .planet {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .planet-main {
            width: 330px;
            height: 330px;
            right: 7%;
            bottom: 12%;
            background:
                radial-gradient(circle at 32% 30%, #cbd8ff, #5267d8 28%, #23155f 58%, #050611 78%);
            box-shadow:
                inset -55px -45px 80px rgba(0, 0, 0, 0.75),
                0 0 90px rgba(100, 120, 255, 0.45);
            animation: floatPlanet 7s ease-in-out infinite;
        }

        .planet-main::after {
            content: "";
            position: absolute;
            inset: 48%;
            width: 430px;
            height: 70px;
            border: 2px solid rgba(180, 150, 255, 0.45);
            border-radius: 50%;
            transform: translate(-50%, -50%) rotate(-18deg);
            box-shadow: 0 0 35px rgba(160, 120, 255, 0.3);
        }

        .planet-small {
            width: 82px;
            height: 82px;
            right: 34%;
            top: 23%;
            background: radial-gradient(circle at 30% 30%, #fff6cf, #c35cff 38%, #160920 75%);
            box-shadow: 0 0 45px rgba(190, 95, 255, 0.75);
            animation: floatPlanet 5.5s ease-in-out infinite reverse;
        }

        .space-about {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 120px 8%;
        }

        .about-card {
            max-width: 520px;
            padding: 34px;
            border: 1px solid rgba(170, 120, 255, 0.22);
            border-radius: 26px;
            background: rgba(8, 10, 34, 0.54);
            backdrop-filter: blur(18px);
            box-shadow: 0 0 55px rgba(100, 70, 255, 0.18);
            animation: revealLeft linear both;
            animation-timeline: view();
            animation-range: entry 10% cover 35%;
        }

        .about-card span {
            color: #ca8cff;
            letter-spacing: 3px;
            font-size: 13px;
            font-weight: 800;
        }

        .about-card h2 {
            margin: 18px 0;
            font-size: clamp(38px, 5vw, 64px);
            line-height: 1.05;
            text-shadow: 0 0 35px rgba(190, 90, 255, 0.45);
        }

        .about-card p {
            color: #cfd1ea;
            line-height: 1.9;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-top: 28px;
        }

        .about-stats div {
            padding: 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .about-stats strong {
            display: block;
            color: #fff;
            font-size: 22px;
        }

        .about-stats small {
            color: #aeb1d4;
        }

        .astronaut-wrap {
            position: relative;
            width: 350px;
            height: 350px;
            animation: astronautFly 5.5s ease-in-out infinite;
        }

        .astronaut-body {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            font-size: 230px;
            filter: drop-shadow(0 0 45px rgba(160, 95, 255, 0.9));
        }

        .jet {
            position: absolute;
            left: 70px;
            bottom: 90px;
            width: 90px;
            height: 22px;
            border-radius: 50%;
            background: linear-gradient(90deg, transparent, #6df0ff, #a855ff);
            filter: blur(8px);
            animation: jetPulse 0.55s ease-in-out infinite alternate;
        }

        @keyframes titlePulse {
            from {
                filter: drop-shadow(0 0 15px rgba(160, 95, 255, 0.4));
            }

            to {
                filter: drop-shadow(0 0 36px rgba(230, 110, 255, 0.95));
            }
        }

        @keyframes revealUp {
            from {
                opacity: 0;
                transform: translateY(45px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes revealLeft {
            from {
                opacity: 0;
                transform: translateX(-80px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes floatPlanet {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-28px) rotate(4deg);
            }
        }

        @keyframes astronautFly {

            0%,
            100% {
                transform: translateY(0) translateX(0) rotate(-12deg);
            }

            50% {
                transform: translateY(-34px) translateX(24px) rotate(-5deg);
            }
        }

        @keyframes jetPulse {
            from {
                opacity: 0.45;
                transform: scaleX(0.75);
            }

            to {
                opacity: 1;
                transform: scaleX(1.25);
            }
        }

        @media (max-width: 900px) {
            .space-nav {
                width: calc(100% - 30px);
            }

            .space-links {
                display: none;
            }

            .space-hero,
            .space-about {
                padding: 110px 24px;
                flex-direction: column;
                align-items: flex-start;
            }

            .planet-main {
                width: 210px;
                height: 210px;
                right: -45px;
                bottom: 40px;
            }

            .astronaut-wrap {
                width: 230px;
                height: 230px;
                margin-top: 50px;
            }

            .astronaut-body {
                font-size: 150px;
            }

            .about-stats {
                grid-template-columns: 1fr;
            }
        }

        /*  */
        .space-hero,
        .space-about {
            opacity: 0.35;
            transform: scale(0.98);
            transition: opacity 0.9s ease, transform 0.9s ease;
        }

        .space-hero.active-section,
        .space-about.active-section {
            opacity: 1;
            transform: scale(1);
        }
    </style>
    <script>
        const canvas = document.getElementById("spaceCanvas");
const ctx = canvas.getContext("2d");

let w, h;
let galaxyDust = [];
let brightStars = [];
let backgroundStars = [];
let shootingStars = [];
let mouse = { x: 0, y: 0 };

function resizeCanvas() {
    w = canvas.width = window.innerWidth * window.devicePixelRatio;
    h = canvas.height = window.innerHeight * window.devicePixelRatio;

    canvas.style.width = window.innerWidth + "px";
    canvas.style.height = window.innerHeight + "px";

    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.scale(window.devicePixelRatio, window.devicePixelRatio);

    w = window.innerWidth;
    h = window.innerHeight;

    createGalaxy();
}

window.addEventListener("resize", resizeCanvas);

window.addEventListener("mousemove", e => {
    mouse.x = (e.clientX - w / 2) * 0.02;
    mouse.y = (e.clientY - h / 2) * 0.02;
});

function createGalaxy() {
    galaxyDust = [];
    brightStars = [];
    backgroundStars = [];
    shootingStars = [];

    const cx = w * 0.56;
    const cy = h * 0.46;
    const maxR = Math.min(w, h) * 0.48;

    // nền sao xa
    for (let i = 0; i < 420; i++) {
        backgroundStars.push({
            x: Math.random() * w,
            y: Math.random() * h,
            size: Math.random() * 1.4 + 0.2,
            alpha: Math.random() * 0.8 + 0.15,
            twinkle: Math.random() * 0.015 + 0.004,
            speed: Math.random() * 0.15 + 0.03
        });
    }

    // bụi giải ngân hà nhiều lớp
    for (let i = 0; i < 3200; i++) {
        const arm = i % 5;
        const r = Math.pow(Math.random(), 0.65) * maxR;
        const spin = r * 0.022;
        const armAngle = arm * ((Math.PI * 2) / 5);
        const noise = (Math.random() - 0.5) * 0.85;

        const angle = armAngle + spin + noise;

        const flatten = 0.42 + Math.random() * 0.2;
        const x = cx + Math.cos(angle) * r * 1.65;
        const y = cy + Math.sin(angle) * r * flatten;

        const isCore = r < maxR * 0.18;

        galaxyDust.push({
            angle,
            radius: r,
            flatten,
            size: isCore ? Math.random() * 2.8 + 0.8 : Math.random() * 2 + 0.25,
            speed: (0.00035 + Math.random() * 0.0012) * (1 + (maxR - r) / maxR),
            alpha: isCore ? Math.random() * 0.8 + 0.35 : Math.random() * 0.55 + 0.12,
            blur: isCore ? 16 : Math.random() * 9 + 3,
            color: pickGalaxyColor(r / maxR),
            offsetX: (Math.random() - 0.5) * 26,
            offsetY: (Math.random() - 0.5) * 16
        });
    }

    // sao sáng trên tay xoắn
    for (let i = 0; i < 230; i++) {
        const arm = i % 5;
        const r = Math.random() * maxR * 0.95;
        const spin = r * 0.022;
        const angle = arm * ((Math.PI * 2) / 5) + spin + (Math.random() - 0.5) * 0.45;

        brightStars.push({
            angle,
            radius: r,
            flatten: 0.46,
            size: Math.random() * 2.4 + 1.1,
            speed: 0.0005 + Math.random() * 0.001,
            alpha: Math.random() * 0.7 + 0.3,
            pulse: Math.random() * Math.PI * 2,
            color: Math.random() > 0.55 ? "255,255,255" : Math.random() > 0.5 ? "160,190,255" : "220,150,255"
        });
    }

    // sao băng
    for (let i = 0; i < 4; i++) {
        resetShootingStar({
            delay: Math.random() * 240
        });
    }
}

function pickGalaxyColor(t) {
    if (t < 0.18) return "255,245,255";
    if (t < 0.38) return Math.random() > 0.45 ? "218,120,255" : "150,170,255";
    if (t < 0.68) return Math.random() > 0.55 ? "115,145,255" : "180,90,255";
    return Math.random() > 0.55 ? "120,90,210" : "255,255,255";
}

function resetShootingStar(extra = {}) {
    shootingStars.push({
        x: Math.random() * w,
        y: Math.random() * h * 0.45,
        length: Math.random() * 130 + 90,
        speed: Math.random() * 7 + 6,
        alpha: 0,
        life: 0,
        delay: extra.delay ?? Math.random() * 300
    });
}

function drawBackground() {
    const bg = ctx.createRadialGradient(w * 0.55, h * 0.45, 0, w * 0.55, h * 0.45, Math.max(w, h));
    bg.addColorStop(0, "rgba(35, 23, 95, 0.55)");
    bg.addColorStop(0.32, "rgba(8, 11, 40, 0.85)");
    bg.addColorStop(1, "rgba(0, 0, 8, 1)");

    ctx.fillStyle = bg;
    ctx.fillRect(0, 0, w, h);

    // nebula màu tím xanh
    drawNebula(w * 0.28, h * 0.28, 420, "rgba(95,80,255,0.16)");
    drawNebula(w * 0.78, h * 0.68, 520, "rgba(210,80,255,0.13)");
    drawNebula(w * 0.55, h * 0.48, 620, "rgba(120,120,255,0.12)");
}

function drawNebula(x, y, r, color) {
    const g = ctx.createRadialGradient(x, y, 0, x, y, r);
    g.addColorStop(0, color);
    g.addColorStop(1, "transparent");
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI * 2);
    ctx.fill();
}

function drawBackgroundStars() {
    backgroundStars.forEach(s => {
        s.alpha += s.twinkle;
        if (s.alpha > 1 || s.alpha < 0.15) s.twinkle *= -1;

        ctx.beginPath();
        ctx.arc(s.x + mouse.x * 0.35, s.y + mouse.y * 0.35, s.size, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(255,255,255,${s.alpha})`;
        ctx.fill();
    });
}

function drawGalaxy() {
    const cx = w * 0.56 + mouse.x;
    const cy = h * 0.46 + mouse.y;

    // halo ngoài
    const halo = ctx.createRadialGradient(cx, cy, 0, cx, cy, Math.min(w, h) * 0.58);
    halo.addColorStop(0, "rgba(255,255,255,0.35)");
    halo.addColorStop(0.12, "rgba(220,120,255,0.24)");
    halo.addColorStop(0.38, "rgba(90,120,255,0.13)");
    halo.addColorStop(1, "transparent");

    ctx.fillStyle = halo;
    ctx.beginPath();
    ctx.arc(cx, cy, Math.min(w, h) * 0.58, 0, Math.PI * 2);
    ctx.fill();

    // bụi sao
    galaxyDust.forEach(p => {
        p.angle += p.speed;

        const x = cx + Math.cos(p.angle) * p.radius * 1.65 + p.offsetX;
        const y = cy + Math.sin(p.angle) * p.radius * p.flatten + p.offsetY;

        ctx.beginPath();
        ctx.shadowBlur = p.blur;
        ctx.shadowColor = `rgba(${p.color},0.75)`;
        ctx.fillStyle = `rgba(${p.color},${p.alpha})`;
        ctx.arc(x, y, p.size, 0, Math.PI * 2);
        ctx.fill();
    });

    ctx.shadowBlur = 0;

    // sao sáng
    brightStars.forEach(s => {
        s.angle += s.speed;
        s.pulse += 0.035;

        const x = cx + Math.cos(s.angle) * s.radius * 1.65;
        const y = cy + Math.sin(s.angle) * s.radius * s.flatten;

        const a = s.alpha + Math.sin(s.pulse) * 0.25;

        ctx.beginPath();
        ctx.shadowBlur = 18;
        ctx.shadowColor = `rgba(${s.color},1)`;
        ctx.fillStyle = `rgba(${s.color},${a})`;
        ctx.arc(x, y, s.size, 0, Math.PI * 2);
        ctx.fill();

        // tia sáng nhỏ
        ctx.strokeStyle = `rgba(${s.color},${a * 0.45})`;
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(x - s.size * 3, y);
        ctx.lineTo(x + s.size * 3, y);
        ctx.moveTo(x, y - s.size * 3);
        ctx.lineTo(x, y + s.size * 3);
        ctx.stroke();
    });

    ctx.shadowBlur = 0;

    // lõi sáng
    const core = ctx.createRadialGradient(cx, cy, 0, cx, cy, 210);
    core.addColorStop(0, "rgba(255,255,255,0.95)");
    core.addColorStop(0.12, "rgba(255,215,255,0.75)");
    core.addColorStop(0.28, "rgba(210,115,255,0.42)");
    core.addColorStop(0.55, "rgba(100,120,255,0.17)");
    core.addColorStop(1, "transparent");

    ctx.fillStyle = core;
    ctx.beginPath();
    ctx.arc(cx, cy, 230, 0, Math.PI * 2);
    ctx.fill();

    // đĩa bụi tối tạo chiều sâu
    ctx.save();
    ctx.translate(cx, cy);
    ctx.rotate(-0.22);
    const dust = ctx.createLinearGradient(-420, 0, 420, 0);
    dust.addColorStop(0, "transparent");
    dust.addColorStop(0.35, "rgba(0,0,0,0.12)");
    dust.addColorStop(0.5, "rgba(0,0,0,0.24)");
    dust.addColorStop(0.65, "rgba(0,0,0,0.12)");
    dust.addColorStop(1, "transparent");

    ctx.fillStyle = dust;
    ctx.fillRect(-520, -18, 1040, 36);
    ctx.restore();
}

function drawShootingStars() {
    shootingStars.forEach((s, index) => {
        if (s.delay > 0) {
            s.delay--;
            return;
        }

        s.life++;
        s.alpha = s.life < 20 ? s.life / 20 : Math.max(0, 1 - (s.life - 20) / 45);

        ctx.save();
        ctx.translate(s.x, s.y);
        ctx.rotate(-0.55);

        const trail = ctx.createLinearGradient(0, 0, -s.length, 0);
        trail.addColorStop(0, `rgba(255,255,255,${s.alpha})`);
        trail.addColorStop(0.45, `rgba(150,190,255,${s.alpha * 0.5})`);
        trail.addColorStop(1, "transparent");

        ctx.strokeStyle = trail;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.lineTo(-s.length, 0);
        ctx.stroke();

        ctx.restore();

        s.x += s.speed;
        s.y += s.speed * 0.52;

        if (s.life > 70 || s.x > w + 200 || s.y > h + 200) {
            shootingStars.splice(index, 1);
            resetShootingStar();
        }
    });
}

function animateGalaxy() {
    ctx.clearRect(0, 0, w, h);

    drawBackground();
    drawBackgroundStars();
    drawGalaxy();
    drawShootingStars();

    requestAnimationFrame(animateGalaxy);
}

resizeCanvas();
animateGalaxy();

        // 
        const revealElements = document.querySelectorAll(".space-hero, .space-about");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active-section");
                }
            });
        }, {
            threshold: 0.25
        });

        revealElements.forEach(el => observer.observe(el));
    </script>
</body>

</html>
