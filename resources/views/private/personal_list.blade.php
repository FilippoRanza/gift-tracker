@extends('private.user_base')

@section('body')
<div>
<h2>My Gift Lists</h2>
    @if (isset($error))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div>
            <h4>List "{{ $error }}" already exists!</h4>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    @endif
    <ul class="nav nav-tabs" role="tablist" >
        <li class="nav-item"><a class="nav-link" id="active-link" onclick="set_current('active', 'active-link');" data-toggle="tab" href="#active">Active Lists</a></li>
        <li class="nav-item"><a class="nav-link" id="add-link" onclick="set_current('add', 'add-link');" data-toggle="tab" href="#add">Add List</a></li>
        <li class="nav-item"><a class="nav-link" id="old-link" onclick="set_current('old', 'old-link');" data-toggle="tab" href="#old">Archived Lists</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show" id="add" role="tabpanel" aria-labelledby="add-tab">
                <div class="container">
                    <br>
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create a new List</h4>
                                <form method="POST" action="{{ route('list:new') }}">
                                    @csrf
                                    <input type="text" required="required" class="form-control" placeholder="name" name="name">
                                    <div class="form-check">
                                        <input  type="checkbox" class="form-check-input"  id="guest_only" name="guest_only"> 
                                        <label  class="form-check-label" for="guest_only">Guest Only</label>
                                    </div>
                                
                                    <br>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        <div class="tab-pane fade show" id="active" role="tabpanel" aria-labelledby="active-tab">
            <div class="container">
                @if (count($user_lists))
                    <h3>Lists</h3>
                    <ul class="list-group">
                        @foreach ($user_lists as $list)
                            <li class="list-group-item">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $list->name }}</h4>
                                        <div class="input-group">
                                        
                                            <div class="form-row">
                                                <div class="col">
                                                    <a class="btn btn-primary" href="{{ route('list:manage', ['id' => $list->id]) }}">Go</a> 
                                                </div>
                                                <div class="col">
                                                    <form method="POST" action="{{ route('list:delete') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $list->id }}" name="list">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>    
                @else
                    <br>
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Add a New List</h3>
                                <h5 class="card-subtitle">There are no active list</h5>
                                <form autofocus onsubmit="document.getElementById('add-link').click();">
                                    <button class="btn btn-primary form-control"  type="submit">Create a new List</button>
                                </form>
                            </div>
                        </div>
                    </div>    
                @endif         
            </div>
        </div>
        <div class="tab-pane fade show" id="old" role="tabpanel" aria-labelledby="old-tab">
            <div class="container">
                <h3>Old Lists</h3>
                <ul class="list-group">
                    @foreach ($old_lists as $list)
                        <li class="list-group-item">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> 
                                        {{ $list->name }} 
                                        @if ($list->duplicated)
                                        - {{ $list->updated_at->diffForHumans() }}    
                                        @endif</h4>
                                    <div class="input-group">
                                        <a class="btn btn-primary" href="{{ route('list:old', ['id' => $list->id]) }}">
                                            Go
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        reset_previous('active', 'active-link');
    });
</script>
@endsection