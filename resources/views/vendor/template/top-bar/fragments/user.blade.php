@section('user')
    @if(\Illuminate\Support\Facades\Auth::check())
        <li class="dropdown top-menu-item-xs">
            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Marcus </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('auth.logout') }}"><i class="ti-power-off m-r-10 text-danger"></i> Sair</a></li>
            </ul>
        </li>
    @else
        <li class="hidden-xs">
            <a href="{{ route('auth.login.form') }}" class="btn waves-effect waves-light">Entrar</a>
        </li>
    @endif
@endsection