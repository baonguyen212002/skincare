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
                    <h1>Edit Product</h1>
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
        <form action="{{ route('product.update', ['id' => $product['id']]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" class="form-control"
                                    value="{{ htmlspecialchars($product->name) }}" name="name" required>

                                <label for="inputPrice">Price</label>
                                <input type="number" id="price" class="form-control" step="any"
                                    value="{{ htmlspecialchars($product->price) }}" name="price" required>
                                <div class="form-group">
                                    <label for="inputType">Danh mục cấp 1:</label>
                                    <select id="type" class="form-control custom-select" name="id_list">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($list as $value)
                                            <option value="{{ $value->id }}"
                                                @if ($value->id == $product->id_list) selected @endif>
                                                {{ htmlspecialchars($value->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputType">Danh mục cấp 2:</label>
                                    <select id="type" class="form-control custom-select" name="id_cat">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($cat as $value)
                                            <option value="{{ $value->id }}"
                                                @if ($value->id == $product->id_list) selected @endif>
                                                {{ htmlspecialchars($value->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputType">Danh mục cấp 3:</label>
                                    <select id="type" class="form-control custom-select" name="id_item">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($item as $value)
                                            <option value="{{ $value->id }}"
                                                @if ($value->id == $product->id_list) selected @endif>
                                                {{ htmlspecialchars($value->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputType">Thương hiệu:</label>
                                    <select id="type" class="form-control custom-select" name="id_brand">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($brand as $value)
                                            <option value="{{ $value->id }}"
                                                @if ($value->id == $product->id_list) selected @endif>
                                                {{ htmlspecialchars($value->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <textarea name="description" id="ckeditor1" class="form-control" rows="5">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputInfomation">Infomation</label>
                                <textarea id="inputInfomation" class="form-control" rows="4" name="infomation"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>




                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Hình ảnh</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputImage1">Product Image</label>
                                        <input type="file" name="image" id="inputImage1"
                                            class="form-control filer_input3" accept="image/*"
                                            onchange="validateFileType('inputImage1')" />
                                        @if ($product->image)
                                            <img id="blah" src="{{ asset('images/products/' . $product->image) }}"
                                                alt="Product Image" width="150" height="150" />
                                        @else
                                            <img id="blah" src="#" alt="your image" style="display:none"
                                                width="150" height="150" />
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Dropzone.js <small><em>jQuery File Upload</em> like look</small>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div id="actions" class="row">
                                        <div class="col-lg-6">
                                            <div class="btn-group w-100">
                                                <span class="btn btn-success col fileinput-button">
                                                    <i class="fas fa-plus"></i>
                                                    <span>Add files</span>
                                                </span>
                                                <button type="submit" class="btn btn-primary col start">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Start upload</span>
                                                </button>
                                                <button type="reset" class="btn btn-warning col cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancel upload</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 d-flex align-items-center">
                                            <div class="fileupload-process w-100">
                                                <div id="total-progress" class="progress progress-striped active"
                                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                                    aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;"
                                                        data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table table-striped files" id="previews">
                                        <div id="template" class="row mt-2">
                                            <div class="col-auto">
                                                <span class="preview"><img src="data:," alt=""
                                                        data-dz-thumbnail width="80" height="80" /></span>
                                            </div>
                                            <div class="col d-flex align-items-center">
                                                <p class="mb-0">
                                                    <span class="lead" data-dz-name></span>
                                                    (<span data-dz-size></span>)
                                                </p>
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                            <div class="col-4 d-flex align-items-center">
                                                <div class="progress progress-striped active w-100" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;"
                                                        data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary start">
                                                        <i class="fas fa-upload"></i>
                                                        <span>Start</span>
                                                    </button>
                                                    <button data-dz-remove class="btn btn-warning cancel">
                                                        <i class="fas fa-times-circle"></i>
                                                        <span>Cancel</span>
                                                    </button>
                                                    <button data-dz-remove class="btn btn-danger delete">
                                                        <i class="fas fa-trash"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more
                                    examples and information about the plugin.
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    <!-- /.card -->
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
        };
    </script>
@endsection
@push('scripts')
    <script type="text/javascript">
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "{{ route('product.update', ['id' => $product->id]) }}", // Set the url
            method: 'PUT', // Specify the method as PUT
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }

        $(document).ready(function() {
            // Gửi yêu cầu Ajax để lấy danh sách hình ảnh từ cơ sở dữ liệu
            $.ajax({
                url: "{{ route('product.gallery.show', ['id' => $product->id]) }}",
                type: 'GET',
                success: function(response) {
                    // Thêm các hình ảnh đã có vào Dropzone để hiển thị
                    response.data.forEach(function(image) {
                        var mockFile = {
                            name: image.image
                        }; // Chỉnh sửa dữ liệu mẫu nếu cần thiết
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile,
                            '{{ url('images/gallery/') }}/' + image.image);
                        myDropzone.emit("complete", mockFile);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endpush
