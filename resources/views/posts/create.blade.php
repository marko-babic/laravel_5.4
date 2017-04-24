@extends('nav.admin')

@section('admin_main')
    <div style="padding: 40px;">
        <form action="{{route('posts.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="description">Site to be displayed</label>
                <select class="form-control" name="description" id="description">
                    @foreach($sites as $st)
                            <option value="{{$st->id}}"> {{$st->description}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" placeholder="Content" id="content" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>
@endsection