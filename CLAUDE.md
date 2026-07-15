# Dự án: Website HTSOFT (dradnet.vn)

Website bán/giới thiệu bộ phần mềm thiết kế hạ tầng giao thông của HTSOFT, phong cách tối giản,
tổ chức nội dung theo dạng thẻ (card) kiểu bibliocad.com, nút bấm 3D sắc nét (viền đen +
đổ bóng cứng, không gradient/blur). Đặc tả nghiệp vụ đầy đủ nằm ở `CAUTAOWEB.docx` — coi
đây là nguồn sự thật khi có mâu thuẫn với file này. (Dự kiến chuyển vào `docs/CAUTAOWEB.docx`
khi file không còn bị khoá bởi Word đang mở nó.)

Stack đã chốt: **PHP thuần (không framework) + MySQL**, deploy lên domain **dradnet.vn**.
OTP đăng nhập gửi qua **Zalo Cloud Account (ZCA)** — làm việc trực tiếp với Zalo, không qua
API ZNS chính thức (xem cảnh báo rủi ro trong `src/lib/ZaloClient.php`).

## Vì sao có backend ngay từ Giai đoạn 1

Khác các site tĩnh khác của công ty, luồng đăng nhập của site này (kiểm tra SĐT trong CSDL,
tự sinh mật khẩu, gửi qua Zalo/SMS) bắt buộc phải chạy PHP + MySQL thật ngay từ đầu — không
làm HTML tĩnh trước rồi thêm server sau.

---

## Cấu trúc thư mục

```
public/                        ← webroot, trỏ document root của server vào đây
  index.php                    ← Trang chủ, lưới 8 thẻ sản phẩm (2 dòng x 4 cột)
  bao-gia.php                  ← Bộ tính báo giá
  huong-dan.php                ← Hub hướng dẫn — mỗi thẻ có 2 nút: Xem hướng dẫn / Trực tuyến
  ho-tro-truc-tuyen.php        ← Hướng dẫn gửi ID/Pass UltraView cho KTV — hotline đã có, TODO(Admin) Zalo/link UltraView
  dang-nhap.php                ← Form đăng nhập bằng SĐT
  mo-dun/                      ← 8 trang chi tiết sản phẩm, cùng mẫu Features/Gallery/Video
    dradnet.php                ← Trang mồ côi cũ, không còn link nào trỏ tới (xem ghi chú bên dưới)
    cong-tron-cong-hop-duc-san.php
    cong-hop-do-tai-cho.php
    cau-ban-cong-ban-tran-lien-hop.php
    thiet-ke-ho-ga.php
    thiet-ke-cau-gian-don.php
    kiem-toan-cau-gian-don.php
    kiem-toan-cau-ban.php
    kiem-toan-cong-hop.php
  huong-dan/                   ← 8 trang hướng dẫn riêng (roadmap 3 bước, click mở), 1-1 với mo-dun/
  admin/                       ← Trang quản trị nội bộ (Admin dùng, sau này thêm auth riêng)
  api/
    check-phone.php            ← Endpoint kiểm tra SĐT / tạo tài khoản mới
  includes/
    header.php                 ← <head> + .topbar dùng chung — COPY nguyên, không sửa lẻ tẻ
    footer.php                 ← .floating-cta + footer dùng chung
  assets/
    css/style.css               ← style dùng chung: biến màu, .btn-3d, .card-3d
    js/main.js                  ← ẩn/hiện topbar khi cuộn
    images/

src/                           ← code PHP nằm NGOÀI webroot (không truy cập trực tiếp qua URL)
  bootstrap.php                ← autoloader thủ công cho namespace Htsoft\
  config/database.php          ← đọc .env, trả về config kết nối DB
  lib/
    Database.php                ← PDO singleton
    Auth.php                    ← luồng đăng nhập SĐT (đúng theo docs/CAUTAOWEB.docx)
    ZaloClient.php               ← gửi OTP qua Zalo ZCA — CHƯA cài đặt thật, có TODO rõ ràng
    CreditService.php            ← nạp/trừ tín dụng, tính số dư, lịch sử — MỌI thay đổi
                                    credit_balance phải đi qua đây (xem "Hệ thống tín dụng")
    InsufficientCreditException.php ← ném ra khi số dư không đủ để dùng sản phẩm
  models/                       ← (chưa có file — thêm khi cần, đừng tạo class rỗng trước)

database/
  schema.sql                   ← 5 bảng: users, products, credit_packages, credit_transactions,
                                  desktop_sync_logs (⚠️ đã thay subscriptions bằng hệ tín dụng)

CAUTAOWEB.docx                 ← đặc tả nghiệp vụ gốc, nguồn sự thật (chuyển vào docs/ sau)
```

