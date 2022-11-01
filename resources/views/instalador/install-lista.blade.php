<div class="accordion-item instalador-accordion">
    <a  style='cursor:pointer' class='sub-collapse' data-toggle="collapse" data-target="#{{$table['table']}}_lista">Configurar Lista</a>
    <div id="{{$table['table']}}_lista" class="accordion-collapse collapse">
        <div class="accordion-body">
            <p><strong>Campos</strong></p>
            <table class="table">
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Not Null</th>
                    <th>Lista</th>
                    <th>Referência</th>
                </tr>
                @foreach ($table['column'] as $column)
                    <tr>
                        <td>{{ $column['name'] }}</td>
                        <td>
                            <select
                                name="table[{{ $table['table'] }}][{{ $column['name'] }}][type]"
                                class="select-type"
                                data-type="{{ $table['table'] . '-' . $column['name'] }}">
                                @if(empty($foreignKeys[$table['table']][$column['name']]))
                                {!!getOptionFromType($column['type'])!!}
                                @else
                                <option selected value="select">Select</option>
                                @endif
                            </select>
                        </td>
                        <td><input type="checkbox" value='1' name='table[{{ $table['table'] }}][{{ $column['name'] }}][notnull]'></td>
                        <td><input type="checkbox" value='1' checked name='table[{{ $table['table'] }}][{{ $column['name'] }}][lista]'></td>
                        <td>
                            @if(!empty($foreignKeys[$table['table']][$column['name']]))
                                <select name="table[{{ $table['table'] }}][{{ $column['name'] }}][referencia]">
                                    <option value="">Selecione:</option>
                                    @foreach($tables[$foreignKeys[$table['table']][$column['name']]->reftable]['column'] as $campo)
                                        <option value="{{$campo['name']}}">{{$campo['name']}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
