@extends('private.user_base')

@section('body')

    @if (count($confirm))
        <h2>Confirm Settle</h2>        
        <ul class="list-group">
            @foreach ($confirm as $debt)
                <li class="list-group-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <h4>{{ $debt->name }}</h4>
                                <span style="color: green">
                                    € {{ -$debt->debt->amount / 100 }}
                                </span>
                            </div>
                            <div class="col-3">
                                <form method="POST" class="form-group" action="{{ route('debt:settle') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                    <input type="submit" class="btn btn-success form-control" value="Accept Settle">
                                </form>
                            </div>
                            <div class="col-3">
                                <form method="POST" class="form-group" action="{{ route('debt:refuse') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                    <input type="submit" class="btn btn-danger form-control" value="Refuse Settle">
                                </form>
                            </div>
                            <div class="col-3">
                                <form method="POST" class="form-group" action="{{ route('debt:mark') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                    <input type="submit" class="btn btn-secondary form-control" value="Mark as Seen">
                                </form>
                            </div>
                        </div>
                    </div>   
                </li>
            @endforeach
        </ul>
    @endif

    @if (count($refused))
        <h2>Refused Settle</h2>
        <ul class="list-group">
           @foreach ($refused as $debt)
            <li class="list-group-item">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <h4>{{ $debt->name }}</h4>
                            <span style="color: red">
                                € {{ $debt->debt->amount / 100 }}
                            </span>
                        </div>
                        <div class="col-3">
                            <form method="POST" class="form-group" action="{{ route('debt:mark') }}">
                                @csrf
                                <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                                <input type="submit" class="btn btn-secondary form-control" value="Mark as Seen">
                            </form>
                        </div>
                    </div>
                </div>

            </li>
            @endforeach
        </ul>
    @endif


@endsection
