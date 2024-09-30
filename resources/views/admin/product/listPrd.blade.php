@include('admin.headerAdmin')
<div class="row mt-3 ms-2 container mt-4">
    <div>
        <div><a href="{{route('add.product')}}" class="btn btn-success">Thêm sản phẩm</a></div>
    </div>
    <div class="col-md-9 mt-2">
        <table class="table border">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Ngày thêm</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $prd )
                 @php
                        //Nhóm các phần tử lại thành mảng
                       $quantities = explode(',', $prd->attribute_quantities);
                       // Cộng các phần tử trong mảng lại
                       $totalQuantity = array_sum($quantities);
                 @endphp
                <tr>

                    <td>{{$prd->id_product}}</td>
                    <td>{{$prd->product_name}}</td>
                    <td>{{$prd->updated_at}}</td>
                    <td>{{$totalQuantity}}</td>
                    <td>
                          {{-- Kiếm tra số lượng còn hay không  --}}
                         @if($totalQuantity==0)

                            <span class="badge bg-danger">Hết hàng</span>
                         @else
                         <span class="badge bg-success">Còn hàng</span>
                         @endif

                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-light" type="button" id="dropdownMenuButton">...</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Xóa</a>
                                <a class="dropdown-item" href="#">Thêm/Xóa thuộc tính</a>
                                <a class="dropdown-item" href="#">Sửa</a>
                                <a class="dropdown-item" href="#">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#" style="height: 35px;"><i class='bx bx-chevrons-left'></i></a></li>
                <li class="page-item"><a class="page-link" href="#" style="height: 35px;">1</a></li>
                <li class="page-item"><a class="page-link" href="#" style="height: 35px;">2</a></li>
                <li class="page-item"><a class="page-link" href="#" style="height: 35px;">3</a></li>
                <li class="page-item"><a class="page-link" href="#" style="height: 35px;"><i class='bx bx-chevrons-right'></i></a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-3 mt-2">
        <div class="bg-white d-flex p-4 rounded-3 border">
            <div>
                <h5>Tìm kiếm tại đây</h5>
                <div class="d-flex">
                    <input type="text" class="form-control rounded-0 btn-sm" placeholder="Nike, Adidas">
                    <button class="btn btn-white border rounded-0 btn-sm"><i class='bx bx-search-alt-2'></i></button>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="bg-white border p-4 rounded-3">
                <h5>Danh mục</h5>
                <div>
                    <p><input type="checkbox" name="" id=""> Nike</p>
                    <p><input type="checkbox" name="" id=""> Adidas</p>
                    <p><input type="checkbox" name="" id=""> Khác</p>
                </div>
                <div>
                    <button class="w-100 btn btn-primary">Lọc</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footerAdmin')
