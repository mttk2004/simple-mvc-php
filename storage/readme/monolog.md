## **Hướng dẫn sử dụng Monolog**

**Monolog** là một thư viện ghi log mạnh mẽ và linh hoạt trong PHP, giúp bạn quản lý và ghi lại các thông tin log một cách hiệu quả. Dưới đây là hướng dẫn chi tiết về cách sử dụng Monolog cho người mới bắt đầu.

---

### **1. Cài đặt Monolog**

Đầu tiên, bạn cần cài đặt Monolog thông qua Composer:

```bash
composer require monolog/monolog
```

Sau khi cài đặt xong, bạn có thể bắt đầu sử dụng Monolog trong dự án của mình.

---

### **2. Các khái niệm cơ bản**

Trước khi đi vào chi tiết, hãy hiểu một số khái niệm cơ bản:

- **Logger (Bộ ghi log):** Là đối tượng chính để ghi log. Bạn có thể tạo nhiều logger khác nhau cho các mục đích khác nhau (ví dụ: logger cho ứng dụng, logger cho API, v.v.).
- **Handler (Xử lý log):** Xác định nơi lưu trữ log (ví dụ: file, console, email, Slack, v.v.).
- **Formatter (Định dạng log):** Xác định cách log được định dạng trước khi lưu trữ.
- **Level (Cấp độ log):** Xác định mức độ nghiêm trọng của log (ví dụ: DEBUG, INFO, WARNING, ERROR, CRITICAL).

---

### **3. Cách sử dụng cơ bản**

#### **a. Tạo Logger**

Đầu tiên, bạn cần tạo một đối tượng `Logger`:

```php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Tạo một logger với tên "my_logger"
$logger = new Logger('my_logger');

// Thêm handler để ghi log vào file
$logger->pushHandler(new StreamHandler('logs/app.log', Logger::DEBUG));
```

Trong ví dụ trên:
- `Logger('my_logger')`: Tạo một logger với tên `my_logger`.
- `StreamHandler('logs/app.log', Logger::DEBUG)`: Ghi log vào file `logs/app.log` với mức độ log từ `DEBUG` trở lên.

---

#### **b. Ghi log**

Sau khi tạo logger, bạn có thể bắt đầu ghi log:

```php
// Ghi log với các mức độ khác nhau
$logger->debug('This is a debug message');
$logger->info('This is an info message');
$logger->notice('This is a notice message');
$logger->warning('This is a warning message');
$logger->error('This is an error message');
$logger->critical('This is a critical message');
$logger->alert('This is an alert message');
$logger->emergency('This is an emergency message');
```

Kết quả sẽ được ghi vào file `logs/app.log`:

```
[2023-10-01 12:34:56] my_logger.DEBUG: This is a debug message [] []
[2023-10-01 12:34:56] my_logger.INFO: This is an info message [] []
[2023-10-01 12:34:56] my_logger.NOTICE: This is a notice message [] []
[2023-10-01 12:34:56] my_logger.WARNING: This is a warning message [] []
[2023-10-01 12:34:56] my_logger.ERROR: This is an error message [] []
[2023-10-01 12:34:56] my_logger.CRITICAL: This is a critical message [] []
[2023-10-01 12:34:56] my_logger.ALERT: This is an alert message [] []
[2023-10-01 12:34:56] my_logger.EMERGENCY: This is an emergency message [] []
```

---

### **4. Sử dụng nhiều Handler**

Bạn có thể sử dụng nhiều handler để ghi log vào nhiều nơi khác nhau. Ví dụ: ghi log vào file và gửi email khi có lỗi nghiêm trọng.

```php
use Monolog\Handler\StreamHandler;
use Monolog\Handler\NativeMailerHandler;

// Ghi log vào file
$logger->pushHandler(new StreamHandler('logs/app.log', Logger::DEBUG));

// Gửi email khi có lỗi nghiêm trọng
$logger->pushHandler(new NativeMailerHandler('admin@example.com', 'Error Report', 'sender@example.com', Logger::ERROR));
```

