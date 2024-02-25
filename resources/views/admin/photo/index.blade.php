@extends('admin.layout.master')
@section('content')
    <!-- Content Header (Page header) -->

    @if (session('success'))
        <div class ="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('unsuccess'))
        <div class ="alert alert-danger">
            {{ session('unsuccess') }}
        </div>
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SlideShow</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a class="btn btn-sm bg-gradient-primary"
                                href="{{ route('photo.create') }}"><i class="fas fa-plus mr-2"></i>Create
                                New</a>
                        </li>
                        <li class="breadcrumb-item"><button id="deleteSelected" class="btn btn-sm btn-danger">Xóa tất
                                cả</button></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                {{-- <h3 class="card-title">Total Protypes: {{ count($allProtypes)}}</h3> --}}

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects modify-table">
                    <thead>
                        <tr>
                            <th class="align-middle" style="width:5%">
                                <div class="my-custom-control custom-checkbox my-checkbox">
                                    <input type="checkbox" id="selectAllCheckbox" class="productCheckbox">
                                </div>
                            </th>
                            <th class="align-middle" style="width: 10%">STT</th>
                            <th class="align-middle text-center" style="width: 8%">Image</th>
                            <th class="align-middle" style="width: 20%">Title</th>
                            <th class="align-middle">Link</th>
                            <th class="align-middle text-center" style="width: 5%">Highlight</th>
                            <th class="align-middle text-center" style="width: 5%">Visible</th>
                            <th class="align-middle text-center" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($photo as $value) { ?>
                        <tr>
                            <th class="align-middle text-center text-md text-nowrap">
                                <div class="my-custom-control custom-checkbox my-checkbox">
                                    <input type="checkbox" name="selectedProductsList[]" value="{{ $value['id'] }}"
                                        class="productCheckbox">
                                </div>
                            </th>
                            <td>{{ $value['stt'] }}</td>
                            <td>
                                @if ($value['image'] > 0)
                                    <img src="{{ asset('storage/'.$value['image']) }}" width="131px"
                                        height="55px" alt="{{ $value->name }}">
                                @else
                                    <img src="{{ asset('images/noimage.png') }}" width="70px" height="70px"
                                        alt="" srcset="">
                                @endif
                            </td>
                            <td>{{ $value['title'] }}</td>
                            <td>{{ $value['link'] }}</td>
                            <td style="text-align: center">
                                <input type="checkbox" class="highlight-checkbox" data-id="{{ $value['id'] }}"
                                    data-table="{{ Str::snake(class_basename($value)) }}"
                                    {{ $value['highlight'] ? 'checked' : '' }}>
                            </td>
                            <td style="text-align: center">
                                <input type="checkbox" class="visible-checkbox" data-id="{{ $value['id'] }}"
                                    data-table="{{ Str::snake(class_basename($value)) }}"
                                    {{ $value['visible'] ? 'checked' : '' }}>
                            </td>
                            <td class="align-middle text-center text-md text-nowrap">
                                <form method="POST" action=""
                                    class="delete-form">
                                    <a class="btn btn-info btn-sm modify-icon" href="">
                                        <i class="fas fa-pencil-alt ">
                                        </i>
                                        Edit
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm modify-icon delete-btn"
                                        data-toggle="modal" data-target="#confirmDeleteModal">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                {{ $photo->onEachSide(1)->appends(request()->all())->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
