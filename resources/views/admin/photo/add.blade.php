@extends('admin.layout.master')
@section('content')
<div class="container">
    <h2>Add New Slide</h2>
    <form action="{{ route('photo.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Slide Image</label>
            <input type="file" class="form-control" id="image" name="image" >
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Slide Title</label>
            <input type="text" class="form-control" id="title" name="title" >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Slide Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" ></textarea>
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Slide Link</label>
            <input type="text" class="form-control" id="link" name="link" placeholder="Optional link">
        </div>
        <input type="hidden" name="type" value="slide">
        <button type="submit" class="btn btn-primary">Add Slide</button>
    </form>
</div>
@endsection
