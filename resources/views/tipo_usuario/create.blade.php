@extends('instalador::layout')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" >
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">Cadastro de tipo_usuario</h3>
                            </div>
                            <hr>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 pb-5">
                                <form action="{{route('tipo_usuario.store')}}" method="post">
                                    @csrf
                                    <div class='form-group pt-2'> 
<label for='descricao' class='fs-5 fw-bold mb-2'>Descricao</label> 
<input type='text'   name='descricao' id='descricao' class='form-control form-control-solid' placeholder='descricao'> 
</div> 


                                    <div class="space-between pt-5 pb-5">
                                        <a href="{{route('tipo_usuario.index')}}" class="btn btn-light">Voltar</a>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
