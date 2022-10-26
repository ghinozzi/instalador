

function teste(a){
    $('#teste option').show();
    
    var termo = $('#relation'+a).val().toUpperCase();
    termo = "MIGRATIONS";
    
    $('#teste option').each(function() { 
       if($(this).val().toUpperCase().indexOf(termo) === -1) {
           $(this).hide();
       }
    });
  }