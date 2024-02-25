@extends('admin.layout.master')
@section('content')
    <section class="content">
        <form action="" method="post">
            @csrf
            <div class="card-footer text-sm sticky-top">
                <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i
                        class="far fa-save mr-2"></i>Lưu</button>
                <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i
                        class="far fa-save mr-2"></i>Lưu tại trang</button>
                <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                    lại</button>
                <a class="btn btn-sm bg-gradient-danger" href="{{ route('admin.news.index') }}" title="Thoát"><i
                        class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            </div>
            <div class="row">
                <div class="{{ Str::contains(request()->url(), '/chinh-sach/') ? 'col-12' : 'col-xl-8' }}">
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Đường dẫn</h3>
                            <span class="pl-2 text-danger">(Vui lòng không nhập trùng tiêu đề)</span>
                        </div>
                        <div class="card-body card-slug">
                            <div class="form-group">
                                <label for="inputTenKhongDauVi">Đường dẫn tiếng Việt</label>
                                <input type="text" id="inputTenKhongDauVi" class="form-control" name="slug">
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Nội dung tin tức</h3>
                        </div>
                        <div class="card-body card-slug">
                            <div class="form-group">
                                <label for="inputTenKhongDauVi">Tiêu đề</label>
                                <input type="text" id="inputTenKhongDauVi" class="form-control" name="title"
                                    oninput="generateSlug()" placeholder="Tiêu đề">
                            </div>
                            <div class="form-group">
                                <label for="inputMota">Mô tả</label>
                                <textarea class="form-control" name="mota" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputNoidung">Nội dung</label>
                                <textarea name="content" id="ckcontent" cols="30" rows="10"></textarea>
                            </div>
                            <input type="hidden" name="type" value="{{ request('type') === 'chinh-sach' ? 'chinh-sach' : 'tin-tuc' }}">
                        </div>
                    </div>
                </div>
                @if (!$isPolicyPage)
                    <div class="col-xl-4">
                        <div class="card card-primary card-outline text-sm">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Hình ảnh
                                </h3>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </form>
    </section>
@endsection
