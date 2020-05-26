@extends('private.user_base')

@section('body')
<h2>My Debts</h2>
<hr>

@if ($notify)
    <div>
        <a href="{{ route('debt:notification') }}">{{ $notify }} notifications</a>
    </div>
@endif


<ul>
    @foreach ($debts as $debt)
        <li>
            {{ $debt->name }} - € {{ $debt->debt->amount  / 100 }} 
            <form method="POST" action="{{ route('debt:settle') }}">
                @csrf
                <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                @if ($debt->debt->amount > 0)
                    @if ($debt->marked)
                        <input type="submit" value="Waiting for Confirm" disabled>
                    @else
                        <input type="submit" value="Mask as Settle">    
                    @endif
                    
                @else
                    <input type="submit" value="Settle">
                @endif
            </form>
        </li>
    @endforeach
</ul>

@endsection
