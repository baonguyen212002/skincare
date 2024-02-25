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
                    <h1>
                        @if ($type == 'admin.policy.index')
                            Chính sách
                        @elseif ($type == 'admin.news.index')
                            Tin tức
                        @endif
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            @if ($type == 'admin.policy.index')
                                Chính sách
                            @elseif ($type == 'admin.news.index')
                                Tin tức
                            @endif
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @php
            if ($type == 'admin.policy.index') {
                $link = route('admin.policy.create', ['act' => 'add', 'type' => 'chinh-sach', 'p' => 1]);
            } elseif ($type == 'admin.news.index') {
                $link = route('admin.news.create', ['act' => 'add', 'type' => 'tin-tuc', 'p' => 1]);
            }
        @endphp

        <a class="btn btn-sm bg-gradient-primary" href="{{ $link }}">
            <i class="fas fa-plus mr-2"></i>Thêm
        </a>


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
                            @if ($type == 'admin.news.index')
                                <th style="width: 5%">Image</th>
                            @endif
                            <th style="width: 20%">Title</th>
                            <th style="width: 5%">Mô tả</th>
                            <th style="width: 5%;text-align:center">Highlight</th>
                            <th style="width: 5%;text-align:center">Visible</th>
                            <th style="width: 14%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($items as $value)
                            <tr>
                                <td>{{ $value['id'] }}</td>
                                <td>
                                <td>
                                    @if ($type == 'admin.news.index' && $value['image'] > 0)
                                        <img src="{{ asset('images/products/' . $value['image']) }}" width="70px"
                                            height="70px" alt="{{ $value->name }}">
                                    @elseif ($type == 'admin.news.index')
                                        <img src="{{ asset('images/noimage.png') }}" width="70px" height="70px"
                                            alt="" srcset="">
                                    @endif
                                </td>

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
                {{-- {{ $items->onEachSide(1)->appends(request()->all())->links() }} --}}

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
