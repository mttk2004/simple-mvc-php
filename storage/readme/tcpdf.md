## **Hướng dẫn sử dụng TCPDF**

**TCPDF** là một thư viện mã nguồn mở, được sử dụng rộng rãi để tạo PDF trong PHP. Nó hỗ trợ nhiều tính năng như thêm văn bản, hình ảnh, bảng, và các phông chữ khác nhau. Dưới đây là hướng dẫn chi tiết về cách sử dụng TCPDF cho người mới bắt đầu.

---

### **1. Cài đặt TCPDF**

Đầu tiên, bạn cần cài đặt TCPDF thông qua Composer:

```bash
composer require tecnickcom/tcpdf
```

Sau khi cài đặt xong, bạn có thể bắt đầu sử dụng TCPDF trong dự án của mình.

---

### **2. Các khái niệm cơ bản**

Trước khi đi vào chi tiết, hãy hiểu một số khái niệm cơ bản:

- **PDF Document (Tài liệu PDF):** Là đối tượng chính để tạo và quản lý các trang PDF.
- **Page (Trang):** Là một trang trong tài liệu PDF.
- **Cell (Ô):** Là một ô văn bản hoặc hình ảnh trong trang PDF.
- **MultiCell (Ô nhiều dòng):** Là một ô văn bản có thể chứa nhiều dòng.
- **Image (Hình ảnh):** Là hình ảnh được thêm vào trang PDF.
- **Table (Bảng):** Là bảng dữ liệu được thêm vào trang PDF.

---

### **3. Cách sử dụng cơ bản**

#### **a. Tạo tài liệu PDF**

Đầu tiên, bạn cần tạo một đối tượng `TCPDF` để bắt đầu tạo tài liệu PDF.

```php
require 'vendor/autoload.php';

use TCPDF;

// Khởi tạo đối tượng TCPDF
$pdf = new TCPDF();
```

---

#### **b. Thêm trang**

Sau khi tạo đối tượng `TCPDF`, bạn cần thêm một trang mới để bắt đầu thêm nội dung.

```php
$pdf->AddPage();
```

---

#### **c. Thêm văn bản**

Bạn có thể thêm văn bản vào trang PDF bằng phương thức `Cell` hoặc `MultiCell`.

##### **Ví dụ với Cell:**

```php
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Hóa đơn thương mại điện tử', 0, 1, 'C');
```

**Giải thích:**
- `0`: Chiều rộng của ô (0 có nghĩa là chiều rộng tự động).
- `10`: Chiều cao của ô.
- `'Hóa đơn thương mại điện tử'`: Nội dung của ô.
- `0`: Không có border.
- `1`: Xuống dòng sau khi thêm ô.
- `'C'`: Căn giữa nội dung trong ô.

##### **Ví dụ với MultiCell:**

```php
$pdf->MultiCell(0, 10, "Đây là một đoạn văn bản dài hơn, có thể chứa nhiều dòng.\nDòng thứ hai.", 1, 'L', false, 1, '', '', true, 0, false, true, 10, 'M');
```

**Giải thích:**
- `0`: Chiều rộng của ô.
- `10`: Chiều cao của ô.
- `"Đây là một đoạn văn bản dài hơn..."`: Nội dung của ô.
- `1`: Có border.
- `'L'`: Căn trái nội dung trong ô.
- `false`: Không fill màu nền.
- `1`: Xuống dòng sau khi thêm ô.

---

#### **d. Thêm hình ảnh**

Bạn có thể thêm hình ảnh vào trang PDF bằng phương thức `Image`.

```php
$pdf->Image('path/to/image.jpg', 10, 10, 50, 0, 'JPG', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
```

