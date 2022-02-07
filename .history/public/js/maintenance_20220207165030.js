$(function(){

    $('#maker').on('input', () => {
        let maker = $('#maker').val();
        console.log(maker);
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            type: "get",
            url: "/products/maintenances/maker/ajax",
            data: {'maker_id': maker},
            dataType: 'json',
        }).done(function(data){
            console.log(data['genres'])
            console.log(data['categories'])
            $('#category').children().remove();
            $.each(data['categories'], function (index, value) {
            console.log(value)
             html = `
                   <option value = ${value.id}>${value.name}</option>
              `;
              $('#category').append(html);
            })

            $('#genres_select').children().remove();

            $.each(data['genres'], function (index, value) {
            console.log(value.id)

             html = `

                   <option value = ${value.id}>${value.name}</option>
              `;
              $('#genres_select').append(html);
            })
        }).fail(function() {
          console.log('失敗');
        });
    });

    $('#category').on('input', () => {
        let category = $('#category').val();
        console.log(category);
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            type: "get",
            url: "/products/maintenances/category/ajax",
            data: {'category_id': category},
            dataType: 'json',
        }).done(function(data){
            console.log(data)
           $('#genres_select').children().remove();
           $.each(data, function (index, value) {
            html = `
                  <option value=${value.id}>${value.name}</option>
             `;
             $('#genres_select').append(html);
           })
        }).fail(function() {
          console.log('失敗');
        });

    });
});
