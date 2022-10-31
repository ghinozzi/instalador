<div class="accordion-item instalador-accordion">
    <div class='sub-collapse' data-toggle="collapse" data-target="#{{$table['table']}}_lista">Configurar Lista</div>
    <div id="{{$table['table']}}_lista" class="accordion-collapse collapse">
        <div class="accordion-body">
            <p><strong>Campos</strong></p>
            <table class="table">
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Not Null</th>
                    <th>Lista</th>
                    <th>Relação</th>
                    <th>Campo Relação</th>
                </tr>
                @foreach ($table['column'] as $column)
                    <tr>
                        <td>{{ $column['name'] }}</td>
                        <td>
                            <select
                                name="table[{{ $table['table'] }}][{{ $column['name'] }}][type]"
                                class="select-type"
                                data-type="{{ $table['table'] . '-' . $column['name'] }}">
                                <option value="">Selecione</option>
                                <option value="texto">Texto</option>
                                <option value="data">Data</option>
                                <option value="texto-longo">Texto Longo</option>
                                <option value="editor_html">Editor Html</option>
                                <option value="select">Select</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            <select
                                name="table[{{ $table['table'] }}][{{ $column['name'] }}][belongsTo]"
                                style="display: none;"
                                class='select-table type-selected{{ $table['table'] . '-' . $column['name'] }}'
                                data-column="{{ $table['table'] . '-' . $column['name'] }}">
                                <option value="">Selecione uma tabela</option>
                                @foreach ($tables as $optionTable)
                                    @if ($table['table'] != $optionTable['table'])
                                        <option value="{{ $optionTable['table'] }}">
                                            {{ $optionTable['table'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select
                                name="table[{{ $table['table'] }}][{{ $column['name'] }}][reference]"
                                style="display: none;"
                                class="type-selected{{ $table['table'] . '-' . $column['name'] }}"
                                id='columns-{{ $table['table'] . '-' . $column['name'] }}'>
                                <option value="">Selecione um campo</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
