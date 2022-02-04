    $(function(){
    
        $('#maker').on('input', () => {
            let maker = $('#maker').val();
            console.log(maker);
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
                type: "get",
                url: "/products/genres/category/ajax",
                data: {'maker_id': maker},
                dataType: 'json',
            }).done(function(data){
                console.log(data)
               $('#category_select').children().remove();
               $.each(data['categories'], function (index, value) {
                html = `
                      <option value=${value.id}>${value.name}</option>
                 `;
                 $('#category_select').append(html);
               })
               
               
              
            }).fail(function() {
              console.log('失敗');
            }); 
                 
        });
        

    });
    
    
