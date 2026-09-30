# Bản đồ chức năng dự án DemoAPI

Tài liệu này mô tả các chức năng đang có trong dự án, vị trí code xử lý và luồng dữ liệu chính. Các comment tiếng Việt trong source tập trung vào nghiệp vụ; HTML/CSS thuần và file khung Laravel mặc định được mô tả tại đây để tránh làm code quá rối.

## 1. Kiến trúc tổng quan

- Framework backend: Laravel 10, PHP 8.1+.
- Xác thực: Laravel Breeze, session web và Sanctum cho API.
- Giao diện: Blade, Tailwind/Vite và CSS viết trực tiếp trong các view MMO.
- Database chính: users, categories, accounts, orders, service_requests, service_messages.
- Phân quyền: `user` và `admin`, kiểm tra qua middleware `checkrole`.

Luồng xử lý phổ biến:

```text
Blade/JavaScript -> Route -> Controller -> Model -> Database
                            -> Response/View/JSON
```

## 2. Xác thực và phân quyền

### File chính

- `routes/auth.php`: đăng ký, đăng nhập, đăng xuất, quên/reset mật khẩu, xác minh email.
- `app/Http/Controllers/Auth/*`: controller mặc định của Laravel Breeze.
- `app/Http/Requests/Auth/LoginRequest.php`: kiểm tra dữ liệu đăng nhập và giới hạn số lần thử.
- `app/Http/Middleware/CheckRole.php`: yêu cầu người dùng đăng nhập và có đúng role.
- `app/Http/Middleware/AdminMiddleware.php`: middleware admin cũ.
- `app/Http/Kernel.php`: đăng ký middleware web, api và bí danh `checkrole`, `admin`.

### Quyền truy cập

- Khách: xem trang chủ, tài khoản, dịch vụ, chính sách và trang checkout.
- Người dùng đăng nhập: hồ sơ, đơn đã mua và API mua tài khoản.
- Admin: dashboard, quản lý tài khoản, danh mục, người dùng, số dư và ticket.

## 3. Trang chủ và danh sách tài khoản

### Luồng

1. `routes/web.php` nhận `GET /`.
2. `app/Http/Controllers/HomeController.php` tải tài khoản và danh mục.
3. `resources/views/home.blade.php` hiển thị trang chủ.
4. `public/js/account.js` gọi `GET /api/accounts`, lọc và render card tài khoản.
5. Khi bấm mua, JavaScript chuyển đến `/checkout/{id}`.

### File liên quan

- `app/Models/Account.php`: tài khoản bán, liên kết category và orders.
- `app/Models/Category.php`: danh mục nền tảng/dịch vụ.
- `app/Http/Controllers/Api/AccountController.php`: API danh sách và CRUD tài khoản.
- `resources/views/admin/accounts/index.blade.php`: quản lý tài khoản phía admin.
- `resources/views/admin/categories/index.blade.php`: quản lý danh mục phía admin.

## 4. Thanh toán và đơn hàng

### Luồng mua tài khoản đang sử dụng

1. `GET /checkout/{id}` mở `resources/views/checkout.blade.php`.
2. Người dùng bấm thanh toán.
3. JavaScript gọi `POST /api/buy-account/{id}`.
4. `app/Http/Controllers/Api/OrderApiController.php`:
   - kiểm tra đăng nhập;
   - khóa dòng account bằng `lockForUpdate`;
   - kiểm tra tài khoản chưa bán và số dư đủ;
   - trừ số dư;
   - đánh dấu account đã bán;
   - tạo order chứa username/password bàn giao;
   - commit transaction.
5. Thành công sẽ chuyển đến `/my-orders`.

### Lịch sử mua hàng

- `app/Http/Controllers/User/OrderController.php::myOrders()` chỉ lấy đơn của user hiện tại.
- `resources/views/orders.blade.php` hiển thị username, password, giá và thời gian mua.
- `tests/Feature/OrderAccessTest.php` bảo đảm hai người dùng không thấy đơn của nhau.