**Dùng chung mọi trang:** `includes/header.php` (mở `<html>`, `.topbar`) và
`includes/footer.php` (`.floating-cta`, `footer`, đóng `<html>`). Mỗi trang PHP mới chỉ cần
`require __DIR__ . '/includes/header.php';` ở đầu và `require __DIR__ . '/includes/footer.php';`
ở cuối — không copy-paste lại HTML của header/footer vào từng trang.

---

## Hệ thống thiết kế

3 màu có vai trò cố định, không đổi tuỳ tiện (định nghĩa trong `public/assets/css/style.css`):

| Màu | Biến CSS | Dùng cho |
|---|---|---|
| Vàng `#FFCA36` (nút) / `#FFD700` (thẻ) | `--btn-yellow-bg` / `--bamboo-gold` | CTA chính — `.btn-3d-yellow` (vd: "Xem chi tiết") |
| Xanh lá `#2E7D32` | `--btn-green-bg` / `--bamboo-green` | Xác nhận/tin cậy — dấu tick `.tick-3d`, nút "Đã chọn" |
| Đỏ cam `#F05431` (nút) / `#E5484D` (thẻ) | `--btn-red-bg` / `--danger-red` | CTA khẩn cấp/giá — `.btn-3d-red` (vd: "Tính báo giá ngay") |
| Xanh ngọc/teal `#00A0B0` (nút) / Xanh dương `#0091FF` (thương hiệu) | `--btn-blue-bg` / `--htsoft-blue` | `.btn-3d-blue`; xanh dương riêng cho logo/link thương hiệu |

**Card (`.card-3d`) và nút (`.btn-3d`) dùng 2 công thức khác nhau — đừng nhầm:**
- **Thẻ**: viền đen 2px + `box-shadow` offset cứng (không blur), hover dịch chuyển
  `translate(-3px,-3px)` và tăng bóng. Giữ nguyên phong cách neo-brutalist này cho mọi thẻ mới.
- **Nút**: khối 3D bóng cứng — nền màu phẳng (`background-color`, không gradient) + bóng đặc
  4px cùng tông nhưng đậm hơn ngay dưới nút (`box-shadow: 0 4px 0 var(--btn-*-shadow), 0 4px
  8px rgba(0,0,0,.15)`), bo góc nhẹ `border-radius: 6px`. Bấm xuống (`:active`) thì nút dịch
  xuống `top: 3px` (cần `position: relative` trên base) và bóng co lại còn 1px — mô phỏng cảm
  giác nút bị ấn lún vào bề mặt. Không có hiệu ứng hover riêng (chỉ có trạng thái nghỉ và
  bấm). Mỗi variant màu cần khai 2 biến `--btn-*-bg`/`--btn-*-shadow` (không tự sinh qua
  `color-mix()` nữa như bản trước — mã người dùng đưa chỉ định màu bóng thủ công cho từng
  màu). Class tên vẫn là `.btn-3d` (giữ nguyên để không phải sửa markup ở mọi trang) — xem
  comment đầu `style.css`. Đây là lần đổi kiểu nút thứ 5 (3D cứng ban đầu → phẳng Monday →
  pill bóng kính → chữ nhật bo nhẹ gradient → khối 3D bóng cứng hiện tại); nếu đổi tiếp, chỉ
  cần sửa trong khối "Nút bấm" của `style.css`, không phải sửa markup.

---

## Nội dung từng trang (map từ docs/CAUTAOWEB.docx — Giai đoạn 1)

