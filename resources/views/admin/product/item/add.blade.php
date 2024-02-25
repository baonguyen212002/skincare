@extends('admin.layout.master')
@section('content')
    <?php if(session('usuccess')) { ?>
    <div class ="alert alert-danger">
        <?php echo session('usuccess'); ?>
    </div>
    <?php }?>
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh Mục Cấp 3</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add New Protype</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('product.item.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" class="form-control" value="<?php if (session('name')) {
                                    echo session('name');
                                } ?>"
                                    name="name" required>
                            </div>
                            <div class="form-group">
                                <select id="type" class="form-control custom-select" name="id_list">
                                    <option value="">Danh mục cấp 1</option>
                                    <?php
                                    foreach ($pro_list as $value) {
                                    ?>
                                    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="type" class="form-control custom-select" name="id_cat">
                                    <option value="">Danh mục cấp 2</option>
                                    <?php
                                    foreach ($pro_cat as $value) {
                                    ?>
                                    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('product.item.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right">Add</button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection
