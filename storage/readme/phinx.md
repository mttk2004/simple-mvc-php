## **Hướng dẫn sử dụng Phinx**

**Phinx** là một công cụ quản lý cơ sở dữ liệu (database migration) rất tốt và phổ biến trong cộng đồng PHP. Nó giúp bạn quản lý các thay đổi cơ sở dữ liệu một cách dễ dàng, đảm bảo rằng các thay đổi được áp dụng một cách nhất quán trên các môi trường khác nhau (local, staging, production). Dưới đây là hướng dẫn chi tiết về cách sử dụng Phinx cho người mới bắt đầu.

---

### **1. Cài đặt Phinx**

Đầu tiên, bạn cần cài đặt Phinx thông qua Composer:

```bash
composer require robmorgan/phinx
```

Sau khi cài đặt xong, bạn có thể bắt đầu sử dụng Phinx trong dự án của mình.

---

### **2. Khởi tạo cấu hình Phinx**

Phinx yêu cầu một file cấu hình để biết cách kết nối đến cơ sở dữ liệu và quản lý các migration. Bạn có thể tạo file cấu hình bằng lệnh sau:

```bash
vendor/bin/phinx init
```

Lệnh này sẽ tạo ra một file cấu hình mặc định tên là `phinx.php` trong thư mục gốc của dự án.

---

### **3. Cấu hình kết nối cơ sở dữ liệu**

Mở file `phinx.php` và cấu hình kết nối cơ sở dữ liệu của bạn. Ví dụ:

```php
return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'production_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'development_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
```

Trong ví dụ trên:
- `paths`: Đường dẫn đến thư mục chứa các migration và seed.
- `environments`: Cấu hình kết nối cơ sở dữ liệu cho các môi trường khác nhau (production, development, testing).

---

### **4. Tạo Migration**

Migration là các file PHP chứa các thay đổi cơ sở dữ liệu. Bạn có thể tạo một migration mới bằng lệnh sau:

```bash
vendor/bin/phinx create CreateUsersTable
```

Lệnh này sẽ tạo một file migration trong thư mục `db/migrations` với tên file theo định dạng `YYYYMMDDHHMMSS_create_users_table.php`.

---

### **5. Viết Migration**

Mở file migration vừa tạo và viết các thay đổi cơ sở dữ liệu. Ví dụ:

```php
<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        // Tạo bảng users
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 255])
              ->addColumn('email', 'string', ['limit' => 255])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime', ['null' => true])
              ->addIndex(['email'], ['unique' => true])
              ->create();
    }
}
```

Trong ví dụ trên:
- `addColumn`: Thêm cột vào bảng.
- `addIndex`: Thêm chỉ mục vào bảng.
- `create`: Tạo bảng.

---

### **6. Chạy Migration**

Sau khi viết xong migration, bạn có thể chạy migration để áp dụng các thay đổi vào cơ sở dữ liệu:

```bash
vendor/bin/phinx migrate -e development
```

Lệnh này sẽ áp dụng tất cả các migration chưa được chạy trong môi trường `development`.

---

### **7. Rollback Migration**

Nếu bạn muốn hoàn tác các thay đổi, bạn có thể sử dụng lệnh rollback:

```bash
vendor/bin/phinx rollback -e development
```

Lệnh này sẽ hoàn tác migration gần nhất.

---

### **8. Tạo Seed**

Seed là các file PHP dùng để nhập dữ liệu mẫu vào cơ sở dữ liệu. Bạn có thể tạo một seed mới bằng lệnh sau:

```bash
vendor/bin/phinx seed:create UserSeeder
```

Lệnh này sẽ tạo một file seed trong thư mục `db/seeds`.

---

### **9. Viết Seed**

Mở file seed vừa tạo và viết các dữ liệu mẫu:

```php
<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => password_hash('password456', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->table('users')->insert($data)->saveData();
    }
}
```

---

### **10. Chạy Seed**

Sau khi viết xong seed, bạn có thể chạy seed để nhập dữ liệu mẫu vào cơ sở dữ liệu:

```bash
vendor/bin/phinx seed:run -e development
```

---

### **11. Tổng kết**

Phinx là một công cụ mạnh mẽ giúp bạn quản lý cơ sở dữ liệu một cách hiệu quả. Nó giúp bạn tạo, quản lý và áp dụng các thay đổi cơ sở dữ liệu một cách nhất quán trên các môi trường khác nhau. Dưới đây là các bước cơ bản để bắt đầu:

1. Cài đặt Phinx qua Composer.
2. Khởi tạo cấu hình Phinx.
3. Cấu hình kết nối cơ sở dữ liệu.
4. Tạo và viết migration.
5. Chạy migration để áp dụng thay đổi.
6. Tạo và viết seed để nhập dữ liệu mẫu.
7. Chạy seed để nhập dữ liệu vào cơ sở dữ liệu.