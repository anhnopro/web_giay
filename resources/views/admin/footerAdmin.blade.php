
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Xóa sản phẩm</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
            <!-- Modal body -->
            <div class="modal-body">
              Bạn có muốn xóa không?
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
        $('#variantDetailForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn không cho form gửi theo cách thông thường

            var form = $(this);
            var actionUrl = form.attr('action');
            var formData = new FormData(this);

            $.ajax({
                url: actionUrl,
                type: 'POST', // Sử dụng POST vì bạn đã sử dụng @method('PUT')
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Hiển thị thông báo thành công
                    $('#detailModal .modal-body').prepend('<div class="alert alert-success">Cập nhật biến thể sản phẩm thành công!</div>');
                    // Đóng modal sau một thời gian ngắn
                    setTimeout(function(){
                        $('#detailModal').modal('hide');
                        // Cập nhật bảng biến thể hoặc reload trang
                        location.reload(); // Hoặc sử dụng AJAX để cập nhật bảng
                    }, 2000);
                },
                error: function(xhr) {
                    // Hiển thị thông báo lỗi
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value){
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('#detailModal .modal-body').prepend(errorHtml);
                }
            });
        });
    });
    </script>

  </body>
  </html>
