@section('top-bar')
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left topbar-left-sm">
            <div class="text-center">
                <a href="{{ URL::to('/') }}" class="logo"><i class="icon-c-logo">CNPJ</i><span>Con <strong>CNPJ</strong></span></a>
                <!-- Image Logo here -->
                <!--<a href="index.html" class="logo">-->
                <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                <!--</a>-->
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="md md-menu"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>

                    <!--<form role="search" class="navbar-left app-search pull-left hidden-xs">
                        <input type="text" placeholder="Pesquisar..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>-->


                    <ul class="nav navbar-nav navbar-right pull-right">
                        @yield('notification')
                        @yield('episode-list')
                        @yield('user')
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
@endsection