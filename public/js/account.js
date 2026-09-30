const csrf = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute("content");

// Chuyển dữ liệu không tin cậy thành text an toàn trước khi chèn vào HTML.
function escapeHtml(value = "") {
    const element = document.createElement("div");
    element.textContent = String(value);
    return element.innerHTML;
}

// Chọn icon tương ứng với nền tảng của tài khoản.
function accountPlatformIcon(platform = "") {
    const normalized = platform.toLowerCase();

    if (normalized.includes("facebook")) return "fab fa-facebook-f";
    if (normalized.includes("tiktok")) return "fab fa-tiktok";
    if (normalized.includes("instagram")) return "fab fa-instagram";

    return "fas fa-box";
}

// Cập nhật trạng thái nút bộ lọc đang được chọn.
function setActiveAccountFilter(activeButton) {
    if (!activeButton) return;

    document.querySelectorAll("[data-account-filter]").forEach((button) => {
        button.classList.toggle("active", button === activeButton);
    });
}

// Hiển thị trạng thái tải dữ liệu, danh sách trống hoặc lỗi.
function renderAccountState(message, loading = false) {
    const accountList = document.getElementById("account-list");

    if (!accountList) return;

    accountList.innerHTML = `
        <div class="account-state">
            <div>
                ${loading ? `
                    <div class="account-loading-dots">
                        <span></span><span></span><span></span>
                    </div>
                ` : '<i class="fas fa-box-open" style="font-size:28px;color:#60a5fa;margin-bottom:12px;"></i>'}
                <div>${escapeHtml(message)}</div>
            </div>
        </div>
    `;
}

// Tạo HTML cho một card tài khoản từ dữ liệu API.
function renderAccountCard(account, index) {
    const category = account.category?.name || "Tài khoản MMO";
    const isSold = Number(account.status) === 1;
    const icon = accountPlatformIcon(category);

    return `
        <article class="account-card ${isSold ? "sold" : ""}" style="--delay:${Math.min(index * 65, 390)}ms">
            <div class="account-card-body">
                <div class="account-card-top">
                    <span class="account-platform">
                        <i class="${icon}"></i>
                        ${escapeHtml(category)}
                    </span>
                    <span class="account-availability">${isSold ? "Đã bán" : "Sẵn sàng"}</span>
                </div>

                <h3 class="account-card-title" title="${escapeHtml(account.title)}">
                    ${escapeHtml(account.title)}
                </h3>

                <div class="account-username">
                    <i class="far fa-user"></i>
                    <span>${escapeHtml(account.username)}</span>
                </div>

                <span class="account-price-label">Giá tài khoản</span>
                <div class="account-price">${Number(account.price || 0).toLocaleString("vi-VN")}đ</div>

                ${isSold
                    ? `<button class="account-buy-btn sold" disabled>
                            <i class="fas fa-lock"></i>
                            Đã bán
                       </button>`
                    : `<button class="account-buy-btn" onclick="goToCheckout(${Number(account.id)}, this)">
                            <i class="fas fa-shopping-cart"></i>
                            Mua ngay
                       </button>`
                }
            </div>
        </article>
    `;
}

// Gọi API lấy danh sách tài khoản và render lại khu vực tài khoản.
async function loadAccounts(category = "", activeButton = null) {
    setActiveAccountFilter(activeButton);
    renderAccountState("Đang tải danh sách tài khoản...", true);

    const url = category
        ? `/api/accounts?category=${encodeURIComponent(category)}`
        : "/api/accounts";

    try {
        const response = await fetch(url, {
            headers: { Accept: "application/json" },
        });

        if (!response.ok) {
            throw new Error("Không thể tải danh sách tài khoản.");
        }

        const accounts = await response.json();
        const accountList = document.getElementById("account-list");

        if (!Array.isArray(accounts) || accounts.length === 0) {
            renderAccountState("Chưa có tài khoản phù hợp với bộ lọc này.");
            return;
        }

        accountList.innerHTML = accounts
            .map((account, index) => renderAccountCard(account, index))
            .join("");
    } catch (error) {
        console.error(error);
        renderAccountState("Không thể tải tài khoản. Vui lòng thử lại.");

        if (window.mmoToast) {
            window.mmoToast("Không thể tải danh sách tài khoản.", "error");
        }
    }
}

// Hiển thị trạng thái chuyển trang trước khi mở checkout.
function goToCheckout(id, button) {
    if (button) {
        button.classList.add("loading");
        button.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Đang chuyển...';
    }

    setTimeout(() => {
        window.location.href = `/checkout/${id}`;
    }, 350);
}

// Hàm mua trực tiếp qua API; hiện giao diện chính chuyển qua trang checkout.
async function buyAccount(id) {
    try {
        const response = await fetch(`/api/buy-account/${id}`, {
            method: "POST",
            credentials: "include",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf,
            },
        });

        const data = await response.json();
        window.mmoToast?.(data.message, data.status ? "success" : "error");

        if (data.status) {
            loadAccounts();
        }
    } catch (error) {
        console.error(error);
        window.mmoToast?.("Lỗi hệ thống", "error");
    }
}
