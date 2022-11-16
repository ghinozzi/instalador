$(document).ready(function(){

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
    });

    $('.sub-collapse').click(function(){
        let target = $(this).attr('data-target');
        $(target).toggle(300);
    });
});
