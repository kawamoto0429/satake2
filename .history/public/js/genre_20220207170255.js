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

    $('.maker_name').change(function() {
        let maker = $(this).val();
        console.log($(this).closest('tr').find('select[name=category_id]'));
        let target_td = $(this).closest('tr').find('select[name=category_id]');
        <!--console.log(maker);-->
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
            target_td.children().remove();
            <!--target_td.closest('tr').children('td').children("opit").remove();-->
            $.each(data['categories'], function (index, value) {
            console.log(this)
            html = `
                  <option value=${value.id}>${value.name}</option>
             `;
             target_td.append(html);
           })



        }).fail(function() {
          console.log('失敗');
        });

    });

});
