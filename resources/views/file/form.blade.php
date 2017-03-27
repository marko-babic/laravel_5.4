<form action="/screenshot" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="description"> Screenshot description: </label>
        <input name="description" type="text" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="file" name="screenshot">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-default">Submit</button>
    </div>
</form>