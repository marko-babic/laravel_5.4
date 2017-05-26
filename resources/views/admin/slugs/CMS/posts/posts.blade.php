
<table class="table cms">
    <thead>
        <tr>
            <td> Id </td>
            <td> Title </td>
            <td> Section </td>
            <td> Date </td>
            <td> Action </td>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td> {{$post->id}} </td>
            <td> {!! $post->title !!} </td>
            <td> {{$post->navbar->description}}</td>
            <td> {{$post->created_at->format('m/d/Y')}} </td>
            <td>
                <a href="{{route('posts.edit', ['id' => $post->id])}}" target="_blank"><span class="glyphicon glyphicon-edit" title="Edit post"></span></a>
                <span onClick="removePost({{$post->id}})" title="Remove post" class="remove-post glyphicon glyphicon-remove"> </span>
            </td>
        </tr>
        @endforeach
        <tr>
            <td> <a href="{{route('posts.create')}}">Add new ?</a> </td>
        </tr>
    </tbody>
</table>

