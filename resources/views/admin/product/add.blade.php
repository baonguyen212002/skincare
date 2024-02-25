@extends('admin.layout.master')
@section('content')
    <?php if (session('usuccess')) { ?>
    <div class="alert alert-danger">
        <?php echo session('usuccess'); ?>
    </div>
    <?php } ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add New Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputTenKhongDauVi">Đường dẫn tiếng Việt</label>
                                <input type="text" id="inputTenKhongDauVi" class="form-control" name="tenkhongdauvi">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" class="form-control"
                                    value="{{ htmlspecialchars(session('name')) }}" name="name" required
                                    oninput="generateSlug()">
                                <label for="inputPrice">Price</label>
                                <input type="number" id="price" class="form-control" step="any"
                                    value="{{ htmlspecialchars(session('price')) }}" name="price" required>
                                <div class="form-group">
                                    <label for="inputType">Danh mục cấp 1:</label>
                                    <select id="type" class="form-control custom-select" name="id_list">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($list as $value)
                                            <option value="{{ $value['id'] }}">{{ htmlspecialchars($value->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputType">Danh mục cấp 2:</label>
                                    <select id="type" class="form-control custom-select" name="id_cat">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($cat as $value)
                                            <option value="{{ $value['id'] }}">{{ htmlspecialchars($value->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputType">Danh mục cấp 3:</label>
                                    <select id="type" class="form-control custom-select" name="id_item">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($item as $value)
                                            <option value="{{ $value['id'] }}">{{ htmlspecialchars($value->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputType">Thương hiệu:</label>
                                    <select id="type" class="form-control custom-select" name="id_brand">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($brand as $value)
                                            <option value="{{ $value['id'] }}">{{ htmlspecialchars($value->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage1">Product Image</label>
                                    <input type="file" name="image" id="inputImage1" class="form-control filer_input2"
                                        accept="image/*" onchange="validateFileType('inputImage1')" />
                                    <img id="blah" src="#" alt="your image" style="display:none" width="150"
                                        height="150" />
                                </div>
                                <div class="form-group">
                                    <label for="inputImage1">Album</label>
                                    <input type="file" name="images[]" id="filer_input" multiple="multiple"
                                        accept="image/*">

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <textarea name="description" id="ckeditor1" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputInfomation">Content</label>
                                <textarea id="ckcontent" class="form-control" rows="4" name="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right">Add</button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script type="text/javascript">
        function validateFileType(name) {
            var fileName = document.getElementById(name).value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "webp") {
                console.log(extFile);
                //TO DO
                const [file1] = inputImage1.files
                if (file1) {
                    blah.src = URL.createObjectURL(file1)
                    document.getElementById("blah").style.display = ""
                }
                // const [file2] = inputImage2.files
                // if (file2) {
                //     blah2.src = URL.createObjectURL(file2)
                //     document.getElementById("blah2").style.display = ""
                // }
                // const [file3] = inputImage3.files
                // if (file3) {
                //     blah3.src = URL.createObjectURL(file3)
                //     document.getElementById("blah3").style.display = ""
                // }
                // const [file4] = inputImage4.files
                // if (file4) {
                //     blah4.src = URL.createObjectURL(file4)
                //     document.getElementById("blah4").style.display = ""
                // }
            } else {
                alert("Only jpg/jpeg/png/webp and png files are allowed!");
                document.getElementById(name).value = "";
            }
        }
    </script>
    <script>
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
            return text.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    </script>
@endsection
