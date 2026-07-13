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
  index.php                    ← Trang chủ, lưới 4 thẻ mô-đun
  bao-gia.php                  ← Bộ tính báo giá
  huong-dan.php                ← Hub hướng dẫn — mỗi thẻ có 2 nút: Xem hướng dẫn / Trực tuyến
  ho-tro-truc-tuyen.php        ← Hướng dẫn gửi ID/Pass UltraView cho KTV — TODO(Admin) hotline/Zalo thật
  dang-nhap.php                ← Form đăng nhập bằng SĐT
  mo-dun/
    dradnet.php                ← Mẫu chuẩn trang chi tiết 1 mô-đun (Features/Gallery/Video)
  huong-dan/
    cong-tron-cong-hop-duc-san.php   ← Hướng dẫn riêng mô-đun 1 (roadmap 3 bước, click mở)
    cong-hop-do-tai-cho.php           ← Hướng dẫn riêng mô-đun 2
    cau-ban-cong-ban-tran-lien-hop.php ← Hướng dẫn riêng mô-đun 3
    thiet-ke-ho-ga.php                ← Hướng dẫn riêng mô-đun 4
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
  models/                       ← (chưa có file — thêm khi cần, đừng tạo class rỗng trước)

database/
  schema.sql                   ← 4 bảng: users, products, subscriptions, desktop_sync_logs

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
| `public/index.php` | Lưới 4 thẻ mô-đun Dradnet — **đã chốt nội dung thật** (Admin cung cấp) | Cống Tròn & Đúc Sẵn / Cống Hộp Đổ Tại Chỗ / Cầu Bản–Tràn Liên Hợp / Thiết Kế Hố Ga |
| `public/mo-dun/cong-tron-cong-hop-duc-san.php` | 3 khu vực: Tính năng / Gallery / Video | Mô-đun 1, đủ 5 tính năng cốt lõi |
| `public/mo-dun/cong-hop-do-tai-cho.php` | 3 khu vực: Tính năng / Gallery / Video | Mô-đun 2, đủ 5 tính năng cốt lõi |
| `public/mo-dun/cau-ban-cong-ban-tran-lien-hop.php` | 3 khu vực: Tính năng / Gallery / Video | Mô-đun 3, đủ 4 tính năng cốt lõi |
| `public/mo-dun/thiet-ke-ho-ga.php` | 3 khu vực: Tính năng / Gallery / Video | Mô-đun 4, đủ 5 tính năng cốt lõi |
| `public/mo-dun/dradnet.php` | Trang tổng quan Dradnet (bản cũ, 4 mục trên từng là 1 dòng feature ở đây) | ⚠️ Đã bỏ mục nav "Sản phẩm" (trùng với lưới 4 thẻ trang chủ) — trang này giờ không còn link nào trỏ tới, chỉ truy cập được qua URL trực tiếp. Có thể xoá hẳn nếu không cần dùng lại. |
| `public/bao-gia.php` | Checkbox mô-đun + slider số lượng/thời hạn | Logic tính tiền + API là việc của SV2 |
| `public/huong-dan.php` | Hub liệt kê 4 thẻ, mỗi thẻ 2 nút "Xem hướng dẫn" (tự xem) + "Trực tuyến" (gặp KTV qua UltraView) + dòng chú thích nhỏ | Mỗi mô-đun có hướng dẫn riêng — đặc tả gốc trong docx chỉ là phác thảo sơ bộ (roadmap chung), Admin đã chốt lại thành nội dung riêng từng mô-đun |
| `public/huong-dan/*.php` (4 file) | Timeline 3 bước/mô-đun, click 1 bước mở nội dung không chuyển trang | Nội dung bước hiện là placeholder do Claude soạn dựa trên tính năng đã mô tả — Admin/SV1 cần thay video/GIF thật (đánh dấu `TODO(SV1)` trong từng file) |
| `public/ho-tro-truc-tuyen.php` | Hướng dẫn gửi ID/Pass UltraView cho kỹ thuật viên | Đích của nút "Trực tuyến" — ⚠️ chưa có hotline/Zalo thật, đánh dấu `TODO(Admin)` |
| `public/dang-nhap.php` → `public/api/check-phone.php` | Luồng SĐT → có TK thì nhập mật khẩu, chưa có thì tạo mới + gửi Zalo/SMS | Việc của SV2, business logic ở `src/lib/Auth.php` |

---

## Phân công 3 người

### Admin (bạn)
- Sở hữu repo GitHub, review & merge Pull Request
- Chốt nội dung thật: danh sách mô-đun, mô tả, giá (`base_price` trong bảng `products`)
- Chọn/đăng ký tài khoản Zalo dùng cho ZCA, theo dõi rủi ro khoá tài khoản khi vận hành thật
- Quản lý domain `dradnet.vn` và hosting production

### Sinh viên 1 — Frontend/UI
- `public/index.php`, `public/mo-dun/*.php` (trang chi tiết mô-đun khác dựa theo mẫu `dradnet.php`)
- `public/huong-dan.php` + `public/huong-dan/*.php` (roadmap tương tác riêng từng mô-đun —
  thay nội dung bước/video placeholder bằng nội dung thật)
- Mọi thay đổi/thêm class mới trong `public/assets/css/style.css` — vì dùng chung toàn site,
  đổi ở đây ảnh hưởng mọi trang, nên tạo Pull Request riêng để Admin review, không tự ý sửa
  thẳng trên `main`

### Sinh viên 2 — Backend/Data
- `src/lib/Auth.php`, `src/lib/ZaloClient.php` (nối API ZCA thật), `public/api/*.php`
- `database/schema.sql` khi cần thêm bảng/cột — luôn cập nhật file này cùng lúc, không sửa
  CSDL production tay rồi quên đồng bộ lại schema
- `public/bao-gia.php` phần logic tính tiền + endpoint API tương ứng
- Giai đoạn 2: `subscriptions`, `desktop_sync_logs`, đồng bộ desktop ↔ web

---

## Quy trình Git

Nhánh làm việc:
- `feature/frontend-ui` — Sinh viên 1
- `feature/backend-auth` — Sinh viên 2

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