| Trang | Nội dung | Ghi chú |
|---|---|---|
| `public/index.php` | Lưới **8 thẻ** sản phẩm — **đã chốt nội dung thật** (Admin cung cấp) | 4 mô-đun Dradnet gốc (Cống Tròn & Đúc Sẵn / Cống Hộp Đổ Tại Chỗ / Cầu Bản–Tràn Liên Hợp / Thiết Kế Hố Ga) + 4 sản phẩm mới (Thiết Kế Cầu Giản Đơn / Kiểm Toán Cầu Giản Đơn / Kiểm Toán Cầu Bản / Kiểm Toán Cống Hộp) |
| `public/mo-dun/*.php` (8 file, xem cây thư mục ở trên) | 3 khu vực: Tính năng / Gallery / Video | Đủ tính năng cốt lõi theo đúng nội dung Admin cung cấp cho từng sản phẩm |
| `public/mo-dun/dradnet.php` | Trang tổng quan Dradnet (bản cũ, 4 mục Cống/Hố ga từng là 1 dòng feature ở đây) | ⚠️ Đã bỏ mục nav "Sản phẩm" (trùng với lưới thẻ trang chủ) — trang này giờ không còn link nào trỏ tới, chỉ truy cập được qua URL trực tiếp. Có thể xoá hẳn nếu không cần dùng lại. |
| `public/bao-gia.php` | Checkbox mô-đun + slider số lượng/thời hạn | Logic tính tiền + API là việc của **Bạn B** (SV2) |
| `public/huong-dan.php` | Hub liệt kê **8 thẻ**, mỗi thẻ 2 nút "Xem hướng dẫn" (tự xem) + "Trực tuyến" (gặp KTV qua UltraView) + dòng chú thích nhỏ | Mỗi sản phẩm có hướng dẫn riêng — đặc tả gốc trong docx chỉ là phác thảo sơ bộ (roadmap chung), Admin đã chốt lại thành nội dung riêng từng sản phẩm |
| `public/huong-dan/*.php` (8 file) | Timeline 3 bước/sản phẩm, click 1 bước mở nội dung không chuyển trang | Nội dung bước hiện là placeholder do Claude soạn dựa trên tính năng đã mô tả — Admin/**Bạn C** (SV1) cần thay video/GIF thật (đánh dấu `TODO(SV1)` trong từng file) |
| `public/ho-tro-truc-tuyen.php` | Hướng dẫn gửi ID/Pass UltraView cho kỹ thuật viên | Đích của nút "Trực tuyến" — hotline `0905.88.78.68` đã điền, ⚠️ còn thiếu Zalo/link UltraView, đánh dấu `TODO(Admin)` |
| `public/dang-nhap.php` → `public/api/check-phone.php` | Luồng SĐT → có TK thì nhập mật khẩu, chưa có thì tạo mới + gửi Zalo/SMS | Việc của **Bạn B** (SV2), business logic ở `src/lib/Auth.php` |

---

## Phân công 3 người

**Tên thật ↔ vai trò:** Bạn B = Backend/Data, Bạn C = Frontend/UI. Trong code, các comment
`TODO(SV1)`/`TODO(SV2)` là nhãn vai trò cũ (SV1 = Frontend = Bạn C, SV2 = Backend = Bạn B),
chưa đổi tên lại trong từng file cho đỡ mất công sửa hàng loạt — cứ hiểu SV1→C, SV2→B.

### Admin (bạn)
- Sở hữu repo GitHub, review & merge Pull Request
- Chốt nội dung thật: danh sách mô-đun, mô tả, giá (`base_price` trong bảng `products`)
- Chọn/đăng ký tài khoản Zalo dùng cho ZCA, theo dõi rủi ro khoá tài khoản khi vận hành thật
- Quản lý domain `dradnet.vn` và hosting production

### Bạn C — Frontend/UI (nhãn `SV1` trong code/comment TODO)
- `public/index.php`, `public/mo-dun/*.php` (trang chi tiết mô-đun khác dựa theo mẫu `dradnet.php`)
- `public/huong-dan.php` + `public/huong-dan/*.php` (roadmap tương tác riêng từng mô-đun —
  thay nội dung bước/video placeholder bằng nội dung thật)
- Mọi thay đổi/thêm class mới trong `public/assets/css/style.css` — vì dùng chung toàn site,
  đổi ở đây ảnh hưởng mọi trang, nên tạo Pull Request riêng để Admin review, không tự ý sửa
  thẳng trên `main`

### Bạn B — Backend/Data (nhãn `SV2` trong code/comment TODO)
- `src/lib/Auth.php`, `src/lib/ZaloClient.php` (nối API ZCA thật), `public/api/*.php`
- `database/schema.sql` khi cần thêm bảng/cột — luôn cập nhật file này cùng lúc, không sửa
  CSDL production tay rồi quên đồng bộ lại schema
- `public/bao-gia.php` phần logic tính tiền + endpoint API tương ứng
- Hệ thống tín dụng (`src/lib/CreditService.php`) — xây API nạp tín dụng (chọn gói trong
  `credit_packages`), API trừ tín dụng khi khách dùng sản phẩm, trang tài khoản xem số dư +
  tải lịch sử (`credit_transactions`). **Cần làm session/đăng nhập giữ trạng thái trước** —
  hiện `dang-nhap.php` mới xác thực xong chứ chưa lưu `$_SESSION`, nên chưa có khái niệm
  "khách đã đăng nhập" ở các trang khác.
- `desktop_sync_logs`, đồng bộ desktop ↔ web

---

## Hệ thống tín dụng (Giai đoạn 2)

Thay cho mô hình thuê bao theo tháng (`duration_months`) mô tả ban đầu trong `CAUTAOWEB.docx`,
Admin đã chốt mô hình **tín dụng trả trước dùng chung mọi sản phẩm**:

- Khách mua 1 gói trong `credit_packages` (vd "Gói 100 tín dụng") → cộng vào
  `users.credit_balance` — **1 số dư duy nhất**, không có ví riêng theo từng sản phẩm.
- Mỗi sản phẩm có `products.credit_cost` riêng — số tín dụng bị trừ mỗi lần dùng sản phẩm đó
  (mức trừ khác nhau tuỳ sản phẩm, đúng theo yêu cầu).
- Mọi lần cộng/trừ đều ghi 1 dòng vào `credit_transactions` (sổ cái) — dùng để: (1) tính lại
  số dư nếu cần đối chiếu, (2) hiển thị/tải lịch sử sử dụng cho khách.
- `users.credit_balance` là **cache**, phải luôn khớp `SUM(credit_transactions.amount)` —
  **không bao giờ** `UPDATE users SET credit_balance = ...` trực tiếp ở nơi khác, luôn gọi
  `CreditService::topUp()` / `::consume()` (tự chạy trong 1 DB transaction, khoá dòng bằng
  `FOR UPDATE` để 2 request cùng lúc không làm sai số dư).
- Cảnh báo sắp hết tín dụng: `CreditService::isLowBalance()` so số dư với
  `users.low_credit_threshold` (NULL thì dùng ngưỡng mặc định 20, khai trong
  `CreditService::DEFAULT_LOW_THRESHOLD`). Hiển thị cảnh báo ở UI là việc của **Bạn C** (SV1).
- ⚠️ **Chưa xây**: trang tài khoản khách hàng (xem số dư, tải lịch sử) và cơ chế session giữ
  đăng nhập — cả 2 đều cần làm trước khi tính năng này dùng được thật.

---

## Quy trình Git

Nhánh làm việc:
- `feature/frontend-ui` — Bạn C
- `feature/backend-auth` — Bạn B

```bash
git checkout main
git pull origin main
git checkout -b feature/ten-nhanh
# ... code ...
git add .
git commit -m "Mô tả rõ thay đổi"
git push origin feature/ten-nhanh
```
Tạo Pull Request từ nhánh riêng → `main`, chờ Admin review trước khi merge. Không push thẳng
vào `main`.

---

## Quy ước code chung

- PHP thuần, không dùng framework — class nghiệp vụ đặt namespace `Htsoft\Lib\...` trong
  `src/lib/`, nạp qua autoloader thủ công ở `src/bootstrap.php` (không cần Composer).
- Không commit `.env` (chứa thông tin CSDL/Zalo thật) — copy từ `.env.example`.
- Mọi mật khẩu người dùng phải qua `password_hash()`/`password_verify()` (bcrypt), không bao
  giờ lưu plain text — xem mẫu trong `src/lib/Auth.php`.
- Ảnh để trong `public/assets/images/`, đặt tên không dấu, không khoảng trắng.
- Commit message rõ ràng, mô tả đúng việc đã làm (không dùng "update", "fix").

---

## Việc đầu tiên khi mở project bằng Claude Code

```
claude
```
rồi gõ `/init` để đối chiếu project hiện có với file này. Trước khi chạy thử:
1. `cp .env.example .env` rồi điền `DB_*` thật
2. Tạo database, chạy `database/schema.sql`
3. Chạy thử bằng PHP built-in server: `php -S localhost:8000 -t public`
