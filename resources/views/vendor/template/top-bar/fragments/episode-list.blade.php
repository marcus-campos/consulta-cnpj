@section('episode-list')
    @if(\Illuminate\Support\Facades\Auth::check())
        @if(isset($episodeList))
            <li class="hidden-xs">
                <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="fa fa-list-ul"></i></a>
            </li>
        @endif
    @endif
@endsection