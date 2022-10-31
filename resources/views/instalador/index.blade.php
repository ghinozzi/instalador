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
                        <div class="col-3">
                            <h1>Instalador</h1>
                        </div>
                        <div class="col-3">
                            <button class='btn btn-info' id='checkToggle'>Marcar todos</button>
                        </div>
                    </div>
                </div>
                <div class="pt-5">
                    <!-- comentario -->
                    <form action="{{ route('instalador.create') }}" method="post">
                        @csrf
                        @foreach ($tables as $table)
                            <div class="accordion-item instalador-accordion">
                                <div class="row">
                                    <div class="col-md-3 instalador-item">{{ $table['table'] }}</div>
                                    <div class="col-md-9">
                                        <div class='instalador-options'>
                                            <input name="models[{{ $table['table'] }}]" type="checkbox"> <label
                                                for="">Model</label>
                                            <input name="controllers[{{ $table['table'] }}]" type="checkbox"> <label
                                                for="">Controller</label>
                                            <input name="views[{{ $table['table'] }}]" class='inputView'
                                                target='#{{ $table['table'] }}' type="checkbox"> <label
                                                for="">View</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{ $table['table'] }}" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @include('instalador.install-titulos',['table'=>$table])
                                        @include('instalador.install-filtros',['table'=>$table])
                                        @include('instalador.install-lista',['table'=>$table])
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
        $(document).ready(function() {
            $('.select-table').change(function() {
                let column = $(this).attr('data-column');
                let tableSelect = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('instalador.getColumnsTable') }}",
                    data: "table=" + tableSelect,
                    dataType: "json",
                    success: function(result) {
                        let response = jsonToOptions(result, 'Field', 'Field');
                        console.log(response);
                        $('#columns-' + column).html(response);
                    }
                });
            });
        });
    </script>
@endsection
