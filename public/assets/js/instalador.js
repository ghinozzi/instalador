$(document).ready(function(){

    $('.inputView').change(function(){
        let target = $(this).attr('target');
        if($(this).is(':checked')){
            $(target).collapse('show');
        }else{
            $(target).collapse('hide');
        }
    });

    $('#checkToggle').prop('data-status','marcar');
    $('#checkToggle').click(function(){
        $('input[type=checkbox]').each(function(){
            if($('#checkToggle').prop('data-status') == 'marcar'){
                $(this).prop('checked',true);
            }else{
                $(this).prop('checked',false);
            }
        });
        if($(this).prop('data-status') == 'marcar'){
            $(this).prop('data-status','desmarcar');
            $(this).text('Desmarcar todos');
        }else{
            $(this).prop('data-status','marcar');
            $(this).text('Marcar todos');
        }
        $('.inputView').change();
    });
    $('.select-type').change(function(){
        let attr = $(this).attr('data-type');
        let typeSelected = $(this).val();
        if(typeSelected == "select"){
            $('.type-selected'+attr).show(500);
        }else{
            $('.type-selected'+attr).hide();
        }
    });

    $('.sub-collapse').click(function(){
        let target = $(this).attr('data-target');
        $(target).toggle(300);
    });
});
