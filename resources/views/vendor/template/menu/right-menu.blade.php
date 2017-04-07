@section('right-menu')
    @if(isset($episodeList))
    <div class="side-bar right-bar nicescroll">
        <h4 class="text-center">Episódios</h4>
        <div class="contact-list nicescroll">
            <ul class="list-group contacts-list">
                @foreach($episodeList as $episode)
                    <li class="list-group-item">
                        <a href="{{ route('series.video.id', ['series' => $episode->series_id,'id' => $episode->id]) }}">
                            <span class="name">{{ $episode->title }}</span>
                            @if($video->id == $episode->id)
                                <i class="fa fa-circle online"></i>
                            @endif
                        </a>
                        <span class="clearfix"></span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
@endsection