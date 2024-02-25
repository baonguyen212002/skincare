@extends('admin.layout.master')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="content">
        <form
            @if (isset($static)) action="{{ route('admin.static.update', $static->id) }}"
    @else
        action="{{ route('admin.static.store') }}" @endif
            method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($static))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Nội dung giới thiệu</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputVisible">Hiển thị:</label>
                                <input type="checkbox" class="visible-checkbox"
                                    @if ($static && $static['visible']) checked @endif
                                    data-id="{{ $static ? $static['id'] : '' }}"
                                    data-table="{{ strtolower($staticTableName) }}">
                            </div>
                            <div class="form-group">
                                <label for="inputTenKhongDauVi">Đường dẫn tiếng Việt</label>
                                <input type="text" id="inputTenKhongDauVi" class="form-control" name="slug"
                                    value="{{ $static->slug ?? '' }}">
                                <p class="alert-slug text-danger d-none mt-2 mb-0" id="alert-slug-danger">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <span>Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.</span>
                                </p>
                                <p class="alert-slug text-success d-none mt-2 mb-0" id="alert-slug-success">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <span>Đường dẫn hợp lệ.</span>
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input type="text" id="inputName" class="form-control" name="title" id="title"
                                    value="{{ $static['title'] ?? '' }}" oninput="generateSlug()">
                            </div>
                            <div class="form-group">
                                <label for="inputMota">Mô tả</label>
                                <textarea type="text" class="form-control" name="mota" id="ckmota">{{ htmlspecialchars_decode($static->mota ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputContent">Nội dung</label>
                                <textarea type="text" class="form-control" id="ckcontent" name="content">{{ htmlspecialchars_decode($static->content ?? '') }}</textarea>
                            </div>
                            <input type="hidden" name="type" value="gioi-thieu">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <button type="submit" class="btn btn-success float-right">Add</button>
                </div>
            </div>
        </form>
    </section>
@endsection