**Giải thích:**
- `'path/to/image.jpg'`: Đường dẫn đến hình ảnh.
- `10`: Tọa độ X của hình ảnh.
- `10`: Tọa độ Y của hình ảnh.
- `50`: Chiều rộng của hình ảnh.
- `0`: Chiều cao của hình ảnh (0 có nghĩa là tự động tính theo tỷ lệ).
- `'JPG'`: Định dạng hình ảnh.
- `'T'`: Vị trí của hình ảnh trong ô.
- `false`: Không link.
- `300`: Độ phân giải hình ảnh.
- `'C'`: Căn giữa hình ảnh.

---

#### **e. Thêm bảng**

Bạn có thể thêm bảng vào trang PDF bằng cách sử dụng HTML hoặc tự xây dựng bảng bằng các phương thức của TCPDF.

##### **Ví dụ với HTML:**

```php
$html = '
<table border="1" cellpadding="5">
    <tr>
        <th>STT</th>
        <th>Sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Tổng</th>
    </tr>
    <tr>
        <td>1</td>
        <td>Sản phẩm A</td>
        <td>100.000</td>
        <td>2</td>
        <td>200.000</td>
    </tr>
</table>';

$pdf->writeHTML($html, true, false, true, false, '');
```

##### **Ví dụ với các phương thức của TCPDF:**

```php
$pdf->SetFont('helvetica', '', 12);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);

$header = ['STT', 'Sản phẩm', 'Giá', 'Số lượng', 'Tổng'];
$data = [
    ['1', 'Sản phẩm A', '100.000', '2', '200.000'],
    ['2', 'Sản phẩm B', '150.000', '1', '150.000'],
];

$pdf->SetFont('', 'B');
foreach ($header as $col) {
    $pdf->Cell(30, 7, $col, 1, 0, 'C', 1);
}
$pdf->Ln();

$pdf->SetFont('', '');
foreach ($data as $row) {
    foreach ($row as $col) {
        $pdf->Cell(30, 6, $col, 1, 0, 'C', 1);
    }
    $pdf->Ln();
}
```

---

#### **f. Xuất PDF**

Sau khi thêm nội dung vào trang PDF, bạn cần xuất tài liệu PDF bằng phương thức `Output`.

```php
$pdf->Output('hoa_don.pdf', 'I');
```

**Giải thích:**
- `'hoa_don.pdf'`: Tên file PDF.
- `'I'`: Xuất PDF trực tiếp trong trình duyệt.
- `'D'`: Tải xuống PDF.
- `'F'`: Lưu PDF vào máy chủ.

---

### **4. Các tính năng nâng cao**

#### **a. Thêm header và footer**

Bạn có thể thêm header và footer vào tài liệu PDF bằng cách ghi đè các phương thức `Header` và `Footer` của lớp `TCPDF`.

```php
class MyPDF extends TCPDF {
    public function Header() {
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 10, 'Header của tài liệu PDF', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Trang '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new MyPDF();
```

---

#### **b. Thêm watermark**

Bạn có thể thêm watermark vào tài liệu PDF bằng cách sử dụng phương thức `SetWatermarkText`.

```php
$pdf->SetWatermarkText('Draft');
$pdf->showWatermarkText = true;
```

---

#### **c. Thêm bookmark**

Bạn có thể thêm bookmark vào tài liệu PDF bằng phương thức `Bookmark`.

```php
$pdf->Bookmark('Chương 1', 0, 0, '', 'B', array(0, 64, 128));
```

---

### **5. Tổng kết**

TCPDF là một thư viện mạnh mẽ và linh hoạt, giúp bạn tạo các tài liệu PDF với nhiều tính năng như thêm văn bản, hình ảnh, bảng, và các phông chữ khác nhau. Nó hỗ trợ nhiều tính năng nâng cao như header, footer, watermark, và bookmark. Dưới đây là các bước cơ bản để bắt đầu:

1. Cài đặt TCPDF qua Composer.
2. Tạo đối tượng TCPDF.
3. Thêm trang và nội dung vào trang PDF.
4. Xuất tài liệu PDF.
5. Sử dụng các tính năng nâng cao như header, footer, watermark, và bookmark.