### Model và bảng

- `app/Models/Order.php`: liên kết người mua và tài khoản.
- `database/migrations/2026_05_06_081202_create_orders_table.php`: bảng orders gốc.
- Các migration `2026_05_06_*orders*`: bổ sung và điều chỉnh cấu trúc orders.

## 5. Nạp tiền và quản lý số dư

### Người dùng

- `GET /deposit`: hiển thị QR và nội dung chuyển khoản cá nhân.
- `resources/views/deposit.blade.php`: giao diện QR, sao chép số tài khoản và mã chuyển khoản.
- Mã chuyển khoản dùng dạng `NAPTIEN_{user_id}`.

### Admin

- `resources/views/admin/users/index.blade.php`: giao diện cộng/trừ số dư.
- `app/Http/Controllers/Admin/UserController.php`: kiểm tra số tiền và cập nhật balance.

### Cảnh báo

`POST /deposit` trong `User\DepositController::store()` đang cộng số dư trực tiếp từ giá trị request. Không nên công khai endpoint này trên production nếu chưa có xác minh webhook ngân hàng hoặc duyệt giao dịch từ admin.

## 6. Hồ sơ và ảnh đại diện

### Luồng

- `GET /profile`: hiển thị hồ sơ.
- `PATCH /profile`: cập nhật tên, email và avatar.
- `DELETE /profile`: xác minh mật khẩu rồi xóa tài khoản.

### File liên quan

- `app/Http/Controllers/ProfileController.php`: cập nhật hồ sơ, lưu/xóa avatar.
- `app/Http/Requests/ProfileUpdateRequest.php`: validation tên, email và ảnh tối đa 2MB.
- `resources/views/profile/edit.blade.php`: giao diện hồ sơ MMO.
- `resources/views/profile/partials/*`: form thông tin, mật khẩu và xóa tài khoản.
- `database/migrations/2026_06_09_000000_add_avatar_to_users_table.php`: trường avatar.
- `tests/Feature/ProfileTest.php`: test hồ sơ và upload avatar.

Ảnh được lưu tại `storage/app/public/avatars` và hiển thị qua `public/storage`.

## 7. Hỗ trợ dịch vụ và hội thoại

### Luồng người dùng

1. Người dùng mở `/service/{platform}/{slug}`.
2. `resources/views/services/detail.blade.php` điều khiển bot hỏi đáp.
3. Khi đủ dữ liệu, JavaScript gọi `POST /service-request`.
4. `ServiceRequestController::store()` tạo ticket và tin nhắn ban đầu trong transaction.
5. Khi ticket đã tồn tại, JavaScript polling tin nhắn mới theo `after_id`.

### Luồng admin

- `GET /admin/services`: danh sách ticket.
- `GET /admin/services/{id}`: chi tiết hội thoại.
- Admin gửi phản hồi, đánh dấu hoàn thành hoặc xóa ticket hoàn thành.
- `resources/views/admin/serviceRequests/show.blade.php` chỉ nối tin mới để tránh nháy hội thoại.

### Model

- `ServiceRequest`: thông tin ticket, trạng thái pending/processing/done.
- `ServiceMessage`: tin nhắn có sender user/admin/ai.

### Dọn dữ liệu

`app/Console/Kernel.php` tự xóa ticket hoàn thành quá 90 ngày lúc 02:00 mỗi ngày. Production cần cấu hình cron chạy:

```bash
php artisan schedule:run
```

### Cảnh báo quyền truy cập

Hai route `/service-ticket/{id}/messages` và `/service-ticket/{id}/message` trong `routes/admin.php` hiện nằm ngoài nhóm middleware admin. Trước production cần thêm `auth` và kiểm tra user chỉ được đọc/ghi ticket của chính mình.

## 8. Dashboard và khu vực admin

