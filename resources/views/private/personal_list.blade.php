@extends('private.user_base')

@section('body')
<div>
<h1>{{ __('personal_list.title') }}</h1>
<hr>
    @if (isset($error))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div>
            <h4>{{ __('personal_list.error-msg', ['name' => $error]) }}</h4>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    @endif
    <div class="container">
        <ul class="nav nav-tabs" role="tablist" >
            <li class="nav-item"><a class="nav-link" id="active-link" onclick="set_current('active', 'active-link');" data-toggle="tab" href="#active">{{ __('personal_list.active-tab') }}</a></li>
            <li class="nav-item"><a class="nav-link" id="add-link" onclick="set_current('add', 'add-link');" data-toggle="tab" href="#add">{{ __('personal_list.add-tab') }}</a></li>
            <li class="nav-item"><a class="nav-link" id="old-link" onclick="set_current('old', 'old-link');" data-toggle="tab" href="#old">{{ __('personal_list.archived-tab') }}</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade show" id="add" role="tabpanel" aria-labelledby="add-tab"> <!-- Nuova lista -->
                <div class="container">
                    <br>
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ __('personal_list.add-list-title') }}</h4>
                                <form method="POST" action="{{ route('list:new') }}">
                                    @csrf
                                    <input type="text" required="required" class="form-control" placeholder="Nome lista" name="name">
                                    <br>
                                    <div class="form-check">
                                        <input  type="checkbox" class="form-check-input"  id="guest_only" name="guest_only"> 
                                        <label  class="form-check-label" for="guest_only">{{ __('personal_list.guest-only') }}</label>
                                    </div>
                        
                                    <br>
                                    <button type="submit" class="btn btn-secondary">{{ __('personal_list.add-list-button') }}</button>
                                </form>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        <div class="tab-pane fade show" id="active" role="tabpanel" aria-labelledby="active-tab"> <!-- Liste attive -->
            <div class="container">
                @if (count($user_lists))
                    <h3>Lists</h3>
                    <ul class="list-group">
                        @foreach ($user_lists as $list)
                            <li class="list-group-item">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $list->name }}</h4>
                                        <div class="input-group">
                                        
                                            <div class="form-row">
                                                <div class="col">
                                                    <a class="btn btn-secondary" href="{{ route('list:manage', ['id' => $list->id]) }}">{{ __('personal_list.go-to-list') }}</a> 
                                                </div>
                                                <div class="col">
                                                    <form method="POST" action="{{ route('list:delete') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $list->id }}" name="list">
                                                        <button type="submit" class="btn btn-danger">{{ __('personal_list.delete-list') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>    
                @else
                    <br>
                    <div class=""> 
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ __('personal_list.add-list-advice') }}</h3>
                                <br>
                                <h5 class="card-subtitle">{{ __('personal_list.add-list-advice-subtitle') }}</h5>
                                <br>
                                <form autofocus onsubmit="document.getElementById('add-link').click();">
                                    <button class="btn btn-secondary"  type="submit">{{ __('personal_list.add-list-advice-button') }}</button>
                                </form>

                            </div>
                        </div>
                    </div>    
                @endif         
            </div>
        </div>
        <div class="tab-pane fade show" id="old" role="tabpanel" aria-labelledby="old-tab">
            <div class="container">
                <h3>{{ __('personal_list.old-list-title') }}</h3>
                <ul class="list-group">
                    @foreach ($old_lists as $list)
                        <li class="list-group-item">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> 
                                        {{ $list->name }} 
                                        @if ($list->duplicated)
                                        - {{ $list->updated_at->diffForHumans() }}    
                                        @endif</h4>
                                    <div class="input-group">
                                        <a class="btn btn-secondary" href="{{ route('list:old', ['id' => $list->id]) }}">
                                            {{ __('personal_list.go-to-list') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        reset_previous('active', 'active-link');
    });
</script>
@endsection