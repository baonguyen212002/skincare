@extends('admin.layout.master')
@section('content')
    <?php if (session('success')) { ?>
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    <?php } ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a class="btn btn-sm bg-gradient-primary"
                                href="{{ route('product.create') }}"><i class="fas fa-plus mr-2"></i>Create New Product</a>
                        </li>
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
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0" style="overflow-x: auto;">
                <table class="table table-striped projects modify-table">

                    <thead>
                        <tr>
                            <th style="width: 1%">ID</th>
                            <th style="width: 5%">Image</th>
                            <th style="width: 20%">Name</th>
                            <th style="width: 5%">Price</th>
                            <th style="width: 5%;text-align:center">Highlight</th>
                            <th style="width: 5%;text-align:center">Visible</th>
                            <th style="width: 14%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($product->items() as $value)
                            <tr>
                                <td>{{ $value['id'] }}</td>
                                <td>
                                    @if ($value['image'] > 0)
                                        <img src="{{ asset('images/products/' . $value['image']) }}" width="70px"
                                            height="70px" alt="{{ $value->name }}">
                                    @else
                                        <img src="{{ asset('images/noimage.png') }}" width="70px" height="70px"
                                            alt="" srcset="">
                                    @endif
                                </td>
                                <td>
                                    @if (strlen($value->name) < 100)
                                        {{ $value->name }}
                                    @else
                                        {{ substr($value->name, 0, 100) . '...' }}
                                    @endif
                                </td>

                                <td>{{ number_format($value->price) }}</td>
                                <td style="text-align: center">
                                    <input type="checkbox" class="highlight-checkbox" data-id="{{ $value['id'] }}"
                                        data-table="{{ strtolower(class_basename($value)) }}"
                                        {{ $value['highlight'] ? 'checked' : '' }}>
                                </td>
                                <td style="text-align: center">
                                    <input type="checkbox" class="visible-checkbox" data-id="{{ $value['id'] }}"
                                        data-table="{{ strtolower(class_basename($value)) }}"
                                        {{ $value['visible'] ? 'checked' : '' }}>
                                </td>
                                <td class="project-actions text-left">
                                    <form method="POST" action="{{ route('product.destroy', ['id' => $value['id']]) }}">
                                        <a class="btn btn-info btn-sm modify-icon"
                                            href="{{ route('product.edit', ['id' => $value['id']]) }}">
                                            <i class="fas fa-pencil-alt ">
                                            </i>
                                            Edit
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm modify-icon">
                                            <i class="fas fa-trash ">
                                            </i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $product->onEachSide(1)->appends(request()->all())->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
