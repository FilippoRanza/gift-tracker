@extends('private.user_base')

@section('body')

    @if (count($confirm))
        <h2>Confirm Settle</h2>        
        <ul>
            @foreach ($confirm as $debt)
                <li>
                    {{ $debt->name }} - € {{ $debt->debt->amount / 100 }}
                    <form method="POST" action="{{ route('debt:settle') }}">
                        @csrf
                        <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                        <input type="submit" value="Accept Settle">
                    </form>
                    <form method="POST" action="{{ route('debt:refuse') }}">
                        @csrf
                        <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                        <input type="submit" value="Refuse Settle">
                    </form>
                    <form method="POST" action="{{ route('debt:mark') }}">
                        @csrf
                        <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                        <input type="submit" value="Mark as Seen">
                    </form>
                    
                    
                </li>
            @endforeach
        </ul>
    @endif

    @if (count($refused))
        <h2>Refused Settle</h2>
           @foreach ($refused as $debt)
            <li>
                {{ $debt->name }} - € {{ $debt->debt->amount / 100 }}
                <form method="POST" action="{{ route('debt:mark') }}">
                    @csrf
                    <input type="hidden" value="{{ $debt->debt->id }}" name="debt">
                    <input type="submit" value="Mark as Seen">
                </form>
                
            </li>
            @endforeach
    @endif


@endsection
