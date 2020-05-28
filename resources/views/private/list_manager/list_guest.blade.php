<div class="container mb-3">
    @if (!$list->poll)
        <div class="container mb-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add new Guest</h4>
                    <form method="POST" class="input-group form-inline" action="{{ route('list:add_guest') }}">
                        @csrf
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <input type="text" class="form-control" name="name" autofocus placeholder="Name">
                        <input type="submit" class="btn btn-primary mb-2">
                    </form>
                </div>
            </div>
        </div>   
        <br> 
    @endif
    
    <div class="container mb-3">
        <div class="card">
            <div class="card-body">
                <h5>Current Guests</h5>
                <ul class="list-group">
                    @foreach ($guests as $guest)
                        <li class="list-group-item">
                            <div class="form-row">
                                <form method="POST" class="input-group " action="{{ route('list:remove_guest') }}">
                                    @csrf

                                    <input type="hidden" value="{{ $guest->id }}" name="guest">
                                    <input type="hidden" value="{{ $list->id }}" name="list">
                                    <div class="col">
                                        <label for="delete"> {{ $guest->name }} </label>
                                    </div>
                                    <div class="col">
                                        @if ($list->poll)
                                            <input type="submit" id="delete" class="btn btn-danger " value="Delete" disabled>
                                        @else
                                            <input type="submit" id="delete" class="btn btn-danger " value="Delete">    
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
