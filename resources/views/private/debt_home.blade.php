@extends('private.user_base')

@section('body')
<h2>My Debts</h2>
<hr>

@if ($notify)
    <div class="alert alert-dark alert-dismissible fade show" role="alert"> 
        <a href="{{ route('debt:notification') }}" type="button" class="btn btn-success">
            @if ($notify == 1)
                Notification
            @else
                Notifications
            @endif
            <span class="badge badge-light">{{ $notify }}</span>
        </a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<ul class="list-group">
    @foreach ($debts as $debt)
        <li class="list-group-item">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>{{ $debt->name }}</h4>
                        @if ($debt->debt->amount > 0)
                            Debt: <span style="color:red">€ {{-$debt->debt->amount  / 100 }} </span>
                        @else
                            Credit: <span style="color:green">€ {{-$debt->debt->amount  / 100 }} </span>    
                        @endif
                        
                    </div>
                    <div class="col-sm-3">
                        <form method="POST" action="{{ route('debt:settle') }}">
                            @csrf
                            <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                            @if ($debt->debt->amount > 0)
                                @if ($debt->marked)
                                    <input type="submit" class="btn btn-info form-control" value="Waiting for Confirm" disabled>
                                @else
                                    <input type="submit" class="btn btn-info form-control" value="Mask as Settle">    
                                @endif
                                
                            @else
                                <input type="submit" class="btn btn-primary form-control" value="Settle">
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            
           
        </li>
    @endforeach
</ul>

@endsection
