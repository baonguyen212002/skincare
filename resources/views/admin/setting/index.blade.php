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
                    <h1>Thiết lập thông tin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ $setting && $setting->exists ? route('settings.update', $setting->id) : route('settings.store') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-6">
                                    <label for="mail_host">Host</label>
                                    <input type="text" name="options[mail_host]" class="form-control"
                                        value="{{ old('options.mail_host', $setting->options['mail_host'] ?? '') }}">
                                </div>
                                <div class="form-group col-md-4 col-sm-6">
                                    <label for="mail_port">Port</label>
                                    <input type="text" name="options[mail_port]" class="form-control"
                                        value="{{ old('options.mail_port', $setting->options['mail_port'] ?? '') }}">
                                </div>

                                <div class="form-group col-md-4 col-sm-6">
                                    <label for="secure_host">Encryption:</label>
                                    <select class="form-control" name="options[mail_encryption]" id="secure_host">
                                        <option
                                            {{ $setting && $setting->options['mail_encryption'] == 'tls' ? 'selected' : '' }}
                                            value="tls">TLS</option>
                                        <option
                                            {{ $setting && $setting->options['mail_encryption'] == 'ssl' ? 'selected' : '' }}
                                            value="ssl">SSL</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-6">
                                    <label for="mail_username">Username</label>
                                    <input type="email" name="options[mail_username]" class="form-control"
                                        value="{{ old('options.mail_username', $setting->options['mail_username'] ?? '') }}">
                                </div>
                                <div class="form-group col-md-4 col-sm-6">
                                    <label for="mail_password">Password</label>
                                    <input type="text" name="options[mail_password]" class="form-control"
                                        value="{{ old('options.mail_password', $setting->options['mail_password'] ?? '') }}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4 col-md-6"><label for="">Địa chỉ</label>
                                    <input type="text"class="form-control" name="options[diachi]"
                                        value="{{ $setting->options['diachi'] ?? '' }}">
                                </div>
                                <div class="form-group col-md-4 col-md-6"><label for="">Email</label>
                                    <input type="email"class="form-control" name="options[email]"
                                        value="{{ $setting->options['email'] ?? '' }}">
                                </div>
                                <div class="form-group col-md-4 col-md-6"><label for="">Hotline</label>
                                    <input type="text"class="form-control" name="options[hotline]"
                                        value="{{ $setting->options['hotline'] ?? '' }}">
                                </div>
                                <div class="form-group col-md-4 col-md-6"><label for="">Điện thoại</label>
                                    <input type="text"class="form-control" name="options[dienthoai]"
                                        value="{{ $setting->options['dienthoai'] ?? '' }}">
                                </div>
                                <div class="form-group col-md-4 col-md-6"><label for="">Website</label>
                                    <input type="text"class="form-control" name="options[website]"
                                        value="{{ $setting->options['website'] ?? '' }}">
                                </div>
                                <div class="form-group col-md-4 col-md-6"><label for="">Copyright</label>
                                    <input type="text"class="form-control" name="options[copyright]"
                                        value="{{ $setting->options['copyright'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </section>
    <!-- /.content -->
    </div>
@endsection
