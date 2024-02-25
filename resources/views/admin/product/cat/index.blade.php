@extends('admin.layout.master')
@section('content')
    <!-- Content Header (Page header) -->

        @if (session('success'))
            <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('unsuccess'))
            <div id="error-message" class="alert alert-danger">
                {{ session('unsuccess') }}
            </div>
        @endif
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Protype</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a class="btn btn-sm bg-gradient-primary"
                                    href="{{ route('product.cat.create') }}"><i class="fas fa-plus mr-2"></i>Create
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
                    {{-- <h3 class="card-title">Total Protypes: {{ count($allProtypes) }}</h3> --}}

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
                                <th style="width: 10%">ID</th>
                                <th style="width: 20%">Name</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pro_cat as $value)
                                <tr>
                                    <th>
                                        <div class="my-custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" name="selectedProductsCat[]" value="{{ $value['id'] }}"
                                                class="productCheckbox">
                                        </div>
                                    </th>
                                    <td>{{ $value['id'] }}</td>
                                    <td>{{ $value['name'] }}</td>
                                    <td class="project-actions text-left">
                                        <form method="POST"
                                            action="{{ route('product.cat.destroy', ['id' => $value['id']]) }}"
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
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pro_cat->onEachSide(1)->appends(request()->all())->links() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection
