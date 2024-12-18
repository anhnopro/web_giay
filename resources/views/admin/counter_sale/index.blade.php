
@include('admin.headerAdmin')

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Bán hàng</h3>
        <button id="createOrderBtn" class="btn btn-warning">+ Tạo đơn hàng</button>
    </div>

    <!-- Tab navigation for orders -->
    <ul class="nav nav-tabs" id="orderTabs">
    </ul>

    <!-- Product section -->
    <div class="mt-3">
        <div class="d-flex justify-content-between">
            <h5>Sản phẩm</h5>
            <button id="addProductBtn" class="btn btn-outline-success">
                <i class="bi bi-plus-circle"></i> Thêm sản phẩm
            </button>
        </div>
    </div>
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- Use modal-xl for larger modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chọn sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container my-4">
                        <!-- Product Search and Filters -->
                        <div class="search-section mb-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <input type="text" id="searchProduct" class="form-control" placeholder="Tìm kiếm sản phẩm">
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="me-2">Danh mục:
                                            <select id="filterCategory" class="form-select d-inline-block w-auto">
                                                <option value="">Tất cả</option>
                                                @foreach($categories as $cate)
                                                    <option value="{{ $cate->id_category }}">{{ $cate->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="me-2">Màu sắc:
                                            <select id="filterColor" class="form-select d-inline-block w-auto">
                                                <option value="">Tất cả</option>
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->id_color }}">{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="me-2">Chất liệu:
                                            <select id="filterMaterial" class="form-select d-inline-block w-auto">
                                                <option value="">Tất cả</option>
                                                <!-- Populate with actual materials if available -->
                                            </select>
                                        </div>
                                        <div class="me-2">Kích cỡ:
                                            <select id="filterSize" class="form-select d-inline-block w-auto">
                                                <option value="">Tất cả</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size->id_size }}">{{ $size->size_value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="me-2">Đế giày:
                                            <select id="filterShoeBase" class="form-select d-inline-block w-auto">
                                                <option value="">Tất cả</option>
                                                <!-- Populate with actual shoe bases if available -->
                                            </select>
                                        </div>
                                        <div class="me-2">Thương hiệu:
                                            <select id="filterBrand" class="form-select d-inline-block w-auto">
                                                <option value="">Tất cả</option>
                                                <!-- Populate with actual brands if available -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="price-range mt-2">
                                <label>Price Range: <span id="priceRangeLabel">100.000 VND - 3.200.000 VND</span></label>
                                <input type="range" id="priceRange" min="100000" max="3200000" step="50000" value="3200000">
                            </div>
                        </div>

                        <!-- Product List -->
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Thương hiệu</th>
                                    <th>Màu sắc</th>
                                    <th>Kích cỡ</th>
                                    <th>Giá</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="productList">
                                @foreach ($products as $product)
                                    @php
                                        // Extract unique colors and sizes
                                        $uniqueColors = $product->variants->pluck('color.name')->unique();
                                        $uniqueSizes = $product->variants->pluck('size.size_value')->unique();


                                        $prices = $product->variants->map(function($variant) {
                                            return $variant->sale_price ?? $variant->price;
                                        });
                                        $minPrice = $prices->min();
                                        $maxPrice = $prices->max();
                                    @endphp
                                    <tr>
                                        <td>
                                            <img src="{{ asset('/storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px;">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                        <td>
                                            @foreach($uniqueColors as $color)
                                                <span class="badge bg-primary">{{ $color }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($uniqueSizes as $size)
                                                <span class="badge bg-success">{{ $size }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($minPrice != $maxPrice)
                                                {{ number_format($minPrice, 0, ',', '.') }} VND - {{ number_format($maxPrice, 0, ',', '.') }} VND
                                            @else
                                                {{ number_format($minPrice, 0, ',', '.') }} VND
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-success select-product"
                                                    data-id="{{ $product->id_product }}"
                                                    data-name="{{ htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8') }}"
                                                    data-image="{{ asset('/storage/' . $product->image) }}"
                                                    data-price="{{ $minPrice }}"
                                                    data-variants="{{ json_encode($product->variants->map(function($variant) {
                                                        return [
                                                            'id_variant' => $variant->id_variant,
                                                            'quantity' => $variant->quantity,
                                                            'price' => $variant->price,
                                                            'sale_price' => $variant->sale_price,
                                                            'color_name' => $variant->color->name,
                                                            'size_value' => $variant->size->size_value,
                                                            'image' => asset('/storage/' . $variant->image),
                                                        ];
                                                    }), JSON_HEX_APOS | JSON_HEX_QUOT) }}">
                                                Chọn
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Voucher and Total Price Section -->

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items Display -->
    <div class="mt-4">
        <h4>Chi tiết Đơn hàng</h4>
        <table class="table table-bordered" id="orderItemsTable">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Màu sắc</th>
                    <th>Kích cỡ</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>


    <form action="" method="POST">
        @csrf
        <input type="hidden" name="total_price" id="hiddenTotalPrice" value="0">

            <label for="voucherCode">Nhập mã Voucher:</label>
            <div class="d-flex">
                <input type="text" id="voucherCode" class="form-control">
            </div>

            <a id="applyVoucherBtn" class="btn btn-primary mt-2">Áp dụng Voucher</a>

            <div class="total-section mt-3">
                <h5>Tổng tiền: <span id="totalPrice">0 VND</span></h5>
            </div>

            <div class="text-center mt-3">
                <button type="button" class="btn btn-success" onclick="generateInvoicePDF()">Hoàn tất Đơn hàng</button>
            </div>

    </form>
