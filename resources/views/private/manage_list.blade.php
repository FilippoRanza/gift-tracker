@extends('private.user_base')


@section('body')
    <h3>{{ $list->name }} - {{ $user->name }}</h3>
    
    <div>
        @includeWhen(isset($item_err), 'error', ['message' => __('manage_list.item-err', ['item' => $item_err, 'list' => $list->name])])
        @includeWhen(isset($user_err), 'error', ['message' => __('manage_list.user-err', ['name' => $user_err])])
        @includeWhen(isset($guest_err), 'error', ['message' => __('manage_list.guest-err', ['guest' => $guest_err, 'list' => $list->name])])
    </div>

    <ul class="nav nav-tabs" role="tablist" >
        <li class="nav-item"><a class="nav-link" id="item-link" onclick="set_current('item', 'item-link');" data-toggle="tab" href="#item">{{ __('manage_list.item-tab') }}</a></li>
        <li class="nav-item"><a class="nav-link" id="guest-link" onclick="set_current('guest', 'guest-link');" data-toggle="tab" href="#guest">{{ __('manage_list.guest-tab') }}</a></li>

        @if (isset($guest_only_handle))
            <li class="nav-item"><a class="nav-link" id="settings-link" onclick="set_current('settings', 'settings-link');" data-toggle="tab"  href="#settings">{{ __('manage_list.settings-tab') }}</a></li>    
        @endif
    </ul>
    <br>

    <div class="container md-3">
    <div class="tab-content">
        <div class="tab-pane fade show" id="item" role="tabpanel" aria-labelledby="item-tab">
            @include('private.list_manager.list_items')
        </div>
        <div class="tab-pane fade show" id="guest" role="tabpanel" aria-labelledby="guest-tab">
            @include('private.list_manager.list_guest')
        </div>
        <div class="tab-pane fade show" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            @include('private.list_manager.list_settings')
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            reset_previous('item', 'item-link');
        });
    </script>
@endsection

