## Medoo
Medoo là một framework PHP nhỏ gọn, dễ sử dụng và mạnh mẽ để truy vấn cơ sở dữ liệu. Nó hỗ trợ nhiều loại cơ sở dữ liệu như MySQL, MariaDB, PostgreSQL, SQLite, và MSSQL. Medoo giúp bạn viết các truy vấn SQL một cách dễ dàng và an toàn hơn bằng cách tự động xử lý các vấn đề liên quan đến SQL injection.

Dưới đây là hướng dẫn chi tiết về cách sử dụng Medoo để truy vấn cơ sở dữ liệu:

### 1. Cài đặt Medoo

Bạn có thể cài đặt Medoo thông qua Composer hoặc tải file phiên bản mới nhất từ trang chủ của Medoo.

#### Sử dụng Composer:
```bash
composer require catfan/medoo
```

Sau khi cài đặt, bạn cần include autoloader của Composer trong project của mình:
```php
require 'vendor/autoload.php';
```

#### Tải file phiên bản mới nhất:
Bạn có thể tải file `medoo.php` từ [trang chủ của Medoo](https://medoo.in/) và include nó trong project của mình:
```php
require 'path/to/medoo.php';
```

### 2. Khởi tạo Medoo

Sau khi cài đặt, bạn cần khởi tạo Medoo với thông tin kết nối cơ sở dữ liệu. Dưới đây là một ví dụ về cách khởi tạo Medoo để kết nối với MySQL:

```php
use Medoo\Medoo;

$database = new Medoo([
    'type' => 'mysql', // Loại cơ sở dữ liệu (mysql, mariadb, postgresql, sqlite, mssql)
    'host' => 'localhost', // Địa chỉ máy chủ cơ sở dữ liệu
    'database' => 'your_database', // Tên cơ sở dữ liệu
    'username' => 'your_username', // Tên người dùng
    'password' => 'your_password', // Mật khẩu
    'charset' => 'utf8mb4', // Bộ ký tự
    'collation' => 'utf8mb4_general_ci', // Collation
]);
```

### 3. Các phương thức truy vấn cơ bản

Medoo cung cấp nhiều phương thức để thực hiện các truy vấn cơ bản như `select`, `insert`, `update`, `delete`, và `get`.

#### a. SELECT

Để lấy dữ liệu từ một bảng, bạn sử dụng phương thức `select`:

```php
$data = $database->select('users', [
    'user_id',
    'username',
    'email'
], [
    'status' => 1
]);

print_r($data);
```

Trong ví dụ trên, chúng ta lấy ra các trường `user_id`, `username`, và `email` từ bảng `users` với điều kiện `status = 1`.

#### b. INSERT

Để chèn dữ liệu vào một bảng, bạn sử dụng phương thức `insert`:

```php
$database->insert('users', [
    'username' => 'john_doe',
    'email' => 'john@example.com',
    'status' => 1
]);

$lastInsertId = $database->id(); // Lấy ID của bản ghi vừa chèn
echo $lastInsertId;
```

#### c. UPDATE

Để cập nhật dữ liệu trong một bảng, bạn sử dụng phương thức `update`:

```php
$database->update('users', [
    'status' => 0
], [
    'user_id' => 1
]);
```

Trong ví dụ trên, chúng ta cập nhật trường `status` thành `0` cho bản ghi có `user_id = 1`.

#### d. DELETE

Để xóa dữ liệu từ một bảng, bạn sử dụng phương thức `delete`:

```php
$database->delete('users', [
    'user_id' => 1
]);
```

Trong ví dụ trên, chúng ta xóa bản ghi có `user_id = 1` khỏi bảng `users`.

#### e. GET

Để lấy một bản ghi duy nhất từ một bảng, bạn sử dụng phương thức `get`:

```php
$user = $database->get('users', [
    'user_id',
    'username',
    'email'
], [
    'user_id' => 1
]);

print_r($user);
```

Trong ví dụ trên, chúng ta lấy ra bản ghi có `user_id = 1` từ bảng `users`.

### 4. Truy vấn phức tạp hơn

Medoo cũng hỗ trợ các truy vấn phức tạp hơn như JOIN, WHERE phức tạp, và các truy vấn tùy chỉnh.

#### a. JOIN

Để thực hiện truy vấn JOIN giữa các bảng, bạn có thể sử dụng cú pháp sau:

```php
$data = $database->select('users', [
    '[>]posts' => ['user_id' => 'author_id']
], [
    'users.user_id',
    'users.username',
    'posts.title',
    'posts.content'
], [
    'users.status' => 1
]);

print_r($data);
```

Trong ví dụ trên, chúng ta thực hiện JOIN giữa bảng `users` và `posts` trên trường `user_id` của bảng `users` và trường `author_id` của bảng `posts`.

#### b. WHERE phức tạp

Medoo hỗ trợ các điều kiện WHERE phức tạp hơn bằng cách sử dụng mảng:

```php
$data = $database->select('users', [
    'user_id',
    'username',
    'email'
], [
    'AND' => [
        'status' => 1,
        'OR' => [
            'username' => 'john_doe',
            'email' => 'john@example.com'
        ]
    ]
]);

print_r($data);
```

Trong ví dụ trên, chúng ta sử dụng điều kiện `AND` và `OR` để lọc dữ liệu.

#### c. Truy vấn tùy chỉnh

Nếu bạn cần thực hiện một truy vấn SQL tùy chỉnh, bạn có thể sử dụng phương thức `query`:

```php
$data = $database->query('SELECT * FROM users WHERE status = ?', 1)->fetchAll();

print_r($data);
```

Trong ví dụ trên, chúng ta thực hiện một truy vấn SQL tùy chỉnh và lấy kết quả.

### 5. Xử lý lỗi

Medoo cung cấp các phương thức để xử lý lỗi như `error` và `last_query`:

```php
if ($database->error()) {
    echo $database->last_query();
    print_r($database->error());
}
```

Trong ví dụ trên, chúng ta kiểm tra xem có lỗi xảy ra không và in ra câu truy vấn cuối cùng và thông báo lỗi.

### 6. Kết luận

Medoo là một công cụ tuyệt vời để làm việc với cơ sở dữ liệu trong PHP. Nó đơn giản, dễ sử dụng và mạnh mẽ, giúp bạn tiết kiệm thời gian khi viết các truy vấn SQL. Hy vọng hướng dẫn này sẽ giúp bạn bắt đầu với Medoo một cách dễ dàng.