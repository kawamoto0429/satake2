$(function(){
    $(".10").on('keyup', function(){
        var txt = $(this).val();
        console.log(txt);
        if ( 10 <txt.length ) {
        $(this).val(txt.substr(0,10));
        }
    });

    $("[limit]")
        // .off(".inputcontrol.limit")
        .on("keyup.limit", function(){
            var limit = $(this).attr("limit");
            var currentval = $(this).val();

            if (currentval.length>limit) {
                $(this).val(currentval.substr(0,limit));
            }

        });

})

function limit(count){
    const a = document.getElementsById('');
    console.log(a.value);
 }
