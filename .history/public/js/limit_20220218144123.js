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
    const a = document.getElementById('a').value;
    const btn = document.getElementsByClassName('c_btn');
    console.log(btn);
    if(count < a.length){
        btn.disabled = true;
    }else{
        btn.disabled = false;
    }

    const inputText = document.getElementById('input-text');
    const button = document.getElementById('button');
    inputText.addEventListener('keyup', (e) => {
      if (5 <= e.target.value.length) {
        //入力された文字が5文字以上なら実行される
        button.disabled = false;
      }
    })