Khi có lỗi nghiêm trọng (`ERROR` trở lên), Monolog sẽ gửi email đến `admin@example.com`.

---

### **5. Sử dụng Formatter**

Bạn có thể tùy chỉnh định dạng log bằng cách sử dụng `Formatter`.

#### **a. LineFormatter**

`LineFormatter` là định dạng mặc định của Monolog. Bạn có thể tùy chỉnh nó:

```php
use Monolog\Formatter\LineFormatter;

$formatter = new LineFormatter("[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n");
$streamHandler = new StreamHandler('logs/app.log', Logger::DEBUG);
$streamHandler->setFormatter($formatter);
$logger->pushHandler($streamHandler);
```

Kết quả:
```
[2023-10-01 12:34:56] my_logger.DEBUG: This is a debug message [] []
```

#### **b. JsonFormatter**

Bạn cũng có thể sử dụng `JsonFormatter` để ghi log dưới dạng JSON:

```php
use Monolog\Formatter\JsonFormatter;

$formatter = new JsonFormatter();
$streamHandler = new StreamHandler('logs/app.log', Logger::DEBUG);
$streamHandler->setFormatter($formatter);
$logger->pushHandler($streamHandler);
```

Kết quả:
```json
{"message":"This is a debug message","context":[],"level":100,"level_name":"DEBUG","channel":"my_logger","datetime":"2023-10-01T12:34:56+00:00","extra":[]}
```

---

### **6. Sử dụng Processor**

Processor là một cách để thêm thông tin bổ sung vào log. Ví dụ: thêm thông tin về người dùng hoặc ID yêu cầu.

#### **a. Thêm thông tin người dùng:**

```php
use Monolog\Processor\WebProcessor;

$logger->pushProcessor(new WebProcessor($_SERVER));
$logger->info('This is an info message');
```

Kết quả:
```
[2023-10-01 12:34:56] my_logger.INFO: This is an info message {"url":"/path","ip":"127.0.0.1","http_method":"GET","server":"localhost","referrer":null} []
```

#### **b. Thêm ID yêu cầu:**

```php
use Monolog\Processor\UidProcessor;

$logger->pushProcessor(new UidProcessor());
$logger->info('This is an info message');
```

Kết quả:
```
[2023-10-01 12:34:56] my_logger.INFO: This is an info message [] {"uid":"abc123"}
```

---

### **7. Ghi log vào các nguồn khác**

Monolog hỗ trợ ghi log vào nhiều nguồn khác như Slack, Syslog, MongoDB, v.v.

#### **a. Ghi log vào Slack:**

```php
use Monolog\Handler\SlackWebhookHandler;

$logger->pushHandler(new SlackWebhookHandler('https://hooks.slack.com/services/...', 'channel', 'username', true, null, Logger::ERROR));
$logger->error('This is an error message');
```

#### **b. Ghi log vào Syslog:**

```php
use Monolog\Handler\SyslogHandler;

$logger->pushHandler(new SyslogHandler('my_app'));
$logger->info('This is an info message');
```

---

### **8. Tổng kết**

Monolog là một thư viện ghi log mạnh mẽ và linh hoạt, giúp bạn quản lý và ghi lại các thông tin log một cách hiệu quả. Nó hỗ trợ nhiều handler, formatter, và processor để tùy chỉnh log theo nhu cầu của bạn. Dưới đây là các bước cơ bản để bắt đầu:

1. Cài đặt Monolog qua Composer.
2. Tạo logger và thêm handler để ghi log.
3. Ghi log với các mức độ khác nhau.
4. Sử dụng formatter để tùy chỉnh định dạng log.
5. Sử dụng processor để thêm thông tin bổ sung vào log.
6. Ghi log vào các nguồn khác như Slack, Syslog, v.v.
