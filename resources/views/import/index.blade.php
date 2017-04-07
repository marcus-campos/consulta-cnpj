@extends('template')

@section('container')
    {{--{!! Form::open(['method' => 'post', 'route' => 'import.post']) !!}--}}
    <span id="msg" class="success"></span>
    <div class="row">
        <div class="m-t-20">
            <h5><b>CNPJs</b></h5>
            <p class="text-muted m-b-15 font-13">
                Cole a lista de CNPJs aqui separados por ;
            </p>
            <textarea id="cnpjs" name="cnpjs" class="form-control" rows="2" placeholder="Ex: 1111111111111; 2222222222222; 9999999999999"></textarea>
        </div>
        <div class="m-t-20 text text-center">
            <button id="submit" type="submit" class="btn btn-success waves-effect waves-light">Enviar</button>
        </div>
    </div>
    {{--{{ Form::close() }}--}}
@endsection

@section('js')
    <script>
        $('#submit').click(function () {
            $.Notification.autoHideNotify('custom', 'bottom left', 'Obtendo informações...','Estamos obtendo informações sobre os CNPJs informados.');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // make sure you respect the same origin policy with this url:
                // http://en.wikipedia.org/wiki/Same_origin_policy
                url: '{{ route('import.post') }}',
                data: {
                    'cnpjs': $('#cnpjs').val()
                },
                success: function(msg){
                    $.Notification.autoHideNotify('success', 'bottom left', 'Informações obtidas com sucesso!.','Informações obtidas e armazenadas com sucesso.');
                },
                error: function (err) {
                    $.Notification.autoHideNotify('error', 'bottom left', 'Error!!!','Ops... Algo não ocorreu como o esperado.');
                }
            });
        });
    </script>
@endsection