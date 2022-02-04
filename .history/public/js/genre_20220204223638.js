$(function(){

    $('#search').on('input', () => {
        let keywords = $('#search').val();

        $.ajax({
            type: "get",
            url: "/orders/search/ajax",
            data: {
                    'keywords' : keywords,
                    'maker': {{$maker->id}},
                    'genre': {{$genre_id}},
                  },
            dataType: 'json',
        }).done(function(data){
            console.log(data);
            $('.products-list').children().remove();
            $.each(data, function (index, value) {
            <!--console.log(value)-->
             html = `
                <tr class="check_tr">
                    <td scope="row"><input type="checkbox" name="conclude[]" class="c_input" value=${value.id}></td>
                    <td><a href="/orders/${value.id}/show">${value.name}</a></td>
                    <td>${value.lot}</td>
                    <td>${value.price_1pc}<label>円</label></td>
                </tr>
              `;
              $('.products-list').append(html);

            })
        }).fail(function() {
          console.log('失敗');
        });
    });

    $('#genre li').click(function(){
    let name = $(this).val();
    console.log(name);

        $.ajax({

            type: "get",
            url: "/orders/genre/ajax",
            data: {
                    'name': name,
                    'maker': {{$maker->id}},
                    'genre': {{$genre_id}},
                  },
            dataType: 'json',
        }).done(function(data){
            console.log(data);
            $('.products-list').children().remove();
            $.each(data, function (index, value) {
            console.log(value)
             html = `
                <tr>
                    <td scope="row"><input type="checkbox" name="conclude[]" class="c_input" value=${value.id}></td>
                    <td><a href="/orders/${value.id}/show">${value.name}</a></td>
                    <td>${value.lot}</td>
                    <td>${value.price_1pc}<label>円</label></td>
                </tr>
              `;
              $('.products-list').append(html);
            })
        }).fail(function() {
          console.log('失敗');
        });
    });

    $(document).on('change', '.c_input', function(){
      console.log("moved");
      if($(".c_input").is(':checked')){
          $('.button').prop('disabled', false);
      }else{
          $('.button').prop('disabled', true);
      }
     })
});
