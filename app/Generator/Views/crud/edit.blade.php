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
                                <h3 class="card-title align-items-start flex-column"> __TituloSingular__</h3>
                            </div>
                            <hr>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 pb-5">
                                <form action="{{route('__Tabela__.update',array('__NomeVariavel__'=>$__NomeVariavel__->id))}}" method="post">
                                    @csrf
                                    __CamposUpdate__
                                    <!--
                                    <div class="form-group pt-2">
                                        <label for="NmGrupo" class="fs-5 fw-bold mb-2">Descrição</label>
                                        <input type="text" name="NmGrupo" id="NmGrupo" value="{{$tbGrupo->NmGrupo}}" class="form-control form-control-solid" placeholder="Nome do grupo">
                                    </div>
                                    <div class="form-group pt-5 pb-5">
                                        <input class="form-check-input" {{(!empty($tbGrupo->FlAdmin)?'checked':'')}} type="checkbox" id="FlAdmin" name="FlAdmin" value="1">
                                        <label class="form-check-label" for="FlAdmin">Admin</label>
                                    </div>
                                    -->
                                    <div class="space-between pt-5 pb-5">
                                        <a href="{{route('__Tabela__.index')}}" class="btn btn-light">Voltar</a>
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
