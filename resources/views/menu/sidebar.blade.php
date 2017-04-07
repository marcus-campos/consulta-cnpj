@section('sidebar-menu')
    <li class="has_sub">
        <a href="{{ route('home') }}" class="waves-effect"><i class="fa fa-home"></i> <span>Home</span> </a>
    </li>
    <li class="has_sub">
        <a href="{{ route('search') }}" class="waves-effect"><i class="fa fa-search"></i> <span>Pesquisar empresas</span> </a>
    </li>
    <li class="has_sub">
        <a href="{{ route('import') }}" class="waves-effect"><i class="fa fa-upload"></i> <span>Importar CNPJs</span> </a>
    </li>
@endsection