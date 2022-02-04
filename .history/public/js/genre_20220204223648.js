$(function(){

    $(document).on('change', '.c_input', function(){
      console.log("moved");
      if($(".c_input").is(':checked')){
          $('.button').prop('disabled', false);
      }else{
          $('.button').prop('disabled', true);
      }
     })
});
