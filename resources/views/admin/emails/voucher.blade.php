<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .voucher {
            padding: 10px;
            background-color: #e2e2e2;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thông Báo Voucher Mới</h1>
        <p>Chào bạn,</p>
        <p>Chúng tôi rất vui thông báo rằng bạn đã nhận được một voucher mới!</p>

        <div class="voucher">
            <strong>Mã Voucher:</strong> {{ $voucher->code }}<br>
            <strong>Tên Voucher:</strong> {{ $voucher->name_voucher }}<br>
            <strong>Loại Giảm Giá:</strong> {{ $voucher->discount_type === 'percentage' ? 'Phần Trăm' : 'Cố Định' }}<br>
            <strong>Giá Trị Giảm Giá:</strong> {{ $voucher->discount_amount }} {{ $voucher->discount_type === 'percentage' ? '%' : 'VND' }}<br>
            <strong>Ngày Bắt Đầu:</strong> {{ $voucher->start_date }}<br>
            <strong>Ngày Kết Thúc:</strong> {{ $voucher->expiration_date }}<br>
        </div>

        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
    </div>
</body>
</html>
