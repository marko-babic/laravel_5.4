@extends('nav.admin')

@section('admin_main')
    <div style="padding: 40px;">
        <form action="/posts/{{$post->id}}" method="post">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{$post->title}}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="jqte" type="text" class="form-control" name="content" required>{{$post->content}}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        @if(isset($request))
            {{ $request }}}
        @endif
    </div>
@endsection