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
                    <h1>Background</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <form action="{{ $bg_footer->isNotEmpty() ? route('logo.update', $bg_footer->first()->id) : route('photo.store') }}"
            method="{{ $bg_footer->isNotEmpty() ? 'put' : 'post' }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                @if ($bg_footer->isNotEmpty() && $bg_footer->first()->id)
                    <img src="{{ generateThumbnail('storage/' . $bg_footer->first()->image,768,256,true) }}" alt="{{ $bg_footer->first()->type }}"
                        class="img-thumbnail">
                @else
                    <img src="{{ asset('images/noimage.png') }}" alt="No Image" class="img-thumbnail">
                @endif
                <div>
                    <label for="image" class="form-label">Background Footer</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>

            <input type="hidden" name="type" value="bgfooter">
            <button type="submit" class="btn btn-primary">Add</button>
        </form>


        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
