<li class="nav-item dropdown">
    <a class="navbar-brand dropdown-toggle" href="#" id="locale-flag" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
    <div class="dropdown-menu locale-dropdown"  aria-labelledby="navbarDropdown">
        <form onchange="submit();" action="{{ $post_url }}" method="POST">
            @csrf
            <input type="hidden" name="current-url" value="{{ URL::current() }}">
            <div class="text-center " id="nav-bar-locale-list"></div>   
        </form>
    </div>
</li>

<script src="{{ URL::to('/') }}/static/scripts/add_locale.js"></script>
<script>
  add_locale("{{ route('locale:list') }}", '#nav-bar-locale-list', function (name) {
    $('#locale-flag').append(name);
  });

</script>

