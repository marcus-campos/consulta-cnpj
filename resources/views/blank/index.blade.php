@extends('template')

@section('container')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card-box">
                <h4 class="text-dark header-title m-t-0 m-b-30">Responsive embed video 4:3</h4>
                <!-- 4:3 aspect ratio -->
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="http://player.vimeo.com/video/69988283?color=5fbeaa&amp;title=0&amp;byline=0&amp;portrait=0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection