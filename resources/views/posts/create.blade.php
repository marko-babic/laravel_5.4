@extends('nav.admin')

@section('admin_main')
    <div style="padding: 40px;">
        <form action="{{secure_url('posts')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="jqte" rows="20" type="text" class="form-control" name="content" placeholder="Content" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>
@endsection