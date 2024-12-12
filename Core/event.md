## **Hướng dẫn sử dụng `league/event`**

**`league/event`** là một thư viện mạnh mẽ và linh hoạt để quản lý các sự kiện trong PHP. Nó giúp bạn triển khai một hệ thống **Event Listener** tương tự như trong Laravel một cách dễ dàng. Dưới đây là hướng dẫn chi tiết về cách sử dụng `league/event` cho người mới bắt đầu.

---

### **1. Cài đặt `league/event`**

Đầu tiên, bạn cần cài đặt thư viện `league/event` thông qua Composer:

```bash
composer require league/event
```

Sau khi cài đặt xong, bạn có thể bắt đầu sử dụng thư viện này trong dự án của mình.

---

### **2. Các khái niệm cơ bản**

Trước khi đi vào chi tiết, hãy hiểu một số khái niệm cơ bản:

- **Event (Sự kiện):** Đại diện cho một sự kiện xảy ra trong ứng dụng (ví dụ: `user.created`, `order.placed`).
- **Listener (Người nghe):** Là một hàm hoặc phương thức xử lý sự kiện khi nó được kích hoạt.
- **Emitter (Phát sự kiện):** Quản lý việc đăng ký và kích hoạt sự kiện.

---

### **3. Cách sử dụng cơ bản**

#### **a. Tạo và kích hoạt sự kiện**

Đầu tiên, bạn cần tạo một sự kiện và kích hoạt nó.

```php
require 'vendor/autoload.php';

use League\Event\Emitter;
use League\Event\Event;

// Khởi tạo Emitter
$emitter = new Emitter();

// Tạo một sự kiện
$event = new Event('user.created');

// Kích hoạt sự kiện
$emitter->emit($event);
```

Khi chạy đoạn code trên, sự kiện `user.created` sẽ được kích hoạt, nhưng không có gì xảy ra vì chưa có Listener được đăng ký.

---

#### **b. Tạo và đăng ký Listener**

Listener là một hàm hoặc phương thức xử lý sự kiện. Bạn có thể tạo một Listener như sau:

```php
use League\Event\Listener;

class UserCreatedListener implements Listener
{
    public function __invoke($event, $payload = null)
    {
        echo "User created: " . $payload['name'];
    }
}
```

Sau đó, đăng ký Listener với sự kiện:

```php
$emitter->addListener('user.created', new UserCreatedListener());
```

Bây giờ, khi bạn kích hoạt sự kiện `user.created`, Listener sẽ được gọi:

```php
$emitter->emit($event, ['name' => 'John Doe']);
```

Kết quả:
```
User created: John Doe
```

---

### **4. Sử dụng Closure làm Listener**

Nếu bạn không muốn tạo một lớp Listener riêng, bạn có thể sử dụng Closure để xử lý sự kiện:

```php
$emitter->addListener('user.created', function ($event, $payload) {
    echo "User created: " . $payload['name'];
});

$emitter->emit($event, ['name' => 'Jane Smith']);
```

Kết quả:
```
User created: Jane Smith
```

---

### **5. Sử dụng Event Generator**

Nếu bạn muốn tạo nhiều sự kiện từ một nguồn, bạn có thể sử dụng **Event Generator**:

```php
use League\Event\AbstractEvent;
use League\Event\GeneratorInterface;

class UserEventGenerator implements GeneratorInterface
{
    public function getEvents(): array
    {
        return [
            new Event('user.created'),
            new Event('user.updated'),
            new Event('user.deleted'),
        ];
    }
}

// Kích hoạt tất cả sự kiện từ Generator
$emitter->emitGeneratedEvents(new UserEventGenerator());
```

---

### **6. Sử dụng Event Subscriber**

Event Subscriber cho phép bạn đăng ký nhiều Listener cùng một lúc. Bạn cần tạo một lớp Subscriber và triển khai interface `SubscriberInterface`:

```php
use League\Event\SubscriberInterface;

class UserSubscriber implements SubscriberInterface
{
    public function subscribeToEvents($emitter)
    {
        $emitter->addListener('user.created', [$this, 'onUserCreated']);
        $emitter->addListener('user.updated', [$this, 'onUserUpdated']);
    }

    public function onUserCreated($event, $payload = null)
    {
        echo "User created: " . $payload['name'];
    }

    public function onUserUpdated($event, $payload = null)
    {
        echo "User updated: " . $payload['name'];
    }
}

// Đăng ký Subscriber
$emitter->subscribeTo($emitter, new UserSubscriber());

// Kích hoạt sự kiện
$emitter->emit(new Event('user.created'), ['name' => 'Alice Johnson']);
$emitter->emit(new Event('user.updated'), ['name' => 'Bob Brown']);
```

Kết quả:
```
User created: Alice Johnson
User updated: Bob Brown
```

---

### **7. Sử dụng Event Priority**

Bạn có thể đặt mức độ ưu tiên cho các Listener để kiểm soát thứ tự thực thi:

```php
$emitter->addListener('user.created', function ($event, $payload) {
    echo "Listener 1: User created: " . $payload['name'];
}, 10); // Priority 10

$emitter->addListener('user.created', function ($event, $payload) {
    echo "Listener 2: User created: " . $payload['name'];
}, 20); // Priority 20

$emitter->emit(new Event('user.created'), ['name' => 'John Doe']);
```

Kết quả:
```
Listener 2: User created: John Doe
Listener 1: User created: John Doe
```

---

### **8. Tổng kết**

`league/event` là một thư viện mạnh mẽ và linh hoạt để quản lý các sự kiện trong PHP. Nó giúp bạn tách biệt logic xử lý sự kiện và giúp code dễ bảo trì hơn. Dưới đây là các bước cơ bản để bắt đầu:

1. Cài đặt thư viện qua Composer.
2. Tạo và kích hoạt sự kiện.
3. Tạo và đăng ký Listener.
4. Sử dụng Closure hoặc Subscriber để xử lý sự kiện.
5. Sử dụng Event Priority để kiểm soát thứ tự thực thi.

Hy vọng hướng dẫn này giúp bạn hiểu rõ hơn về cách sử dụng `league/event` trong dự án PHP thuần của mình! 😊