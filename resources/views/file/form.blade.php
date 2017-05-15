<div id="upload_form">
    <form action="{{route('screenshot.store')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="description"> Screenshot description: </label>
            <input id="form_description" name="description" type="text" class="form-control" required>
        </div>
        <div class="form-group">
            <input id="form_file" type="file" name="screenshot" required>
        </div>
        <div class="text-center">
            <button id="upload_btn" type="submit" class="btn btn-default">Submit</button>
        </div>
    </form>
    </div>

<div id="upload_hidden">
    <div class="center-block loader">
    </div>
    <div class="text-center">
        Loading
    </div>
</div>
