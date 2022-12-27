@extends('instalador::layout')

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
                                    <div class="col-md-3 instalador-item"><a class='sub-collapse' data-toggle="collapse" data-target="#{{ $table['table'] }}">{{$table['table'] }}</a></div>
                                    <div class="col-md-9">
                                        <div class='instalador-options'>
                                            <input name="models[{{ $table['table'] }}]" type="checkbox"> 
                                            <label for="">Model</label>
                                            <input name="controllers[{{ $table['table'] }}]" type="checkbox"> 
                                            <label for="">Controller</label>
                                            <input name="views[{{ $table['table'] }}]" type="checkbox"> 
                                            <label for="">View</label>
                                            <input name="menu[{{ $table['table'] }}]" type="checkbox"> 
                                            <label for="">Menu</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{ $table['table'] }}" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @include('instalador::install-titulos',['table'=>$table])
                                        @include('instalador::install-filtros',['table'=>$table])
                                        @include('instalador::install-lista',['table'=>$table])
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
    </script>
@endsection
