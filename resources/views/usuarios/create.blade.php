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
                                <h3 class="card-title align-items-start flex-column">Cadastro de usuarios</h3>
                            </div>
                            <hr>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 pb-5">
                                <form action="{{route('usuarios.store')}}" method="post">
                                    @csrf
                                    <div class='form-group pt-2'> 
<label for='nome' class='fs-5 fw-bold mb-2'>Nome</label> 
<input type='text'   name='nome' id='nome' class='form-control form-control-solid' placeholder='nome'> 
</div> 

<div class='form-group pt-2'> 
<label for='tipo_usuario' class='fs-5 fw-bold mb-2'>Tipo_usuario</label> 
<select   name='tipo_usuario' id='tipo_usuario' class='form-control form-control-solid'> 
</select> 
</div> 

<div class='form-group pt-2'> 
<label for='informacoes' class='fs-5 fw-bold mb-2'>Informacoes</label> 
<textarea name='informacoes' id='informacoes' class='form-control form-control-solid' placeholder='informacoes'></textarea> 
</div> 


                                    <div class="space-between pt-5 pb-5">
                                        <a href="{{route('usuarios.index')}}" class="btn btn-light">Voltar</a>
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
