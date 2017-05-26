@if($ticketCanSubmit)
    <form action="{{route('ticket.store')}}" method="post">
        {{ csrf_field() }}
         <div class="form-group">
            <label for="option">Reason</label>
             <div class="form-group">
                 <select class="form-control" name="option" id="option">
                     @foreach($ticketTopic as $topic)
                             <option value="{{$topic->id}}"> {{$topic->text}} </option>
                     @endforeach
                 </select>
             </div>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="10" class="form-control" name="content" id="content" placeholder="Explain your problem/concern here" required></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </form>
@endif