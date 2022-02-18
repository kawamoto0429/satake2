
function limit(count){
    const a = $('.a').val();
    console.log();
    if(count < a.length){
        $(".c_btn").prop('disabled', true);
    }else{
        $(".c_btn").prop('disabled', false);
    }
}
