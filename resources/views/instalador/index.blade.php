@extends('layouts.app')
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class='container'>
                    <div class="row">
                        <div class="col">
                            <h1>Instalador</h1>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="accordionExample">
                    <!-- comentario -->
                    @php $CountRelation = 0; @endphp    
                    @foreach($tables as $table)
                        <div class="accordion-item instalador-accordion">
                            <div class="row">
                                <div class="col-md-3 instalador-item"><a  data-bs-toggle="collapse" data-bs-target='#{{$table["table"]}}'>{{$table["table"]}}</a></div>
                                <div class="col-md-9">
                                    <div class='instalador-options'>
                                        <input type="checkbox" > <label for="">Model</label>
                                        <input type="checkbox" > <label for="">Controller</label>
                                        <input type="checkbox" > <label for="">View</label>
                                    </div>
                                </div>
                            </div>
                            <div id="{{$table['table']}}" class="accordion-collapse collapse" >
                                <div class="accordion-body">
                                    <p><strong>Campos</strong></p>
                                    <table class="table">
                                        <tr>
                                            <th>Campo</th>
                                            <th>Tipo</th>
                                            <th>Relação</th>
                                            <th>Campo Relação</th>
                                        </tr>
                                        
                                        @foreach($table["column"] as $column)
                                            <tr>
                                                <td>{{$column["name"]}}</th>
                                                <td>
                                                    <select name="" id="">
                                                        <option value="">Selecione</option>
                                                        <option value="">Texto</option>
                                                        <option value="">Data</option>
                                                        <option value="">Texto Longo</option>
                                                        <option value="">Editor Html</option>
                                                        <option value="">Select</option>
                                                    </select>
                                                </th>
                                                <td>
                                                    <select id="relation{{$CountRelation}}" onchange='teste({{$CountRelation}})'>
                                                        <option value="">Selecione uma tabela</option>
                                                        @foreach($tables as $optionTable)
                                                            @if($table["table"] != $optionTable["table"])
                                                                <option value="{{$optionTable['table']}}">{{$optionTable["table"]}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id='teste'>
                                                        <option value="">Selecione um campo</option>
                                                        @php 
                                                            $countTable = 0; 
                                                            $countColumn = 0;
                                                        @endphp
                                                        @foreach($tables as $optionTable)
                                                            @foreach($optionTable["column"] as $optionColumn)
                                                                <option id="option{{$CountRelation}}" value="{{$CountRelation}}">{{$optionColumn['name']}}</option>
                                                                @php $countColumn ++; @endphp
                                                            @endforeach
                                                            @php $countTable ++;@endphp
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            @php $CountRelation ++; @endphp
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div><br>
                    @endforeach
                    <!-- comentario -->
                </div>
            </div>
        </div>
    </div>
@endsection
