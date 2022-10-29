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
                    <form action="{{route('instalador.create')}}" method="post">
                        @csrf
                        @foreach($tables as $table)
                            <div class="accordion-item instalador-accordion">
                                <div class="row">
                                    <div class="col-md-3 instalador-item"><a  data-bs-toggle="collapse" data-bs-target='#{{$table["table"]}}'>{{$table["table"]}}</a></div>
                                    <div class="col-md-9">
                                        <div class='instalador-options'>
                                            <input name="models[{{$table['table']}}]" checked type="checkbox"> <label for="">Model</label>
                                            <input name="controllers[{{$table['table']}}]" checked type="checkbox"> <label for="">Controller</label>
                                            <input name="views[{{$table['table']}}]" checked type="checkbox"> <label for="">View</label>
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
                                                <th>Not Null</th>
                                                <th>Lista</th>
                                                <th>Relação</th>
                                                <th>Campo Relação</th>
                                            </tr>
                                            @foreach($table["column"] as $column)
                                                <tr>
                                                    <td>{{$column["name"]}}</td>
                                                    <td>
                                                        <select name="table[{{$table['table']}}][{{ $column['name']}}][type]" class="select-type" data-type="{{$table['table'].'-'.$column["name"]}}">
                                                            <option value="">Selecione</option>
                                                            <option value="texto">Texto</option>
                                                            <option value="data">Data</option>
                                                            <option value="texto-longo">Texto Longo</option>
                                                            <option value="editor_html">Editor Html</option>
                                                            <option value="select">Select</option>
                                                        </select>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <select name="table[{{$table['table']}}][{{ $column['name']}}][belongsTo]" style="display: none;" class='select-table type-selected{{$table['table'].'-'.$column["name"]}}' data-column="{{$table['table'].'-'.$column["name"]}}">
                                                            <option value="">Selecione uma tabela</option>
                                                            @foreach($tables as $optionTable)
                                                                @if($table["table"] != $optionTable["table"])
                                                                    <option value="{{$optionTable['table']}}">{{$optionTable["table"]}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="table[{{$table['table']}}][{{ $column['name']}}][reference]" style="display: none;" class="type-selected{{$table['table'].'-'.$column["name"]}}" id='columns-{{$table['table'].'-'.$column["name"]}}'>
                                                            <option value="">Selecione um campo</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div><br>
                        @endforeach
                        <button type="submit" class="btn btn-sm fw-bold btn-primary">Criar Template</button>
                    </form>
                    <!-- comentario -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script type="text/javascript">
    $(document).ready(function(){
        $('.select-type').change(function(){

            let attr = $(this).attr('data-type');
            let typeSelected = $(this).val();
            if(typeSelected == "select"){
                $('.type-selected'+attr).show(500);
            }else{
                $('.type-selected'+attr).hide();
            }
        });

        $('.select-table').change(function(){
            let column = $(this).attr('data-column');
            let tableSelect = $(this).val();
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{route('instalador.getColumnsTable')}}",
                data: "table="+tableSelect,
                dataType: "json",
                success: function(result){
                    let response = jsonToOptions(result,'Field','Field');
                    console.log(response);
                    $('#columns-'+column).html(response);
                }
            });
        });
    });
  </script>
@endsection
