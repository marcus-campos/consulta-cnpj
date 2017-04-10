<div class="row">
    <div class="col-md-8 col-md-offset-2 text-center m-t-30">
        <h3 class="h4" id="search-label"><b>Resultados para {{ $searchValue }}</b></h3>
    </div>
</div>
<span id="download"></span>
<div class="row">
    <div id="export-box" class="col-md-12 form-inline text-right" hidden>
        <label for="ext">Formato: </label>
        <select name="ext" id="ext" class="form-control">
            <option value="xls" selected>XLS</option>
            <option value="csv">CSV</option>
        </select>
        <a href="#" id='export-fake' class="btn btn-success" disabled="true">Exportar</a>
        <span id="export"></span>
    </div>
</div>
<div class="row" id="result-box">
    <div class="col-lg-12">
        <div class="search-result-box m-t-40">
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
                                            <input type="checkbox" name="company[]" id="company[]" value="{{ $company->id }}" />
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
                        {{ $companies->render() }}
                    </div>
                </div>

                <!-- end All results tab -->
            </div>
        </div>
    </div>
</div>