@extends('private.user_base')


@section('body')
    <h1>{{ $user->name }}'s purchase list</h1>
    <hr>

    <ul>
        @foreach ($purchases as $purchase)
            <li>
                <a href="{{ route('purchase:info', ['id' => $purchase->id]) }}">
                    {{ $purchase->item }} from {{ $purchase->list }} to {{ $purchase->recipient }} - € {{ $purchase->price / 100 }}
                </a>
                <form action="{{ route('purchase:delete') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $purchase->id }}" name="purchase">
                    <input type="submit" value="Delete">
                </form>
                <form action="{{ route('purchase:void') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $purchase->id }}" name="purchase">
                    <input type="submit" value="Void">
                </form>
            </li>
        @endforeach
    </ul>


@endsection