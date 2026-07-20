# HTSOFT Web — AI Agent Instructions

**Project**: Website HTSOFT (dradnet.vn) — PHP + MySQL e-commerce platform for engineering software.  
**Language**: Vietnamese (complete unicode/UTF-8 environment).  
**Stack**: PHP 7.4+ (no framework) + MySQL 8.0+, PDO + bcrypt auth, Zalo Cloud API.

---

## Quick Start

See [CLAUDE.md](CLAUDE.md) for full project spec. Key actions for new agents:

```bash
# Setup
cp .env.example .env          # Fill DB_HOST, DB_USER, DB_PASS, DB_NAME
mysql -u root < database/schema.sql
php -S localhost:8000 -t public

# Deploy directory structure (don't modify)
# - public/              ← webroot (document root)
# - src/                 ← PHP classes (not web-accessible)
# - database/            ← schema.sql
```

---

## Unicode & Internationalization (Critical)

This is a **Vietnamese-language project** — all product names, UI text, database content, and file names use Vietnamese characters (á, à, ả, ã, ạ, ă, ấ, ầ, ẩ, ẫ, ậ, etc.). Proper unicode handling is **not optional**.

### Encoding Checklist

- ✅ **HTML**: `<meta charset="UTF-8">` in `public/includes/header.php` (shared on all pages)
- ✅ **PHP files**: Save as UTF-8 (no BOM). All editors: set "UTF-8 without BOM"
- ✅ **Database**: `utf8mb4` charset + `utf8mb4_unicode_ci` collation on all tables (see `database/schema.sql`)
- ✅ **Connection**: PDO sets `charset=utf8mb4` in DSN (enforced in `src/lib/Database.php`)
- ✅ **PHP.ini**: `default_charset = utf-8`
- ✅ **File names**: No diacritics (use kebab-case: `cong-hop-do-tai-cho.php`, not `cộng_hộp_đổ_tại_chỗ.php`)
- ✅ **Form input**: Server validates Vietnamese phone (SĐT) format and sanitizes via `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`

### When Editing Vietnamese Content

- Use `htmlspecialchars($var, ENT_QUOTES, 'UTF-8')` for ALL user-generated or database content rendered in HTML (prevents XSS, preserves unicode)
- Use `htmlentities($var, ENT_QUOTES, 'UTF-8')` only if you need named entity encoding
- Never use `htmlspecialchars()` without the third parameter
- Database queries: Always use prepared statements (PDO `?` / `:name` placeholders) — never string concatenate Vietnamese text into SQL
- Example:
  ```php
  // ✅ CORRECT
  echo htmlspecialchars($productName, ENT_QUOTES, 'UTF-8');
  $stmt = $pdo->prepare("SELECT * FROM products WHERE product_name = ?");
  $stmt->execute([$vietnameseProductName]);
  
  // ❌ WRONG
  echo $productName;  // XSS risk if contains <
  echo "SELECT * FROM products WHERE product_name = '$vietnameseProductName'";  // SQL injection
  ```

---

## Project Structure & Conventions

### Public Webroot

All user-facing files in `public/` — server must point document root here:

- **Pages**: `index.php`, `dang-nhap.php`, `bao-gia.php`, `huong-dan.php` (hub), `ho-tro-truc-tuyen.php`
- **Product modules**: `public/mo-dun/*.php` (8 product detail pages)
- **Tutorials**: `public/huong-dan/*.php` (8 pages, 1-1 with modules)
- **API**: `public/api/*.php` (endpoints: `check-phone.php` for registration/login)
- **Assets**: CSS, JS, images in `public/assets/`
- **Template fragments**: `public/includes/header.php`, `footer.php` (shared by all pages — do NOT duplicate HTML)

### Shared Header & Footer

**Do not copy-paste HTML.** Every page must:
```php
<?php
require __DIR__ . '/includes/header.php';
// ... page content ...
require __DIR__ . '/includes/footer.php';
```

This ensures consistent branding, charset declaration, and topbar/footer behavior across all 17 pages.

### Source (Non-Web-Accessible)

```
src/
  bootstrap.php           ← Manual autoloader (Htsoft\Lib\*, Htsoft\Model\*)
  config/database.php     ← PDO config (reads .env)
  lib/
    Database.php          ← PDO singleton
    Auth.php              ← Login flow (phone → password or new account)
    ZaloClient.php        ← OTP send via Zalo ZCA (⚠️ risk: account lockout)
    CreditService.php     ← Credit topup/consume/balance (single source of truth)
    InsufficientCreditException.php
  models/                 ← (to be added as needed)
```

