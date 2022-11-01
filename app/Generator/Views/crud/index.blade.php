@extends('layouts.app')
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5 pb-5">
                                <div class="space-between">
                                    <h3 class="card-title align-items-start flex-column">__TituloPlural__</h3>
                                    <a href="{{route('__Tabela__.create')}}" class="btn btn-sm btn-primary"> Adicionar __TituloSingular__</a>
                                </div>
                            </div>
                            <hr>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3 pb-5">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table crud align-middle gs-0 gy-5" id="table-list">
                                        <!--begin::Table head-->
                                        <thead class='text-center'>
                                        <tr>
                                            __TableHeaders__
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody>
                                        @foreach($data as $d)
                                            <tr>
                                                __TableFields__
                                                <td class='table-actions'>
                                                    <a href="{{route('__Tabela__.edit',array('__NomeVariavel__'=>$d->id))}}" class="btn btn-light">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                        </svg>
                                                        Editar
                                                    </a>
                                                    <a href="{{route('__Tabela__.destroy',array('__NomeVariavel__'=>$d->id))}}" class="btn btn-light form-delete" data-id='{{$d->id}}' onclick="event.preventDefault();" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Excluir
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
