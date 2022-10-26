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
                                                    <select class='select-table' data-column="{{$table['table'].'-'.$column["name"]}}">
                                                        <option value="">Selecione uma tabela</option>
                                                        @foreach($tables as $optionTable)
                                                            @if($table["table"] != $optionTable["table"])
                                                                <option value="{{$optionTable['table']}}">{{$optionTable["table"]}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id='columns-{{$table['table'].'-'.$column["name"]}}'>
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
                    <!-- comentario -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script type="text/javascript">
    $(document).ready(function(){
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
        function teste(a){
            $('#teste option').show();
                var termo = $('#relation'+a).val().toUpperCase();
                alert(termo);
                termo = "MIGRATIONS";

                $('#teste option').each(function() {
                if($(this).val().toUpperCase().indexOf(termo) === -1) {
                    $(this).hide();
                }
            });
        }
  </script>
@endsection