### Asset Management

**CSS**: `public/assets/css/style.css` — **shared by all pages**, so changes here affect the whole site.
- Review design spec in [CLAUDE.md](CLAUDE.md) before modifying: 3D card style, button styles, color scheme
- Create PR for CSS changes; Admin reviews before merge
- Do NOT inline styles in HTML

**Images**: `public/assets/images/` — use kebab-case filenames, no diacritics.

**JavaScript**: `public/assets/js/main.js` — minimal, vanilla JS only (no jQuery/framework).

---

## Database & Credit System

### Schema Location

See `database/schema.sql` — **source of truth**. After any schema change, commit the updated `.sql` file.

### Credit System (Core Business Logic)

The platform uses a **prepaid credit model** (not monthly subscriptions):

- **One wallet per user**: `users.credit_balance` (shared across all products)
- **Each product has a cost**: `products.credit_cost` = number of credits deducted per use
- **Immutable ledger**: `credit_transactions` (all operations logged for audit/history)
- **Always use** `CreditService::topUp()` / `::consume()` — never `UPDATE users SET credit_balance` elsewhere
  - Enforces atomic transactions (`FOR UPDATE` row lock)
  - Maintains ledger consistency (audit trail)
  - Raises `InsufficientCreditException` if balance < cost

Example:
```php
// ✅ CORRECT
$creditService->consume($userId, $productId, $productCost);

// ❌ WRONG
$stmt = $pdo->prepare("UPDATE users SET credit_balance = credit_balance - ? WHERE id = ?");
$stmt->execute([$cost, $userId]);  // Loses audit trail, race condition risk
```

### Charset Enforcement

All tables use `utf8mb4` charset. PDO connection in `Database.php` appends `charset=utf8mb4` to DSN.  
**Do NOT assume** the server defaults to `utf8mb4` — always verify connection charset in code.

---

## Design System

### Colors (Fixed, Do Not Change)

| Role | Hex | CSS Var | Usage |
|------|-----|---------|-------|
| Primary CTA | `#FFCA36` / `#FFD700` | `--btn-yellow-bg` / `--bamboo-gold` | "Xem chi tiết", main action |
| Confirmation | `#2E7D32` | `--bamboo-green` / `--btn-green-bg` | "Đã chọn", tick marks |
| Urgent/Price | `#F05431` / `#E5484D` | `--btn-red-bg` / `--danger-red` | "Tính báo giá ngay" |
| Brand | `#0091FF` | `--htsoft-blue` | Logo, brand accent |
| Interactive button | `#00A0B0` | `--btn-blue-bg` | Secondary CTA |

### Button Style (`.btn-3d`)

- **Base state**: Flat 2D block with solid color `background-color` (no gradients), 4px hard shadow below
- **Active state** (`:active`): Press down `top: 3px`, shadow reduces to 1px (tactile feedback)
- **No hover effects** — only idle & active states
- **Border radius**: `6px` (subtle)
- **Markup**: Use class name `.btn-3d` for all buttons; CSS contains all variants

See `public/assets/css/style.css` "Nút bấm" section for implementation.

### Card Style (`.card-3d`)

- **Neo-brutalist**: 2px black border + hard offset shadow, no blur
- **Hover**: Translate `-3px, -3px`, increase shadow (lifts card)
- **Padding**: 20px internal spacing, consistent across all cards

---

## Authentication & Sessions

### Current State (Giai đoạn 1)

- **Login endpoint**: `public/api/check-phone.php`
  - Accepts POST `phone_number`
  - Returns: "account_exists" or "account_created"
  - Sends OTP via Zalo (⚠️ see `ZaloClient.php` for account lockout risks)

- **Session**: ⚠️ **NOT YET IMPLEMENTED** — `/TODO(SV2)` in `Auth.php`
  - Need to set `$_SESSION['user_id']` after successful password entry
  - Protects pages like account dashboard, product usage history

### For Future: Session Middleware

Once `$_SESSION['user_id']` is set:
```php
// At top of protected page
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /dang-nhap.php');
    exit;
}
$userId = $_SESSION['user_id'];
```

---

## File Naming & URL Patterns

- **File names**: kebab-case, no diacritics, `.php` extension
  - ✅ `cong-hop-do-tai-cho.php` → URL `/mo-dun/cong-hop-do-tai-cho.php`
  - ❌ `công_hộp_đổ_tại_chỗ.php` (diacritics), `CongHopDoTaiCho.php` (CamelCase)
