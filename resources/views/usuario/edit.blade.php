@extends('layouts.app')

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
                                <h3 class="card-title align-items-start flex-column">Edição de usuario</h3>
                            </div>
                            <hr>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 pb-5">
                                <form action="{{route('usuario.update',array('usuario'=>$usuario->id))}}" method="post">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class='form-group pt-2'> 
<label for='created_at' class='fs-5 fw-bold mb-2'>Created_at</label> 
<input type='date' value='{{$usuario->created_at}}'  name='created_at' id='created_at' class='form-control form-control-solid' placeholder='created_at'> 
</div> 

<div class='form-group pt-2'> 
<label for='updated_at' class='fs-5 fw-bold mb-2'>Updated_at</label> 
<input type='date' value='{{$usuario->updated_at}}'  name='updated_at' id='updated_at' class='form-control form-control-solid' placeholder='updated_at'> 
</div> 

<div class='form-group pt-2'> 
<label for='deleted_at' class='fs-5 fw-bold mb-2'>Deleted_at</label> 
<input type='date' value='{{$usuario->deleted_at}}'  name='deleted_at' id='deleted_at' class='form-control form-control-solid' placeholder='deleted_at'> 
</div> 

<div class='form-group pt-2'> 
<label for='id' class='fs-5 fw-bold mb-2'>Id</label> 
<input type='number' value='{{$usuario->id}}'  name='id' id='id' class='form-control form-control-solid numero' placeholder='id'> 
</div> 

<div class='form-group pt-2'> 
<label for='name' class='fs-5 fw-bold mb-2'>Name</label> 
<input type='text' value='{{$usuario->name}}'  name='name' id='name' class='form-control form-control-solid' placeholder='name'> 
</div> 

<div class='form-group pt-2'> 
<label for='email' class='fs-5 fw-bold mb-2'>Email</label> 
<input type='text' value='{{$usuario->email}}'  name='email' id='email' class='form-control form-control-solid' placeholder='email'> 
</div> 

<div class='form-group pt-2'> 
<label for='senha' class='fs-5 fw-bold mb-2'>Senha</label> 
<input type='text' value='{{$usuario->senha}}'  name='senha' id='senha' class='form-control form-control-solid' placeholder='senha'> 
</div> 


                                    <div class="space-between pt-5 pb-5">
                                        <a href="{{route('usuario.index')}}" class="btn btn-light">Voltar</a>
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