</div>
<!-- Invoice Modal -->
<!-- Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="invoiceModalLabel">HÓA ĐƠN BÁN HÀNG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="invoice" class="p-4">
                    <h2 class="text-center">F-Shoes</h2>
                    <p class="text-center">Địa chỉ: FPT POLYTECHNIC Cơ Sở Xã Tân An, P. Kiều Mai, Phúc Diễn, Từ Liêm, Hà Nội</p>
                    <hr>
                    <h3 class="text-center mb-4">HÓA ĐƠN BÁN HÀNG</h3>

                    <!-- Invoice Details -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <p><strong>Khách hàng:</strong> Khách lẻ</p>
                            <p><strong>Ngày tạo:</strong> <span id="invoiceDate">21-12-2023 13:48:14</span></p>
                        </div>
                        <div class="col-sm-6 text-end">
                            <p><strong>Mã Hóa Đơn:</strong> HD10</p>
                            <p><strong>Nhân viên:</strong> NV6 - Nguyễn Văn Nhật</p>
                        </div>
                    </div>

                    <!-- Product Table -->
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceItems">
                            <!-- Items will be added dynamically by JavaScript -->
                        </tbody>
                    </table>

                    <!-- Summary Section -->
                    <div class="text-end">
                        <p><strong>Tổng tiền hàng:</strong> <span id="subTotal">2,377,500 VND</span></p>
                        <p><strong>Giảm giá:</strong> <span id="discount">250,000 VND</span></p>
                        <hr>
                        <h4><strong>Tổng cộng thanh toán:</strong> <span id="invoiceTotal">2,127,500 VND</span></h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="generateInvoicePDF()">In Hóa Đơn</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>




@include('admin.footerAdmin')

