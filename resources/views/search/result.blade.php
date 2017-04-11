<div class="row">
    <div class="col-md-8 col-md-offset-2 text-center m-t-30">
        <h3 class="h4" id="search-label"><b>Resultados para {{ $searchValue }}</b></h3>
    </div>
</div>
<span id="download"></span>
<div class="row" id="result-box">
    <div class="col-lg-12">
        <div class="search-result-box m-t-40">
            <div class="row col-md-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">Ações <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                    <ul class="dropdown-menu drop-menu-right" role="menu">
                        <li><a href="#" id="check-all">Selecionar todos</a></li>
                        <li id="divider1" class="divider" hidden></li>
                        <li id="xls" hidden><a href="#">Export - XLS</a></li>
                        <li id="csv" hidden><a href="#">Export - CSV</a></li>
                        <li id="divider2" class="divider" hidden></li>
                        <li id="excluir" hidden><a href="#">Excluir</a></li>
                    </ul>
                </div>
            </div>

            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#home" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs"><b>Resultados</b></span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <div class="row">
                        <div class="col-md-12">
                            @if(count($companies) == 0)
                                <h3>Ooops... Não encontramos um resultado para esta pesquisa.</h3>
                            @else
                                @foreach($companies as $company)
                                    <div class="search-item">
                                        <div class="text-right">
                                            <input type="checkbox" class="checkBoxClass" name="company[]" id="company[]" value="{{ $company->id }}" />
                                        </div>
                                        <h3 class="h5 font-600 m-b-5"><a href="{{ route('company', ['id' => $company->id]) }}">{{ $company->name }}</a></h3>
                                        <div class="font-13 text-success m-b-10">
                                            {{ $company->cnpj }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        @if($paginate != 0)
                            {{ $companies->render() }}
                        @endif

                    </div>
                </div>

                <!-- end All results tab -->
            </div>
        </div>
    </div>
</div>
