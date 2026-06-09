@php
    $statusMessage = match (session('status')) {
        'profile-updated' => 'Thông tin hồ sơ đã được cập nhật.',
        'password-updated' => 'Mật khẩu đã được cập nhật.',
        'verification-link-sent' => 'Liên kết xác minh mới đã được gửi.',
        default => session('status'),
    };

    $notificationFlashes = [
        ['type' => 'success', 'message' => session('success')],
        ['type' => 'error', 'message' => session('error')],
        ['type' => 'warning', 'message' => session('warning')],
        ['type' => 'info', 'message' => session('info')],
        ['type' => 'info', 'message' => $statusMessage],
        ['type' => 'info', 'message' => session('message')],
    ];
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .mmo-toast-stack {
        position: fixed;
        z-index: 30000;
        top: 22px;
        right: 22px;
        display: grid;
        width: min(390px, calc(100vw - 32px));
        gap: 12px;
        pointer-events: none;
    }

    .mmo-toast {
        --toast-color: #60a5fa;
        position: relative;
        display: grid;
        grid-template-columns: 42px minmax(0, 1fr) 28px;
        align-items: center;
        gap: 12px;
        overflow: hidden;
        padding: 14px;
        border: 1px solid color-mix(in srgb, var(--toast-color) 35%, transparent);
        border-radius: 17px;
        color: #e2e8f0;
        background: rgba(15, 23, 42, .94);
        box-shadow: 0 20px 55px rgba(0, 0, 0, .38), 0 0 28px color-mix(in srgb, var(--toast-color) 14%, transparent);
        backdrop-filter: blur(18px);
        pointer-events: auto;
        animation: mmoToastIn .42s cubic-bezier(.16, 1, .3, 1) both;
    }

    .mmo-toast.success { --toast-color: #22c55e; }
    .mmo-toast.error { --toast-color: #ef4444; }
    .mmo-toast.warning { --toast-color: #f59e0b; }
    .mmo-toast.info { --toast-color: #3b82f6; }

    .mmo-toast.leaving {
        animation: mmoToastOut .28s ease both;
    }

    .mmo-toast-icon {
        display: grid;
        place-items: center;
        width: 42px;
        height: 42px;
        border-radius: 13px;
        color: #fff;
        background: color-mix(in srgb, var(--toast-color) 75%, #111827);
        box-shadow: 0 0 22px color-mix(in srgb, var(--toast-color) 28%, transparent);
    }

    .mmo-toast-content {
        min-width: 0;
    }

    .mmo-toast-title {
        margin-bottom: 3px;
        color: #fff;
        font-size: 13px;
        font-weight: 800;
    }

    .mmo-toast-message {
        color: #aeb9cb;
        font-size: 12px;
        line-height: 1.55;
        overflow-wrap: anywhere;
    }

    .mmo-toast-close {
        width: 28px;
        height: 28px;
        border: 0;
        border-radius: 9px;
        color: #94a3b8;
        background: rgba(148, 163, 184, .08);
        cursor: pointer;
        transition: .2s;
    }

    .mmo-toast-close:hover {
        color: #fff;
        background: rgba(239, 68, 68, .16);
    }

    .mmo-toast-progress {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        height: 3px;
        background: var(--toast-color);
        transform-origin: left;
        animation: mmoToastProgress var(--toast-duration, 4500ms) linear forwards;
    }

    .mmo-confirm {
        position: fixed;
        z-index: 31000;
        inset: 0;
        display: grid;
        place-items: center;
        padding: 20px;
        visibility: hidden;
        opacity: 0;
        transition: .25s ease;
    }

    .mmo-confirm.show {
        visibility: visible;
        opacity: 1;
    }

    .mmo-confirm-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(2, 6, 23, .78);
        backdrop-filter: blur(12px);
    }

    .mmo-confirm-card {
        position: relative;
        width: min(430px, 100%);
        padding: 25px;
        overflow: hidden;
        border: 1px solid rgba(248, 113, 113, .24);
        border-radius: 23px;
        color: #e2e8f0;
        background:
            radial-gradient(circle at top right, rgba(239, 68, 68, .18), transparent 42%),
            linear-gradient(145deg, #111b31, #080f20);
        box-shadow: 0 28px 80px rgba(0, 0, 0, .52);
        transform: translateY(20px) scale(.95);
        transition: .35s cubic-bezier(.16, 1, .3, 1);
    }

    .mmo-confirm.show .mmo-confirm-card {
        transform: translateY(0) scale(1);
    }

    .mmo-confirm-icon {
        display: grid;
        place-items: center;
        width: 58px;
        height: 58px;
        margin-bottom: 17px;
        border-radius: 18px;
        color: #fff;
        background: linear-gradient(135deg, #ef4444, #be123c);
        box-shadow: 0 0 30px rgba(239, 68, 68, .3);
        font-size: 21px;
    }

    .mmo-confirm h3 {
        margin: 0 0 8px;
        color: #fff;
        font-size: 21px;
    }

    .mmo-confirm p {
        margin: 0;
        color: #94a3b8;
        font-size: 13px;
        line-height: 1.7;
    }

    .mmo-confirm-actions {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 10px;
        margin-top: 22px;
    }

    .mmo-confirm-button {
        min-height: 45px;
        border: 1px solid rgba(148, 163, 184, .16);
        border-radius: 13px;
        color: #cbd5e1;
        background: rgba(30, 41, 59, .74);
        cursor: pointer;
        font-weight: 700;
        transition: .2s;
    }

    .mmo-confirm-button:hover {
        color: #fff;
        transform: translateY(-2px);
    }

    .mmo-confirm-button.danger {
        border-color: transparent;
        color: #fff;
        background: linear-gradient(135deg, #ef4444, #be123c);
        box-shadow: 0 10px 25px rgba(239, 68, 68, .22);
    }

    @keyframes mmoToastIn {
        from { opacity: 0; transform: translateX(35px) scale(.96); }
        to { opacity: 1; transform: translateX(0) scale(1); }
    }

    @keyframes mmoToastOut {
        to { opacity: 0; transform: translateX(35px) scale(.96); }
    }

    @keyframes mmoToastProgress {
        to { transform: scaleX(0); }
    }

    @media(max-width: 640px) {
        .mmo-toast-stack {
            top: 14px;
            right: 16px;
            left: 16px;
            width: auto;
        }
    }
</style>

<div class="mmo-toast-stack" id="mmoToastStack" aria-live="polite"></div>

<div class="mmo-confirm" id="mmoConfirmDialog" aria-hidden="true">
    <div class="mmo-confirm-backdrop" data-mmo-confirm-cancel></div>
    <div class="mmo-confirm-card" role="dialog" aria-modal="true" aria-labelledby="mmoConfirmTitle">
        <div class="mmo-confirm-icon"><i class="fas fa-trash-alt"></i></div>
        <h3 id="mmoConfirmTitle">Xác nhận thao tác</h3>
        <p id="mmoConfirmMessage">Hành động này không thể hoàn tác.</p>
        <div class="mmo-confirm-actions">
            <button type="button" class="mmo-confirm-button" data-mmo-confirm-cancel>Hủy</button>
            <button type="button" class="mmo-confirm-button danger" id="mmoConfirmAccept">Xác nhận</button>
        </div>
    </div>
</div>

<script>
    (() => {
        const stack = document.getElementById('mmoToastStack');
        const confirmDialog = document.getElementById('mmoConfirmDialog');
        const confirmTitle = document.getElementById('mmoConfirmTitle');
        const confirmMessage = document.getElementById('mmoConfirmMessage');
        const confirmAccept = document.getElementById('mmoConfirmAccept');
        let pendingConfirmAction = null;

        const toastMeta = {
            success: { title: 'Thành công', icon: 'fa-check' },
            error: { title: 'Có lỗi xảy ra', icon: 'fa-times' },
            warning: { title: 'Cảnh báo', icon: 'fa-exclamation' },
            info: { title: 'Thông báo', icon: 'fa-info' }
        };

        window.mmoToast = (message, type = 'info', options = {}) => {
            const normalizedType = toastMeta[type] ? type : 'info';
            const meta = toastMeta[normalizedType];
            const duration = options.duration ?? 4500;
            const toast = document.createElement('div');

            toast.className = `mmo-toast ${normalizedType}`;
            toast.style.setProperty('--toast-duration', `${duration}ms`);
            toast.innerHTML = `
                <div class="mmo-toast-icon"><i class="fas ${meta.icon}"></i></div>
                <div class="mmo-toast-content">
                    <div class="mmo-toast-title"></div>
                    <div class="mmo-toast-message"></div>
                </div>
                <button type="button" class="mmo-toast-close" aria-label="Đóng"><i class="fas fa-times"></i></button>
                <div class="mmo-toast-progress"></div>
            `;

            toast.querySelector('.mmo-toast-title').textContent = options.title ?? meta.title;
            toast.querySelector('.mmo-toast-message').textContent = String(message);
            stack.appendChild(toast);

            const remove = () => {
                if (toast.classList.contains('leaving')) return;
                toast.classList.add('leaving');
                setTimeout(() => toast.remove(), 280);
            };

            toast.querySelector('.mmo-toast-close').addEventListener('click', remove);
            setTimeout(remove, duration);
        };

        window.mmoNotify = window.mmoToast;

        window.mmoConfirm = (message, options = {}) => new Promise(resolve => {
            confirmTitle.textContent = options.title ?? 'Xác nhận thao tác';
            confirmMessage.textContent = String(message);
            confirmAccept.textContent = options.confirmText ?? 'Xác nhận';
            pendingConfirmAction = resolve;
            confirmDialog.classList.add('show');
            confirmDialog.setAttribute('aria-hidden', 'false');
            setTimeout(() => confirmAccept.focus(), 150);
        });

        const closeConfirm = result => {
            confirmDialog.classList.remove('show');
            confirmDialog.setAttribute('aria-hidden', 'true');

            if (pendingConfirmAction) {
                pendingConfirmAction(result);
                pendingConfirmAction = null;
            }
        };

        document.querySelectorAll('[data-mmo-confirm-cancel]').forEach(element => {
            element.addEventListener('click', () => closeConfirm(false));
        });

        confirmAccept.addEventListener('click', () => closeConfirm(true));

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && confirmDialog.classList.contains('show')) {
                closeConfirm(false);
            }
        });

        document.addEventListener('submit', async event => {
            const form = event.target.closest('form[data-confirm]');

            if (!form || form.dataset.confirmed === 'true') return;

            event.preventDefault();
            const accepted = await window.mmoConfirm(form.dataset.confirm, {
                title: form.dataset.confirmTitle || 'Xác nhận thao tác',
                confirmText: form.dataset.confirmButton || 'Xác nhận'
            });

            if (accepted) {
                form.dataset.confirmed = 'true';
                form.requestSubmit();
            }
        }, true);

        window.alert = message => window.mmoToast(message, 'info');

        const flashes = @json($notificationFlashes);

        flashes.filter(item => item.message).forEach((item, index) => {
            setTimeout(() => window.mmoToast(item.message, item.type), 120 + (index * 120));
        });

        const validationErrors = @json($errors->all());
        validationErrors.slice(0, 4).forEach((message, index) => {
            setTimeout(() => window.mmoToast(message, 'error', { title: 'Dữ liệu chưa hợp lệ' }), 180 + (index * 140));
        });
    })();
</script>