<!-- Variant Selection Modal -->
<div class="modal fade" id="variantModal" tabindex="-1" aria-labelledby="variantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chọn Biến Thể</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Variant Details will be dynamically loaded here -->
                <div id="variantDetails">
                    <!-- Content populated by JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="addToOrderBtn" class="btn btn-primary">Thêm vào Đơn hàng</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Section -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    let orderCount = 0;
    const createOrderBtn = document.getElementById('createOrderBtn');
    const addProductBtn = document.getElementById('addProductBtn');
    const orderTabs = document.getElementById('orderTabs');
    const productModal = new bootstrap.Modal(document.getElementById('productModal'));
    const variantModal = new bootstrap.Modal(document.getElementById('variantModal'));
    let selectedProduct = null;
    let selectedVariant = null;
    let totalPrice = 0;
    let discount = 0; // Lưu giá trị giảm giá từ voucher
    const vouchers = @json($vouchers); // Dữ liệu voucher từ server

    // Hàm định dạng tiền tệ
    function formatCurrency(number) {
        return number.toLocaleString('vi-VN', { minimumFractionDigits: 0 }) + ' VND';
    }

    // Tạo tab đơn hàng mới
    createOrderBtn.addEventListener('click', function () {
        orderCount++;
        const newOrderItem = document.createElement('li');
        newOrderItem.className = 'nav-item';
        const newOrderLink = document.createElement('a');
        newOrderLink.className = 'nav-link';
        newOrderLink.href = '#';
        newOrderLink.innerHTML = `Đơn hàng ${orderCount} - HD${orderCount} <i class="bi bi-cart"></i>`;
        newOrderItem.appendChild(newOrderLink);
        orderTabs.appendChild(newOrderItem);
    });

    // Hiển thị modal sản phẩm
    addProductBtn.addEventListener('click', function () {
        productModal.show();
    });

    // Xử lý chọn sản phẩm
    document.querySelectorAll('.select-product').forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            const productImage = this.getAttribute('data-image');
            const variants = JSON.parse(this.getAttribute('data-variants'));

            selectedProduct = {
                id: productId,
                name: productName,
                image: productImage,
                variants: variants
            };

            if (selectedProduct.variants.length > 1) {
                populateVariantModal(selectedProduct.variants);
                variantModal.show();
            } else if (selectedProduct.variants.length === 1) {
                selectedVariant = selectedProduct.variants[0];
                addProductToOrder(selectedProduct, selectedVariant);
                productModal.hide();
            } else {
                addProductToOrder(selectedProduct, null);
                productModal.hide();
            }
        });
    });

    // Hàm tạo nội dung modal biến thể
    function populateVariantModal(variants) {
        const variantDetails = document.getElementById('variantDetails');
        variantDetails.innerHTML = ''; // Xóa nội dung cũ

        variants.forEach(function (variant, index) {
            const variantCard = document.createElement('div');
            variantCard.className = 'card mb-3';
            variantCard.innerHTML = `
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="${variant.image}" class="img-fluid rounded-start" alt="Biến thể ${index + 1}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">${selectedProduct.name}</h5>
                            <p class="card-text">Màu sắc: ${variant.color_name}</p>
                            <p class="card-text">Kích cỡ: ${variant.size_value}</p>
                            <p class="card-text">Giá: ${formatCurrency(variant.sale_price || variant.price)}</p>
                            <p class="card-text">Số lượng: ${variant.quantity}</p>
                            <button class="btn btn-primary select-variant-btn" data-variant-id="${variant.id_variant}">Chọn biến thể này</button>
                        </div>
                    </div>
                </div>
            `;
            variantDetails.appendChild(variantCard);
        });

        // Thêm sự kiện chọn biến thể
        document.querySelectorAll('.select-variant-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const variantId = this.getAttribute('data-variant-id');
                selectedVariant = selectedProduct.variants.find(v => v.id_variant == variantId);
                addProductToOrder(selectedProduct, selectedVariant);
                variantModal.hide();
                productModal.hide();
            });
        });
    }

    // Hàm thêm sản phẩm và biến thể vào đơn hàng
    function addProductToOrder(product, variant) {
        const price = variant ? parseFloat(variant.sale_price || variant.price) : 0;
        totalPrice += price;

        // Cập nhật tổng tiền
        document.getElementById('totalPrice').innerText = formatCurrency(totalPrice);
        document.getElementById('hiddenTotalPrice').value = totalPrice;

        // Thêm sản phẩm vào bảng chi tiết đơn hàng
        const orderItemsTable = document.getElementById('orderItemsTable').querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><img src="${product.image}" alt="${product.name}" style="width: 50px;"></td>
            <td>${product.name}</td>
            <td>${variant ? variant.color_name : 'N/A'}</td>
            <td>${variant ? variant.size_value : 'N/A'}</td>
            <td>${formatCurrency(price)}</td>
            <td>
                <button class="btn btn-danger btn-sm remove-item-btn">Xóa</button>
                <input type="hidden" name="order_items[][id_product]" value="${product.id}">
                <input type="hidden" name="order_items[][id_variant]" value="${variant ? variant.id_variant : ''}">
                <input type="hidden" name="order_items[][price]" value="${price}">
            </td>
        `;
        orderItemsTable.appendChild(newRow);

        // Xử lý sự kiện xóa sản phẩm
        newRow.querySelector('.remove-item-btn').addEventListener('click', function () {
            totalPrice -= price;
            document.getElementById('totalPrice').innerText = formatCurrency(totalPrice);
            document.getElementById('hiddenTotalPrice').value = totalPrice;
            newRow.remove();
        });
    }

    // Hàm áp dụng voucher
    document.getElementById('applyVoucherBtn').addEventListener('click', function () {
        const voucherCode = document.getElementById('voucherCode').value.trim();
        if (voucherCode === '') {
            alert('Vui lòng nhập mã Voucher.');
            return;
        }

        // Tìm voucher theo mã nhập vào
        const voucher = vouchers.find(v => v.code === voucherCode && v.status === 'active');
        if (!voucher) {
            alert('Voucher không hợp lệ hoặc đã hết hạn.');
            return;
        }

        // Tính toán giảm giá
        discount = voucher.discount_type === 'percentage'
                   ? totalPrice * (voucher.discount_amount / 100)
                   : voucher.discount_amount;

        discount = parseFloat(discount) || 0;

        if (totalPrice >= discount) {
            document.getElementById('discount').innerText = formatCurrency(discount);
            const discountedTotal = totalPrice - discount;
            document.getElementById('totalPrice').innerText = formatCurrency(discountedTotal);
            document.getElementById('hiddenTotalPrice').value = discountedTotal;
            alert('Voucher áp dụng thành công!');
        } else {
            alert('Giá trị đơn hàng không đủ để áp dụng voucher.');
        }
    });

    // Hàm tạo nội dung hóa đơn
    function generateInvoiceContent() {
        const orderItems = document.querySelectorAll('#orderItemsTable tbody tr');
        const invoiceItems = document.getElementById('invoiceItems');
        invoiceItems.innerHTML = '';

        let subTotal = 0;

        orderItems.forEach((item, index) => {
            const productName = item.querySelectorAll('td')[1].innerText;
            const color = item.querySelectorAll('td')[2].innerText;
            const size = item.querySelectorAll('td')[3].innerText;
            const priceText = item.querySelectorAll('td')[4].innerText.replace(/[^0-9]/g, "");
            const price = parseFloat(priceText) || 0;
            const quantity = 1;
            const subtotal = price * quantity;
            subTotal += subtotal;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${index + 1}</td>
                <td>${productName} (${color}, ${size})</td>
                <td>${quantity}</td>
                <td>${price.toLocaleString('vi-VN')} VND</td>
                <td>${subtotal.toLocaleString('vi-VN')} VND</td>
            `;
            invoiceItems.appendChild(newRow);
        });

        const totalPayment = subTotal - discount;

        document.getElementById('subTotal').innerText = subTotal.toLocaleString('vi-VN') + ' VND';
        document.getElementById('discount').innerText = discount.toLocaleString('vi-VN') + ' VND';
        document.getElementById('invoiceTotal').innerText = totalPayment.toLocaleString('vi-VN') + ' VND';

        const invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
        invoiceModal.show();
    }

    // Gọi hàm generateInvoiceContent khi nhấn "Hoàn tất Đơn hàng"
  // Hàm để in PDF từ hóa đơn

  function generateInvoicePDF() {
            const invoice = document.getElementById('invoice');
            html2canvas(invoice, { scale: 2 }).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');
                const pdfWidth = pdf.internal.pageSize.width;
                const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('Hoa_Don_Ban_Hang.pdf');
            });
        }

        // Gọi hàm generateInvoiceContent khi nhấn "Hoàn tất Đơn hàng"
        document.querySelector('button.btn-success').addEventListener('click', generateInvoiceContent);

        // Gọi hàm generateInvoicePDF khi nhấn nút "In Hóa Đơn"
        document.querySelector('#invoiceModal .btn-primary').addEventListener('click', generateInvoicePDF);
    });





</script>
