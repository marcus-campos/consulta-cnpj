@section('left-menu')
    <div class="left side-menu side-menu-sm">
        <div class="sidebar-inner slimscrollleft">
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                   @yield('sidebar-menu')
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection