@extends('nav.admin')

@section('admin_main')
    <div style="padding: 40px;">
        <form action="{{route('posts.update',['id' => $post->id])}}" method="post">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{$post->title}}" required>
            </div>
            <div class="form-group">
                <label for="description">Site to be displayed on</label>
                <select class="form-control" name="description" id="description">
                    @foreach($sites as $st)
                        @if($post->description_id == $st->id)
                            <option selected="selected" value="{{$st->id}}"> {{$st->description}} </option>
                        @else
                            <option value="{{$st->id}}"> {{$st->description}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="jqte" type="text" class="form-control" name="content" id="content" required>{{$post->content}}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
        @if(isset($request))
            {{ $request }}}
        @endif
    </div>
@endsection