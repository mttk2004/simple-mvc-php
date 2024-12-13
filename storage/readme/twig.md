## **Hướng dẫn sử dụng Twig**

Chắc chắn rồi! **Twig** là một template engine mạnh mẽ và linh hoạt, được viết bằng PHP. Nó giúp bạn tách biệt phần logic ứng dụng khỏi phần hiển thị (view), giúp code dễ đọc, dễ bảo trì hơn. Dưới đây là hướng dẫn chi tiết về cách sử dụng Twig cho người mới bắt đầu.

---

### **1. Cài đặt Twig**

Đầu tiên, bạn cần cài đặt Twig thông qua Composer:

```bash
composer require "twig/twig:^3.0"
```

Sau khi cài đặt xong, bạn có thể bắt đầu sử dụng Twig trong dự án của mình.

---

### **2. Cấu hình Twig**

Để sử dụng Twig, bạn cần cấu hình nó để biết nơi lưu trữ các file template và các tùy chọn khác.

#### **Ví dụ cấu hình Twig:**

```php
require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Thư mục chứa các file template
$loader = new FilesystemLoader(__DIR__ . '/templates');

// Khởi tạo Twig
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/cache', // Thư mục chứa cache (tùy chọn)
    'debug' => true, // Bật chế độ debug (tùy chọn)
]);
```

Trong ví dụ trên:
- `FilesystemLoader`: Chỉ định thư mục chứa các file template.
- `Environment`: Khởi tạo Twig với các tùy chọn như cache và debug.

---

### **3. Tạo file template**

Twig sử dụng các file template để hiển thị dữ liệu. File template có thể được viết bằng cú pháp Twig hoặc HTML.

#### **Ví dụ file template (`templates/index.html.twig`):**

```twig
<!DOCTYPE html>
<html>
<head>
    <title>{{ title }}</title>
</head>
<body>
    <h1>{{ heading }}</h1>
    <p>{{ content }}</p>
</body>
</html>
```

Trong ví dụ trên:
- `{{ title }}`, `{{ heading }}`, `{{ content }}`: Là các biến sẽ được truyền từ PHP.

---

### **4. Render template**

Để hiển thị template, bạn cần render nó với dữ liệu tương ứng.

#### **Ví dụ render template:**

```php
// Dữ liệu truyền vào template
$data = [
    'title' => 'Trang chủ',
    'heading' => 'Chào mừng đến với Twig!',
    'content' => 'Đây là nội dung trang chủ.'
];

// Render template và hiển thị
echo $twig->render('index.html.twig', $data);
```

Kết quả:
```html
<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
</head>
<body>
    <h1>Chào mừng đến với Twig!</h1>
    <p>Đây là nội dung trang chủ.</p>
</body>
</html>
```

---

### **5. Các tính năng cơ bản của Twig**

#### **a. Biến (Variables)**

Bạn có thể truyền biến từ PHP vào template và hiển thị chúng bằng cú pháp `{{ variable }}`.

```twig
<p>Xin chào, {{ name }}!</p>
```

#### **b. Câu lệnh điều kiện (Conditions)**

Bạn có thể sử dụng câu lệnh điều kiện để hiển thị nội dung phụ thuộc vào điều kiện.

```twig
{% if is_logged_in %}
    <p>Chào mừng bạn đã đăng nhập!</p>
{% else %}
    <p>Vui lòng đăng nhập.</p>
{% endif %}
```

#### **c. Vòng lặp (Loops)**

Bạn có thể sử dụng vòng lặp để lặp qua một mảng hoặc danh sách.

```twig
<ul>
    {% for item in items %}
        <li>{{ item }}</li>
    {% endfor %}
</ul>
```

#### **d. Kế thừa layout (Template Inheritance)**

Twig hỗ trợ kế thừa layout, giúp bạn tái sử dụng code dễ dàng hơn.

##### **File layout (`templates/layout.html.twig`):**

```twig
<!DOCTYPE html>
<html>
<head>
    <title>{% block title %}Default Title{% endblock %}</title>
</head>
<body>
    <header>
        <h1>Header</h1>
    </header>
    <main>
        {% block content %}{% endblock %}
    </main>
    <footer>
        <p>Footer</p>
    </footer>
</body>
</html>
```

##### **File template kế thừa (`templates/home.html.twig`):**

```twig
{% extends "layout.html.twig" %}

{% block title %}Trang chủ{% endblock %}

{% block content %}
    <h1>Chào mừng đến với trang chủ!</h1>
    <p>Đây là nội dung trang chủ.</p>
{% endblock %}
```

##### **Render template kế thừa:**

```php
echo $twig->render('home.html.twig');
```

Kết quả:
```html
<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
</head>
<body>
    <header>
        <h1>Header</h1>
    </header>
    <main>
        <h1>Chào mừng đến với trang chủ!</h1>
        <p>Đây là nội dung trang chủ.</p>
    </main>
    <footer>
        <p>Footer</p>
    </footer>
</body>
</html>
```

---

### **6. Các hàm và filter tiện ích**

Twig cung cấp nhiều hàm và filter tiện ích để xử lý dữ liệu.

#### **a. Filter**

Filter được sử dụng để biến đổi dữ liệu.

```twig
<p>{{ "hello world"|upper }}</p> <!-- Kết quả: HELLO WORLD -->
<p>{{ "hello world"|lower }}</p> <!-- Kết quả: hello world -->
<p>{{ "hello world"|length }}</p> <!-- Kết quả: 11 -->
```

#### **b. Hàm**

Twig cung cấp nhiều hàm tiện ích như `range`, `date`, `dump`, v.v.

```twig
<p>{{ date()|date("Y-m-d H:i:s") }}</p> <!-- Kết quả: Ngày giờ hiện tại -->
<p>{{ random(1, 100) }}</p> <!-- Kết quả: Số ngẫu nhiên từ 1 đến 100 -->
```

---

### **7. Tổng kết**

Twig là một template engine mạnh mẽ và linh hoạt, giúp bạn tách biệt phần logic ứng dụng khỏi phần hiển thị. Nó cung cấp nhiều tính năng như biến, điều kiện, vòng lặp, kế thừa layout, và các hàm/filter tiện ích. Dưới đây là các bước cơ bản để bắt đầu:

1. Cài đặt Twig qua Composer.
2. Cấu hình Twig để biết nơi lưu trữ các file template.
3. Tạo và viết file template.
4. Render template với dữ liệu tương ứng.
5. Sử dụng các tính năng như biến, điều kiện, vòng lặp, và kế thừa layout.