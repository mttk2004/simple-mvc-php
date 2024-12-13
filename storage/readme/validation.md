## **Hướng dẫn sử dụng Respect\Validation**

**Respect\Validation** là một thư viện validation mạnh mẽ và linh hoạt trong PHP, giúp bạn xác thực dữ liệu đầu vào một cách dễ dàng và hiệu quả. Dưới đây là hướng dẫn chi tiết về cách sử dụng `Respect\Validation` cho người mới bắt đầu.

---

### **1. Cài đặt Respect\Validation**

Đầu tiên, bạn cần cài đặt thư viện `Respect\Validation` thông qua Composer:

```bash
composer require respect/validation
```

Sau khi cài đặt xong, bạn có thể bắt đầu sử dụng thư viện này trong dự án của mình.

---

### **2. Các khái niệm cơ bản**

Trước khi đi vào chi tiết, hãy hiểu một số khái niệm cơ bản:

- **Validator (Bộ xác thực):** Là một đối tượng đại diện cho một quy tắc validation.
- **Rule (Quy tắc):** Là một quy tắc cụ thể để xác thực dữ liệu (ví dụ: kiểm tra email, số nguyên, URL, v.v.).
- **Assertion (Khẳng định):** Là một phương thức để kiểm tra dữ liệu có hợp lệ hay không.

---

### **3. Cách sử dụng cơ bản**

#### **a. Kiểm tra email**

```php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$email = 'example@example.com';
$emailValidator = v::email();

if ($emailValidator->validate($email)) {
    echo "Email hợp lệ!";
} else {
    echo "Email không hợp lệ!";
}
```

Kết quả:
```
Email hợp lệ!
```

---

#### **b. Kiểm tra số nguyên**

```php
$number = 123;
$numberValidator = v::intVal();

if ($numberValidator->validate($number)) {
    echo "Số nguyên hợp lệ!";
} else {
    echo "Số nguyên không hợp lệ!";
}
```

Kết quả:
```
Số nguyên hợp lệ!
```

---

#### **c. Kiểm tra URL**

```php
$url = 'https://example.com';
$urlValidator = v::url();

if ($urlValidator->validate($url)) {
    echo "URL hợp lệ!";
} else {
    echo "URL không hợp lệ!";
}
```

Kết quả:
```
URL hợp lệ!
```

---

### **4. Kết hợp nhiều quy tắc validation**

Bạn có thể kết hợp nhiều quy tắc validation để tạo ra các kiểm tra phức tạp:

```php
$username = 'user123';
$usernameValidator = v::alnum()->noWhitespace()->length(3, 10);

if ($usernameValidator->validate($username)) {
    echo "Username hợp lệ!";
} else {
    echo "Username không hợp lệ!";
}
```

Kết quả:
```
Username hợp lệ!
```

**Giải thích:**
- `alnum()`: Kiểm tra chuỗi chỉ chứa chữ cái và số.
- `noWhitespace()`: Kiểm tra chuỗi không chứa khoảng trắng.
- `length(3, 10)`: Kiểm tra độ dài chuỗi từ 3 đến 10 ký tự.

---

### **5. Validation cho mảng**

Bạn có thể sử dụng Respect\Validation để kiểm tra các mảng dữ liệu:

```php
$data = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'age' => 25
];

$validator = v::key('name', v::stringType()->length(1, 50))
              ->key('email', v::email())
              ->key('age', v::intVal()->between(18, 100));

if ($validator->validate($data)) {
    echo "Dữ liệu hợp lệ!";
} else {
    echo "Dữ liệu không hợp lệ!";
}
```

Kết quả:
```
Dữ liệu hợp lệ!
```

---

### **6. Tạo quy tắc validation tùy chỉnh**

Nếu bạn cần một quy tắc validation không có sẵn, bạn có thể tạo quy tắc tùy chỉnh:

```php
use Respect\Validation\Rules\AbstractRule;

class ContainsHello extends AbstractRule
{
    public function validate($input)
    {
        return strpos($input, 'hello') !== false;
    }
}

$customValidator = new ContainsHello();

if ($customValidator->validate('hello world')) {
    echo "Chuỗi chứa 'hello'!";
} else {
    echo "Chuỗi không chứa 'hello'!";
}
```

Kết quả:
```
Chuỗi chứa 'hello'!
```

---

### **7. Báo lỗi chi tiết**

Respect\Validation cung cấp thông báo lỗi chi tiết, giúp bạn dễ dàng xác định vấn đề:

```php
$username = 'user@123';
$usernameValidator = v::alnum()->noWhitespace()->length(3, 10);

try {
    $usernameValidator->assert($username);
} catch (\Respect\Validation\Exceptions\ValidationException $e) {
    echo $e->getFullMessage();
}
```

Kết quả:
```
- "user@123" must contain only letters (a-z) and digits (0-9)
```

---

### **8. Sử dụng nhiều quy tắc với `allOf`**

Bạn có thể sử dụng `allOf` để kết hợp nhiều quy tắc:

```php
$validator = v::allOf(
    v::stringType(),
    v::length(5, 20),
    v::noWhitespace()
);

if ($validator->validate('hello123')) {
    echo "Chuỗi hợp lệ!";
} else {
    echo "Chuỗi không hợp lệ!";
}
```

Kết quả:
```
Chuỗi hợp lệ!
```

---

### **9. Sử dụng `not` để phủ định quy tắc**

Bạn có thể sử dụng `not` để phủ định một quy tắc:

```php
$validator = v::not(v::intVal());

if ($validator->validate('abc')) {
    echo "Không phải số nguyên!";
} else {
    echo "Là số nguyên!";
}
```

Kết quả:
```
Không phải số nguyên!
```

---

### **10. Tổng kết**

Respect\Validation là một thư viện mạnh mẽ và linh hoạt để xác thực dữ liệu trong PHP. Nó giúp bạn tạo các quy tắc validation đơn giản hoặc phức tạp, đồng thời cung cấp thông báo lỗi chi tiết để dễ dàng xác định vấn đề. Dưới đây là các bước cơ bản để bắt đầu:

1. Cài đặt thư viện qua Composer.
2. Sử dụng các quy tắc validation tiêu chuẩn như `email`, `intVal`, `url`.
3. Kết hợp nhiều quy tắc với `allOf`.
4. Tạo quy tắc validation tùy chỉnh.
5. Sử dụng `assert` để báo lỗi chi tiết.