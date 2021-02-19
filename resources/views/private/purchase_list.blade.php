@extends('private.user_base')


@section('body')
    <h1>{{ __('purchase_list.title') }}</h1>
    <hr>

    <ul class="list-group">
        @foreach ($purchases as $purchase)
            <li class="list-group-item">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4>{{ $purchase->item }}</h4>
                            <ul>
                                <li>{{ __('purchase_list.for') }}: {{ $purchase->recipient }}</li>
                                <li>{{ __('purchase_list.price') }}: € {{ $purchase->price / 100 }}</li>
                            </ul>
                            
                            
                        </div>
                        <div class="col-sm-4">
                            <form class="form-group" action="{{ route('purchase:delete') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $purchase->id }}" name="purchase">
                                <input type="submit" class="btn btn-danger form-control" value="{{ __('purchase_list.delete') }}">
                            </form>                             
                            <form class="form-group" action="{{ route('purchase:void') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $purchase->id }}" name="purchase">
                                <input type="submit" class="btn btn-warning form-control" value="{{ __('purchase_list.void') }}">
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <a type="button" class="btn btn-secondary form-control" href="{{ route('purchase:info', ['id' => $purchase->id ]) }}">{{ __('purchase_list.info') }}</a>
                        </div>
                    </div>
                </div>                          
            </li>
        @endforeach
    </ul>


@endsection
            