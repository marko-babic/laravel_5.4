<form action="/ticket/reply/{{$info["ticket"]->id}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="content">Content</label>
        <textarea rows="10" class="form-control" name="content" placeholder="Explain your problem/concern here" required></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-default">Reply</button>
    </div>
</form>