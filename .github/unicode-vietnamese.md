# Unicode & Vietnamese Language Handling

**When to use this**: Any task involving Vietnamese text, form input, database queries, or character encoding in the HTSOFT Web project.

## Quick Reference

| Task | Tool | Example |
|------|------|---------|
| Display Vietnamese text in HTML | `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')` | `<?= htmlspecialchars($productName, ENT_QUOTES, 'UTF-8'); ?>` |
| Query DB with Vietnamese string | PDO prepared statements | `$stmt->execute([$vietnameseString])` |
| Save file with Vietnamese chars | UTF-8 without BOM | Editor: File → Save with Encoding → UTF-8 |
| Check DB table charset | MySQL client | `SHOW CREATE TABLE users;` → expect `utf8mb4` |
| Verify file encoding | Terminal | `file -i filename.php` → expect `utf-8` |

## Problem: "Kí tự lạ" / Garbled Vietnamese Characters

**Symptoms**: Vietnamese text appears as `ï»¿`, `Ã©`, `Ã±`, or replacement characters.

**Diagnosis checklist**:
1. ✅ HTML has `<meta charset="UTF-8">` → should be in `public/includes/header.php`
2. ✅ PHP files saved as UTF-8 (no BOM) → editor settings
3. ✅ Database tables: `CHARSET=utf8mb4` → run `SHOW CREATE TABLE table_name;`
4. ✅ PDO connection: `charset=utf8mb4` in DSN → check `src/lib/Database.php`
5. ✅ Prepared statements used → no string concatenation with Vietnamese into SQL

**Fix order** (test after each):
- If HTML shows garbled: fix meta charset
- If form submission shows garbled: ensure PDO has `charset=utf8mb4`
- If database stores garbled: recreate table with `utf8mb4` charset, then re-insert data
- If file saved with wrong encoding: re-save as UTF-8 without BOM, re-commit

## Problem: XSS / SQL Injection via Vietnamese Input

**Example attack**: Form accepts `Cộng hộp` → attacker injects `<script>alert('XSS')</script>`

**Prevention**:
```php
// ✅ SAFE: htmlspecialchars + PDO prepared statement
$productName = $_POST['product_name']; // untrusted input
echo htmlspecialchars($productName, ENT_QUOTES, 'UTF-8'); // XSS prevention
$stmt = $pdo->prepare("INSERT INTO products (product_name) VALUES (?)");
$stmt->execute([$productName]); // SQL injection prevention
```

```php
// ❌ UNSAFE: no escaping + string concatenation
echo $_POST['product_name']; // XSS hole
echo "INSERT INTO products VALUES ('$_POST[product_name]')"; // SQL injection hole
```

## Encoding Requirements by Layer

### HTML / Browser
- `<html lang="vi">` declares Vietnamese language
- `<meta charset="UTF-8">` must appear before any content
- All Vietnamese text in HTML markup must be UTF-8 encoded

### PHP Source Files
- Save as **UTF-8 without BOM** (critical)
- VS Code: `File → Save with Encoding → UTF-8` (verify status bar shows "UTF-8" not "UTF-8 with BOM")
- Sublime: `File → Set File Encoding → UTF-8`
- File check: `file -i filename.php` should output `charset=utf-8`

### Database Connection
- PDO DSN must include `charset=utf8mb4`
- Example: `mysql:host=127.0.0.1;dbname=htsoft_web;charset=utf8mb4`
- See `src/lib/Database.php` for implementation
- Test: `SELECT @@character_set_client, @@character_set_connection;` should both be `utf8mb4`

