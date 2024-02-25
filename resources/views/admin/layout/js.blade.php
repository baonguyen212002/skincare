<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('admin/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/filer/js/jquery.filer.min.js') }}"></script>
<!-- Initialize CKEditor -->
@stack('scripts')
<script>
    var options = {
        filebrowserImageBrowseUrl: '/filemanager?type=Images',
        filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/filemanager?type=Files',
        filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('ckeditor1', options);
    CKEDITOR.replace('ckmota', options);
    CKEDITOR.replace('ckcontent', options);
    $(document).ready(function() {
        $('#filer_input').filer({
            limit: 3,
            maxSize: 3,
            extensions: ["jpg", "png", "gif", "webp"],
            changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
            showThumbs: true,
            theme: "dragdropbox",
            addMore: true,
        });
        $('.filer_input2').filer({
            limit: 1,
            maxSize: 1,
            extensions: ["jpg", "png", "gif", "webp"],
        });

    });
    $(document).ready(function() {
        var isNotificationShown = false; // Biến kiểm soát thông báo

        $('#selectAllCheckbox').click(function() {
            $('.productCheckbox').prop('checked', this.checked);
        });

        $('.productCheckbox').change(function() {
            if ($('.productCheckbox:checked').length == $('.productCheckbox').length) {
                $('#selectAllCheckbox').prop('checked', true);
            } else {
                $('#selectAllCheckbox').prop('checked', false);
            }
        });

        // Xử lý sự kiện khi nút Xóa được click
        $('#deleteSelected').click(function() {

            var selectedProductListIds = $('input[name="selectedProductsList[]"]:checked').map(
                function() {
                    return $(this).val();
                }).get();
            var selectedProductCatIds = $('input[name="selectedProductsCat[]"]:checked').map(
                function() {
                    return $(this).val();
                }).get();
            var selectedProductItemIds = $('input[name="selectedProductsItem[]"]:checked').map(
                function() {
                    return $(this).val();
                }).get();

            // Kiểm tra nếu không có sản phẩm nào được chọn
            if (selectedProductListIds.length === 0 && selectedProductCatIds.length === 0 &&
                selectedProductItemIds.length === 0) {
                alert('Vui lòng chọn ít nhất một sản phẩm để xóa.');
                return; // Dừng việc thực hiện tiếp theo
            }

            // Tạo mảng chứa thông tin yêu cầu AJAX
            var ajaxRequests = [];

            // Thêm yêu cầu AJAX cho sản phẩm trong danh sách
            if (selectedProductListIds.length > 0) {
                ajaxRequests.push({
                    url: '{{ route('product.list.destroyAll') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productIds: selectedProductListIds
                    }
                });
            }

            // Thêm yêu cầu AJAX cho sản phẩm trong danh mục
            if (selectedProductCatIds.length > 0) {
                ajaxRequests.push({
                    url: '{{ route('product.cat.destroyAll') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productIds: selectedProductCatIds
                    }
                });
            }

            if (selectedProductItemIds.length > 0) {
                ajaxRequests.push({
                    url: '{{ route('product.cat.destroyAll') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productIds: selectedProductItemIds
                    }
                });
            }

            // Duyệt qua mảng và thực hiện các yêu cầu AJAX
            ajaxRequests.forEach(function(request) {
                $.ajax({
                    url: request.url,
                    method: 'post',
                    data: request.data,
                    success: function(response) {
                        if (response.success) {
                            // Loại bỏ các hàng của sản phẩm đã xóa
                            $.each(request.data.productIds, function(index,
                                productId) {
                                $('input[value="' + productId + '"]')
                                    .closest('tr').remove();
                            });
                        } else {
                            alert('Lỗi: ' + response.message);
                        }
                    },
                    error: function(error) {
                        console.error('Lỗi khi gửi yêu cầu xóa: ', error);
                    }
                });
            });
        });
    });

    $(document).ready(function() {
        var deleteForm;

        // Lắng nghe sự kiện click trên nút xóa
        $('.modify-table').on('click', '.delete-btn', function() {
            deleteForm = $(this).closest('.delete-form');
        });

        // Lắng nghe sự kiện click trên nút xác nhận trong modal
        $('#confirmDeleteButton').click(function() {
            // Kiểm tra xem form có tồn tại không
            if (deleteForm) {
                // Submit form nếu đã xác nhận
                deleteForm.submit();
            }

            // Đóng modal
            $('#confirmDeleteModal').modal('hide');
        });
    });
    $(document).ready(function() {
        // Xác định thời gian (đơn vị: mili giây) bạn muốn thông báo tự động ẩn đi
        var autoHideDelay = 3000;

        // Tìm thông báo và thêm logic ẩn đi sau N giây
        $('#success-message, #error-message').delay(autoHideDelay).fadeOut();
        $('.highlight-checkbox, .visible-checkbox').change(function() {
            var table = $(this).data('table');
            var id = $(this).data('id');
            var isChecked = $('.highlight-checkbox[data-id="' + id + '"]').prop('checked');
            var isVisible = $('.visible-checkbox[data-id="' + id + '"]').prop('checked');

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/update-status/' + table,
                type: 'POST',
                data: {
                    id: id,
                    isChecked: isChecked ? 1 : 0,
                    isVisible: isVisible ? 1 : 0,
                    _token: csrfToken,
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<script>
    $.widget.bridge('uibutton', $.ui.button)

    function slugAlert(result, lang) {
        if (result == 1) {
            $("#alert-slug-danger" + lang).addClass("d-none");
            $("#alert-slug-success" + lang).removeClass("d-none");
        } else if (result == 0) {
            $("#alert-slug-danger" + lang).removeClass("d-none");
            $("#alert-slug-success" + lang).addClass("d-none");
        } else if (result == 2) {
            $("#alert-slug-danger" + lang).addClass("d-none");
            $("#alert-slug-success" + lang).addClass("d-none");
        }
    }

    function slugCheck() {
        var sluglang = "vi,en";
        var slugInput = $('.slug-input');
        var id = $('.slug-id').val();
        var copy = $('.slug-copy').val();

        slugInput.each(function(index) {
            var slugId = $(this).attr('id');
            var slug = $(this).val();
            var lang = slugId.substr(slugId.length - 2);
            if (sluglang.indexOf(lang) >= 0) {
                if (slug) {
                    $.ajax({
                        url: 'ajax/ajax_slug.php',
                        type: 'POST',
                        dataType: 'html',
                        async: false,
                        data: {
                            slug: slug,
                            id: id,
                            copy: copy
                        },
                        success: function(result) {
                            slugAlert(result, lang);
                        }
                    });
                }
            }
        });
    }
    $('.submit-check').click(function(event) {
        var $this;

        /* Holdon */
        holdonOpen("sk-rect", "Vui lòng chờ...", "rgba(0,0,0,0.8)", "white");

        /* Check slug */
        slugCheck();

        /* Check slug danger */
        var elementSlug = $('.card-slug .text-danger:not(.d-none)');
        if (elementSlug.length) {
            elementSlug.each(function() {
                $this = $(this);
                var closest = elementSlug.closest('.tab-pane');
                var id = closest.attr('id');

                $('.nav-tabs a[href="#' + id + '"]').tab('show');

                return false;
            });

            setTimeout(function() {
                $('html,body').animate({
                    scrollTop: $this.offset().top - 110
                }, 'medium');
            }, 500);

            holdonClose();

            return false;
        }

        holdonClose();
    });
    // auto create slug
    function generateSlug() {
        var inputName = document.getElementById('inputName');
        var inputTenKhongDauVi = document.getElementById('inputTenKhongDauVi');

        if (inputName && inputTenKhongDauVi) {
            var inputValue = inputName.value;
            // Thực hiện quá trình tạo đường dẫn tiếng Việt ở đây
            var slug = convertToSlug(inputValue);
            inputTenKhongDauVi.value = slug;
        }
    }

    function convertToSlug(text) {
        // Chuyển đổi tiếng Việt có dấu sang không dấu
        text = text.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');

        // Chuyển đổi thành slug
        return text.replace(/[^\w ]+/g, '').replace(/ +/g, '-');
    }
</script>
