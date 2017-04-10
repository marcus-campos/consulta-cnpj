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
            </select>
        </div>
    </div>
@endsection

@section('js')
    <script>

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

        $(document).on("change", "#check-all", function () {
            checkAll();
        });

        $(document).on("change", "#ext", function () {
            generateLink();
        });

        $(document).on("change", "input[id='company[]']", function () {
            generateLink();
        });

        function search() {
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
            var ext = $("#ext").val();
            var link;

            $("input[id='company[]']").each(function() {
                if ($(this).is(":checked")) {
                    selected.push($(this).attr('value'));
                }
            });

            link = "{{ URL::to('/') }}/export/[" + selected + "]/"+ext;

            if(selected.length >= 1){
                $('#export-box').show();
                $('#export-fake').hide();
                $('#export').html(
                    '<a href="'+link+'" id="export" class="btn btn-success">Exportar</a>'
                );
            }
            else
            {
                $('#export-fake').show();
                $('#export-box').hide();
                $('#export').html('');
            }
        }

        function checkAll() {
            if($('#check-all').is(':checked'))
                $(".checkBoxClass").prop('checked', true);
            else
                $(".checkBoxClass").prop('checked', false);

            generateLink();
        }

    </script>
@endsection