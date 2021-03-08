@extends('private.user_base')

@section('body')
<h1>{{ __('debt_home.title') }}</h1>
<hr>

@if ($notify)
    <div class="alert alert-dark alert-dismissible fade show" role="alert"> 
        <a href="{{ route('debt:notification') }}" type="button" class="btn btn-success">
            {{ trans_choice('debt_home.notify', $notify) }}
            <span class="badge badge-light">{{ $notify }}</span>
        </a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if($debts)
    <div class="container"> 
        <p class= "small text-secondary">{{ __('debt_home.info') }}</p>

    <ul class="list-group">

        @foreach ($debts as $debt)
            <li class="list-group-item">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>
                                @if ($debt->pic)
                                    <img src="{{ URL::to('/') }}/storage/{{ $debt->pic }}" class="profile-pic">
                                @endif
                                {{ $debt->name }}
                            </h4>
                            @if ($debt->debt->amount > 0)
                                {{ __('debt_home.debt') }}: <span style="color:red">€ {{-$debt->debt->amount  / 100 }} </span>
                            @else
                                {{ __('debt_home.credit') }}: <span style="color:green">€ {{-$debt->debt->amount  / 100 }} </span>    
                            @endif

                        </div>
                        <div class="col-sm-3">
                            <form method="POST" action="{{ route('debt:settle') }}">
                                @csrf
                                <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                @if ($debt->debt->amount > 0)
                                    @if ($debt->marked)
                                        <input type="submit" class="btn btn-info form-control" value="{{ __('debt_home.confirm') }}" disabled>
                                    @else
                                        <input type="submit" class="btn btn-info form-control" value="{{ __('debt_home.mark') }}">    
                                    @endif

                                @else
                                    <input type="submit" class="btn btn-secondary form-control" value="{{ __('debt_home.settle') }}">
                                @endif
                            </form>
                        </div>
                    </div>
                </div>


            </li>
        @endforeach
    </ul>
    </div>
@else
    <div class="container">
        <p class="text-secondary"> {{ __('debt_home.no-current-debt') }}</p>
    </div>
@endif
@endsection
