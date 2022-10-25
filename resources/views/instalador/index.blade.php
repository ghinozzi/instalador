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
                    @foreach($tabelas as $tabela)
                    @php
                        $array = (array)$tabela;
                        $tabela = $array[array_key_first($array)];
                    @endphp
                    <div class="accordion-item instalador-accordion">
                        <div class="row">
                            <div class="col-md-3 instalador-item"><a  data-bs-toggle="collapse" data-bs-target="#{{$tabela}}">{{$tabela}}</a></div>
                            <div class="col-md-9">
                                <div class='instalador-options'>
                                    <input type="checkbox" > <label for="">Model</label>
                                    <input type="checkbox" > <label for="">Controller</label>
                                    <input type="checkbox" > <label for="">View</label>
                                </div>
                            </div>
                        </div>
                        <div id="{{$tabela}}" class="accordion-collapse collapse" >
                            <div class="accordion-body">
                                <p><strong>Campos</strong></p>
                                <table class="table">
                                    <tr>
                                        <th>Campo</th>
                                        <th>Tipo</th>
                                        <th>Relação</th>
                                        <th>Campo Relação</th>
                                    </tr>
                                    <!--foreach campos-->
                                    <tr>
                                        <td>Nome</th>
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
                                        <td></th>
                                        <td></th>
                                    </tr>
                                    <tr>
                                        <td>Tipo</th>
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
                                            <select name="" id="">
                                                <option value="">tabela vinculada 1</option>
                                                <option value="">tabela vinculada 2</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="" id="">
                                                <option value="">Campo tabela vinculada 1</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <!-- endfoeach foreach campos-->

                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
