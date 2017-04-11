@extends('template')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <input type="text" id="search-txt" name="search-txt" class="form-control input-lg" placeholder="Pesquisar...">
            </div>
        </div>
    </div>
    <span id="result">
        @include('search.result')
    </span>
    <div class="row form-inline">
        <div id="pagination" class="col-md-12 text-right">
            <label for="paginate">Exibir: </label>
            <select name="paginate" id="paginate" class="form-control">
                <option value="10" selected>10</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
                <option value="0">Todos</option>
            </select>
        </div>
    </div>
@endsection

@section('js')
    <script>

        var checked = false;

        $('#search-txt').keyup(function () {
            if($('#search-txt').val().length >= 2)
                search();
            else {
                all();
            }
        });

        $(document).on("change", "#paginate", function () {
            if($('#search-txt').val().length >= 2)
                search();
            else {
                all();
            }
        });

        $(document).on("click", "#export-btn", function () {
            $.Notification.autoHideNotify('success', 'bottom left', 'Gerando arquivo...','Não feche ou mude de página, estamos processando seu pedido... Isto pode demorar um pouco devido ao grande volume de dados.');
        });

        $(document).on("click", "#check-all", function () {
            checkAll();
        });

        $(document).on("change", "#ext", function () {
            generateLink();
        });

        $(document).on("change", "input[id='company[]']", function () {
            generateLink();
        });

        function search() {
            if($('#paginate').val() == 0)
                $.Notification.autoHideNotify('default', 'bottom left', 'Aguarde um instante...','Estamos carregando as informações... Isto pode demorar um pouco devido ao grande volume de dados.');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // make sure you respect the same origin policy with this url:
                // http://en.wikipedia.org/wiki/Same_origin_policy
                url: '{{ route('search.post') }}',
                data: {
                    'search-txt': $('#search-txt').val(),
                    paginate: $('#paginate').val()
                },
                success: function(resp){
                    $('#result').html(resp);
                },
                error: function (err) {
                    $.Notification.autoHideNotify('error', 'bottom left', 'Error!!!','Ops... Algo não ocorreu como o esperado.');
                }
            });
        }

        function all() {
            if($('#paginate').val() == 0)
                $.Notification.autoHideNotify('default', 'bottom left', 'Aguarde um instante...','Estamos carregando as informações... Isto pode demorar um pouco devido ao grande volume de dados.');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // make sure you respect the same origin policy with this url:
                // http://en.wikipedia.org/wiki/Same_origin_policy
                url: '{{ route('search.post') }}',
                data: {
                    paginate: $('#paginate').val()
                },
                success: function(resp){
                    $('#result').html(resp);
                    $('#search-label').hide();
                },
                error: function (err) {
                    $.Notification.autoHideNotify('error', 'bottom left', 'Error!!!','Ops... Algo não ocorreu como o esperado.');
                }
            });
        }

        function generateLink() {
            var selected = [];
            var link;
            var linkExcluir;

            $("input[id='company[]']").each(function() {
                if ($(this).is(":checked")) {
                    selected.push($(this).attr('value'));
                }
            });

            link = "{{ URL::to('/') }}/export/[" + selected + "]";

            linkExcluir = "{{ URL::to('/') }}/delete/[" + selected + "]";

            if(selected.length >= 1){

                $('#xls').show();
                $('#csv').show();
                $('#excluir').show();
                $('#divider1').show();
                $('#divider2').show();

                $('#xls').html(
                    '<a href="'+link+'/xls">Exportar - XLS</a>'
                );

                $('#csv').html(
                    '<a href="'+link+'/csv">Exportar - CSV</a>'
                );

                $('#excluir').html(
                    '<a href="'+linkExcluir+'">Excluir</a>'
                );
            }
            else
            {
                $('#xls').hide();
                $('#csv').hide();
                $('#excluir').hide();
                $('#divider1').hide();
                $('#divider2').hide();
            }
        }

        function checkAll() {
            if($('#paginate').val() == 0)
                $.Notification.autoHideNotify('default', 'bottom left', 'Aguarde um instante...','Isto pode demorar um pouco devido ao grande volume de dados.');

            if(checked === false) {
                $(".checkBoxClass").prop('checked', true);
                checked = true;
            }
            else
            {
                $(".checkBoxClass").prop('checked', false);
                checked = false;
            }

            generateLink();
        }

    </script>
@endsection