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
                    <h1>Logo</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <form action="{{ $logo->isNotEmpty() ? route('logo.update', $logo->first()->id) : route('photo.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                @if ($logo->isNotEmpty() && $logo->first()->id)
                    <img src="{{ asset('storage/'.$logo->first()->image) }}" alt="{{ $logo->first()->type }}" class="img-thumbnail">
                @else
                    <img src="{{ asset('images/noimage.png') }}" alt="No Image" class="img-thumbnail">
                @endif
                <div>
                    <label for="image" class="form-label">Logo</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>

            <input type="hidden" name="type" value="logo">
            <button type="submit" class="btn btn-primary">Add logo</button>
        </form>


        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