### Database Tables & Columns
- All tables: `CREATE TABLE ... DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;`
- All varchar/text columns: inherit table charset by default (don't override per-column)
- Existing tables: `ALTER TABLE table_name CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`
- Test: `SHOW CREATE TABLE table_name;` must show `utf8mb4`

### Form Input (POST/GET)
- Browser auto-detects charset from `<meta charset="UTF-8">`
- `$_POST['field']` arrives as UTF-8 bytes (PHP 5.4+ default)
- Validate length with `mb_strlen($var)` not `strlen($var)` (Vietnamese chars are multi-byte)
  ```php
  if (mb_strlen($productName, 'UTF-8') > 150) {
      die('Tên sản phẩm quá dài');
  }
  ```

## Vietnamese Phone Numbers (SĐT)

The login system validates Vietnamese phone numbers. Format:
- Valid: `0905887868`, `0-905-887-868`, `+84905887868`
- Invalid: `+1-234-567-8900` (not Vietnamese country code)

When storing, normalize to digits only: `0905887868` (10 digits, starts with 0).

Regex pattern for validation:
```php
if (!preg_match('/^0\d{9}$/', $normalizedPhone)) {
    die('SĐT không hợp lệ');
}
```

## Filename Conventions

**Do NOT use diacritics in filenames** — this avoids encoding issues across systems.

- ✅ `cong-hop-do-tai-cho.php` (kebab-case, no diacritics)
- ❌ `cộng_hộp_đổ_tại_chỗ.php` (diacritics cause path encoding issues)
- ❌ `CongHopDoTaiCho.php` (CamelCase breaks URL conventions)

Database content (product names, descriptions) **can use full Vietnamese** — store as UTF-8, display via `htmlspecialchars()`.

## Examples

### ✅ Correct: Vietnamese Product Name in Form

```php
<?php
// page: public/mo-dun/cong-hop-do-tai-cho.php
$pageTitle = 'Cống Hộp Đổ Tại Chỗ';  // UTF-8 file, Vietnamese title OK
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    ...
</head>
<body>
    <h1><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
    ...
</body>
</html>
```

### ✅ Correct: Vietnamese Product Name from Database

```php
<?php
require_once __DIR__ . '/../../src/bootstrap.php';

$pdo = Database::getInstance()->getConnection();
$stmt = $pdo->prepare("SELECT product_name FROM products WHERE id = ?");
$stmt->execute([1]);
$product = $stmt->fetch();

echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8');
?>
```

### ✅ Correct: Form Submission with Vietnamese Input

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = preg_replace('/\D/', '', $_POST['phone'] ?? '');
    
    if (!preg_match('/^0\d{9}$/', $phone)) {
        die('SĐT không hợp lệ (vd: 0905887868)');
    }
    
    // Use prepared statement — never string concatenate
    $stmt = $pdo->prepare("INSERT INTO users (phone_number) VALUES (?)");
    $stmt->execute([$phone]);
}
?>
```

### ❌ Incorrect: Garbled Vietnamese

```php
<?php
// ❌ File saved as ISO-8859-1, not UTF-8
$name = 'Cộng hộp';  // Appears as garbage in browser

// ❌ No htmlspecialchars → XSS hole
echo $_POST['name'];

// ❌ String concatenation → SQL injection
$sql = "SELECT * FROM products WHERE name = '" . $_POST['name'] . "'";
?>
```

## Testing Vietnamese Content

### Checklist Before Commit

- [ ] File saved as UTF-8 (no BOM)
- [ ] All `<meta charset="UTF-8">` present in page
- [ ] All database content rendered with `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`
- [ ] All DB queries use prepared statements (no string interpolation)
- [ ] Database tables have `CHARSET=utf8mb4`
- [ ] PDO connection includes `charset=utf8mb4`
- [ ] Vietnamese text displays correctly in browser (no replacement chars)
- [ ] Vietnamese text in form submission preserved correctly after POST
- [ ] `file -i filename.php` returns `charset=utf-8` (not `charset=iso-8859-1`)

### Manual Test

```bash
# Check file encoding
file -i public/mo-dun/cong-hop-do-tai-cho.php
# Expected: charset=utf-8

# Check database table charset
mysql -u root -p < database/schema.sql
mysql -u root -p htsoft_web
mysql> SHOW CREATE TABLE products;
# Expected: DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci

# Check PDO connection charset
php -r "
  require 'src/bootstrap.php';
  \$pdo = \Htsoft\Lib\Database::getInstance()->getConnection();
  \$result = \$pdo->query('SELECT @@character_set_client, @@character_set_connection;')->fetch();
  print_r(\$result);
"
# Expected: both should be utf8mb4
```

## References

- HTML spec: https://html.spec.whatwg.org/#encoding-declaration
- UTF-8 in PHP: https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double-quote
- PDO UTF-8: https://wiki.php.net/rfc/mysqli-utf8mb4
- MySQL charset: https://dev.mysql.com/doc/refman/8.0/en/charset.html
