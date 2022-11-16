<div class="accordion-item instalador-accordion">
    <a style='cursor:pointer' class='sub-collapse' data-toggle="collapse" data-target="#{{ $table['table'] }}_titulos">Configurar Titulos</a>
    <div id="{{ $table['table'] }}_titulos" class="accordion-collapse collapse">
        <div class="row pt-4">
            <div class="form-group col-md-4">
                <label for="singular">Titulo Singular</label>
                <input type="text" class='form-control' name='{{$table['table']}}[singular]' value="{{ $table['table'] }}">
            </div>
            <div class="form-group col-md-4">
                <label for="plural">Titulo Plural</label>
                <input type="text" class='form-control' name='{{$table['table']}}[plural]' value="{{ $table['table'] }}">
            </div>
        </div>
        <hr>
        <div class='pt-5'>
            <h3 class='text-center'>Campos</h3>
            <div class="row">
                @foreach ($table['column'] as $column)
                    <div class="form-group col-md-4">
                        <label>{{ $column['name'] }}</label>
                        <input type="text" class='form-control'
                            name='table[{{ $table['table'] }}][{{ $column['name'] }}][title]'
                            value="{{ucfirst($column['name'])}}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