- **URLs**: Reflect file structure, human-readable via kebab-case
- **Database**: Product/module names stored as-is with full Vietnamese text (for display)

---

## Git Workflow

See [CLAUDE.md](CLAUDE.md#quy-trình-git) for branch strategy.

**Branches**:
- `feature/frontend-ui` — Student 1 (SV1)
- `feature/backend-auth` — Student 2 (SV2)
- `main` — stable, reviewed by Admin

**PR Template** (implicit):
1. Clear commit message: "Add login form styling" (not "update", "fix")
2. One logical change per PR
3. Admin reviews & merges (no direct pushes to `main`)

**Code style**:
- Namespace classes: `Htsoft\Lib\ClassName`
- PSR-2 indent: 4 spaces (not tabs, not 2-space)
- No Composer — manual autoloader in `src/bootstrap.php`

---

## Common Tasks

### Add a New Product Module Page

1. Create `public/mo-dun/new-module-name.php` (copy template from `dradnet.php`)
2. Add corresponding tutorial: `public/huong-dan/new-module-name.php`
3. Update `public/index.php` `$modules` array to link the new card
4. Update `public/huong-dan.php` to add new module card in hub
5. Update `database/schema.sql` if adding new `products` row (coordinate with Admin)
6. Test URLs: `/mo-dun/new-module-name.php` and `/huong-dan/new-module-name.php`

### Modify Shared CSS

1. Edit `public/assets/css/style.css`
2. Test on all 8 product pages + 8 tutorials to ensure no breakage
3. Create PR for review (Admin decides if change is good for whole site)

### Add Database Functionality

1. Update `database/schema.sql` with new table/column
2. Update migration notes in schema comments
3. Add corresponding PHP class in `src/lib/` or `src/models/`
4. Update `src/bootstrap.php` autoloader if adding new namespace
5. Commit both schema and PHP files together

---

## Troubleshooting

### Character Encoding Issues (Vietnamese text garbled)

- Check HTML has `<meta charset="UTF-8">`
- Check DB connection: `charset=utf8mb4` in PDO DSN
- Check table charset: `SHOW CREATE TABLE table_name;` should show `utf8mb4`
- Check PHP output: `header('Content-Type: text/html; charset=utf-8');` at top if setting headers manually
- Check file saved as UTF-8 (no BOM in editor settings)

### SQL Injection / XSS in Vietnamese Content

- Always use prepared statements for DB queries
- Always use `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')` when echoing user/DB content
- Never trust `$_GET`, `$_POST`, or database values — treat as untrusted input

### Missing .env File

- Copy `.env.example` → `.env`
- Fill `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`
- Restart PHP server: `php -S localhost:8000 -t public`

---

## Key Files Reference

| File | Purpose |
|------|---------|
| [CLAUDE.md](CLAUDE.md) | Full spec (source of truth for disputes) |
| [public/includes/header.php](public/includes/header.php) | Shared `<head>` + topbar (do NOT duplicate) |
| [public/includes/footer.php](public/includes/footer.php) | Shared footer + CTA (do NOT duplicate) |
| [public/assets/css/style.css](public/assets/css/style.css) | Shared styles (review before modifying) |
| [src/lib/Database.php](src/lib/Database.php) | PDO singleton with `utf8mb4` enforced |
| [src/lib/CreditService.php](src/lib/CreditService.php) | Credit operations (source of truth for balance) |
| [src/lib/Auth.php](src/lib/Auth.php) | Login logic (WIP: session integration) |
| [database/schema.sql](database/schema.sql) | Database schema (commit all changes) |
| [.env.example](.env.example) | Template for local `.env` (not `.env` itself) |

---

## When You're Stuck

1. **Design questions**: Refer to [CLAUDE.md](CLAUDE.md) "Hệ thống thiết kế" section
2. **Database questions**: See `database/schema.sql` comments & [CLAUDE.md](CLAUDE.md) "Hệ thống tín dụng"
3. **Unicode questions**: This section above + `src/lib/Database.php` PDO setup
4. **Deployment**: Reach out to Admin (owns `dradnet.vn` domain)
5. **API/Zalo**: See `src/lib/ZaloClient.php` for warnings & TODOs

---

**Last updated**: 2026-07-17  
**Maintained by**: Admin + SV1 (Frontend) + SV2 (Backend)
