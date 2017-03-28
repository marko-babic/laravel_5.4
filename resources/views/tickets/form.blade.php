<form action="{{secure_url('ticket')}}" method="post">
    {{ csrf_field() }}
     <div class="form-group">
        <label for="title">Reason</label>
        <select class="form-control" name="option">
            <option value="1">General question</option>
            <option value="2">Bug report</option>
            <option value="3">Cheater report</option>
            <option value="4">Technical question</option>
        </select>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea rows="10" class="form-control" name="content" placeholder="Explain your problem/concern here" required></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-default">Submit</button>
    </div>
</form>