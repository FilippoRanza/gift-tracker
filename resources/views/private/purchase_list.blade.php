@extends('private.user_base')


@section('body')
    <h1>{{ $user->name }}'s purchase list</h1>
    <hr>

    <ul class="list-group">
        @foreach ($purchases as $purchase)
            <li class="list-group-item">
                <div class="container">
                    <div class="row">
                        <div class="col-8">
                            <h4>{{ $purchase->item }}</h4>
                            <ul>
                                <li>For: {{ $purchase->recipient }}</li>
                                <li>Price: € {{ $purchase->price / 100 }}</li>
                            </ul>
                            
                            
                        </div>
                        <div class="col-4">
                            <form class="form-group" action="{{ route('purchase:delete') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $purchase->id }}" name="purchase">
                                <input type="submit" class="btn btn-danger form-control" value="Delete">
                            </form>                             
                            <form class="form-group" action="{{ route('purchase:void') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $purchase->id }}" name="purchase">
                                <input type="submit" class="btn btn-warning form-control" value="Void">
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a type="button" class="btn btn-primary form-control" href="{{ route('purchase:info', ['id' => $purchase->id ]) }}">Info</a>
                        </div>
                    </div>
                </div>                          
            </li>
        @endforeach
    </ul>


@endsection
            