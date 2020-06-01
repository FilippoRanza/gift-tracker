@extends('private.user_base')

@section('body')
<br>
<div class="container">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h2>{{ $data->name }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        List:
                    </div>
                    <div class="col-sm-6">
                        {{ $list->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        Price:
                    </div>
                    <div class="col-sm-6">
                       € {{ $data->price / 100 }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        Buyer:
                    </div>
                    <div class="col-sm-6">
                        {{ $data->buyer }}
                    </div>
                </div>
                @if ($list->recipient)
                    <div class="row">
                        <div class="col-sm-6">
                            Recipient:
                        </div>
                        <div class="col-sm-6">
                            {{ $list->recipient }}
                        </div>
                    </div>
                @endif
                <hr>
                <div class="row">
                    <div class="col">
                        <h4>Patecipants</h4>
                    </div>
                </div>          
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group">
                            @foreach ($data->guests as $guest)
                                <li class="list-group-item">{{ $guest }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>




@endsection

