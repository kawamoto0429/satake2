$(function(){
    $(".10").on('keyup', function(){
        
        var txt = $(this).val();
        if ( 10 <txt.length ) {
        $(this).val(txt.substr(0,10));
        }
    });
})