- `routes/admin.php`: toàn bộ route admin có prefix `/admin` và middleware `checkrole:admin`.
- `Admin\DashboardController`: tổng user, account, order và doanh thu.
- `AppServiceProvider`: chia sẻ thống kê cho tất cả view `admin.*`.
- `resources/views/admin/layout.blade.php`: layout/sidebar admin.
- `resources/views/admin/dashboard.blade.php`: dashboard tổng quan.

## 9. Thông báo và xác nhận

`resources/views/components/mmo-notifications.blade.php` cung cấp:

- `window.mmoToast(message, type, options)`: toast success/error/warning/info.
- `window.mmoConfirm(message, options)`: modal xác nhận bất đồng bộ.
- Tự chuyển flash session và lỗi validation thành toast.
- Tự xử lý form có thuộc tính `data-confirm`.

Component được include trong các layout và trang độc lập quan trọng.

## 10. Layout và giao diện

- `resources/views/layouts/mmo.blade.php`: layout trang chủ MMO, sidebar, tìm kiếm, theme, menu user.
- `resources/views/layouts/app.blade.php`: layout các trang Breeze như profile.
- `resources/views/layouts/guest.blade.php`: layout đăng nhập/đăng ký.
- `resources/views/admin/layout.blade.php`: layout quản trị.
- `resources/views/components/*`: component Blade dùng lại.

CSS chủ yếu nằm trực tiếp trong từng Blade để mỗi trang độc lập. Khi dự án lớn hơn nên tách CSS/JS sang `resources/css` và `resources/js`.

## 11. Routes theo nhóm

### `routes/web.php`

- Trang công khai, hồ sơ, checkout, đơn hàng, nạp tiền, chính sách và tạo ticket.

### `routes/api.php`

- `GET /api/accounts`: danh sách tài khoản.
- `POST /api/buy-account/{id}`: mua tài khoản, yêu cầu Sanctum.

### `routes/admin.php`

- Dashboard và CRUD admin.
- Ticket/chat hỗ trợ.

### `routes/user.php`

- Home riêng cho user đăng nhập; hiện ít được sử dụng.

### `routes/auth.php`

- Toàn bộ chức năng xác thực Laravel Breeze.

## 12. Database và quan hệ chính

```text
users 1---n orders n---1 accounts n---1 categories
users 1---n service_requests 1---n service_messages
users 1---n service_messages
```

- Xóa user sẽ xóa orders theo foreign key hiện tại.
- Xóa category sẽ xóa accounts theo cascade.
- Xóa service_request sẽ xóa service_messages theo cascade.

## 13. Kiểm thử

- `tests/Feature/Auth/*`: xác thực, mật khẩu và email.
- `tests/Feature/ProfileTest.php`: hồ sơ, avatar và xóa tài khoản.
- `tests/Feature/OrderAccessTest.php`: phân quyền lịch sử đơn hàng.
- `tests/Feature/ExampleTest.php`: phản hồi trang cơ bản.
- `tests/Unit/ExampleTest.php`: unit test mẫu.

Chạy toàn bộ test:

```bash
php artisan test
```

## 14. Các điểm nên ưu tiên trước production

1. Bảo vệ route chat ticket bằng auth và kiểm tra quyền sở hữu.
2. Không cho `POST /deposit` cộng tiền trực tiếp nếu chưa xác minh giao dịch.
3. Đưa mật khẩu admin seed ra biến môi trường; không dùng mật khẩu cố định.
4. Chuẩn hóa trạng thái account đang dùng lẫn `sold` và số `1`.
5. Gộp các controller trùng chức năng như `Api\AccountApiController` và `Api\AccountController`.
6. Gộp luồng mua cũ trong `User\OrderController::buy()` với API mua hiện tại.
7. Thêm validation đầy đủ cho update account/category admin thay vì dùng toàn bộ `$request->all()`.
8. Thêm pagination cho danh sách user, account, order và ticket khi dữ liệu tăng.

