@extends('private.user_base')

@section('body')

    @if (count($confirm))
        <h1>{{ __('debt_notification.confirm-settle') }}</h1>        
        <hr>
        <ul class="list-group">
            @foreach ($confirm as $debt)
                <li class="list-group-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3"> 
                                <h4>
                                    @if ($debt->pic)
                                        <img src="{{ URL::to('/') }}/storage/{{ $debt->pic }}" class="profile-pic">
                                    @endif
                                    {{ $debt->name }}
                                </h4>
                                <span style="color: green">
                                    € {{ -$debt->debt->amount / 100 }}
                                </span>
                            </div>
                            <div class="col-sm-3">
                                <form method="POST" class="form-group" action="{{ route('debt:settle') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                    <input type="submit" class="btn btn-success form-control" value="{{ __('debt_notification.accept') }}">
                                </form>
                            </div>
                            <div class="col-sm-3">
                                <form method="POST" class="form-group" action="{{ route('debt:refuse') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                    <input type="submit" class="btn btn-danger form-control" value="{{ __('debt_notification.refuse') }}">
                                </form>
                            </div>
                            <div class="col-sm-3">
                                <form method="POST" class="form-group" action="{{ route('debt:mark') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                    <input type="submit" class="btn btn-secondary form-control" value="{{ __('debt_notification.seen') }}">
                                </form>
                            </div>
                        </div>
                    </div>   
                </li>
            @endforeach
        </ul>
    @endif

    @if (count($refused))
        <h2>{{ __('debt_notification.refused-settle') }}</h2>
        <ul class="list-group">
           @foreach ($refused as $debt)
            <li class="list-group-item">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <h4>{{ $debt->name }}</h4>
                            <span style="color: red">
                                € {{ $debt->debt->amount / 100 }}
                            </span>
                        </div>
                        <div class="col-sm-3">
                            <form method="POST" class="form-group" action="{{ route('debt:mark') }}">
                                @csrf
                                <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                <input type="submit" class="btn btn-secondary form-control" value="{{ __('debt_notification.seen') }}">
                            </form>
                        </div>
                    </div>
                </div>

            </li>
            @endforeach
        </ul>
    @endif


@endsection
