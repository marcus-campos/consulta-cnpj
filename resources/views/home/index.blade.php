@extends('template')

@section('container')
    <div class="row">
        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="text-dark  header-title m-t-0 m-b-30">Empresas armazenadas</h4>

                <div class="widget-chart text-center">
                    <div style="display:inline;width:150px;height:150px;"><canvas width="150" height="150"></canvas><input class="knob" data-width="150" data-height="150" data-linecap="round" data-fgcolor="#5d9cec" value="{{ $companies }}" data-skin="tron" data-angleoffset="180" data-readonly="true" data-thickness=".15" readonly="readonly" style="width: 79px; height: 50px; position: absolute; vertical-align: middle; margin-top: 50px; margin-left: -114px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 30px; line-height: normal; font-family: Arial; text-align: center; color: rgb(93, 156, 236); padding: 0px; -webkit-appearance: none;"></div>
                </div>
            </div>
        </div>
        @if(env('QUEUE_ENABLE') == true)
        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="text-dark  header-title m-t-0 m-b-30">Fila de tarefas</h4>

                <div class="widget-chart text-center">
                    <div style="display:inline;width:150px;height:150px;"><canvas width="150" height="150"></canvas><input class="knob" data-width="150" data-height="150" data-linecap="round" data-fgcolor="#fb6d9d" value="{{ $waiting }}" data-skin="tron" data-angleoffset="180" data-readonly="true" data-thickness=".15" readonly="readonly" style="width: 79px; height: 50px; position: absolute; vertical-align: middle; margin-top: 50px; margin-left: -114px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 30px; line-height: normal; font-family: Arial; text-align: center; color: rgb(251, 109, 157); padding: 0px; -webkit-appearance: none;"></div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="text-dark header-title m-t-0 m-b-30">Empresas em captação</h4>

                <div class="widget-chart text-center">
                    <div style="display:inline;width:150px;height:150px;"><canvas width="150" height="150"></canvas><input class="knob" data-width="150" data-height="150" data-linecap="round" data-fgcolor="#34d3eb" value="{{ $processing }}" data-skin="tron" data-angleoffset="180" data-readonly="true" data-thickness=".15" readonly="readonly" style="width: 79px; height: 50px; position: absolute; vertical-align: middle; margin-top: 50px; margin-left: -114px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 30px; line-height: normal; font-family: Arial; text-align: center; color: rgb(52, 211, 235); padding: 0px; -webkit-appearance: none;"></div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection