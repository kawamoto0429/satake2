$(function(){

    $('.navbar-brand li').click(function(){
       let id = $(this).val();
       let month = $('#month').val();
       let day = $('#day').val();
       console.log(day);
        $.ajax({
            type: "get",
            url: "/notes/maker/ajax",
            data: {
                    'id': id,
                    'day': day,
                    'month': month,
                  },
            dataType: 'json',
        }).done(function(data){
            console.log(data);
            $('.products-list').children().remove();
            $.each(data, function (index, value) {
            console.log(value)
             html = `
                <tr>
                   <input type="hidden" value=${value.id} class="id">
                    <td>${value.maker_name}</td>
                    <td>${value.maintenance_name}</td>
                    <td>${value.purchase_qty}</td>
                    <td><select class="gain" name="percent">
                       <option value=0.20>20%</option>
                       <option value=0.25>25%</option>
                       <option value=0.30>30%</option>
                   </select></td>
                   <td class="price">${value.gain_price}8</td>
                </tr>
              `;
              $('.products-list').append(html);
            })
        }).fail(function() {
          console.log('失敗');
        });
    });

    $(document).on('change', '.gain', function(){
        let select = $(this).closest('tr').children('td').find('select');
        let p = $(this).closest('tr')
        let percent = $(this).closest('tr').children('td').find('select').val();
        let id = $(this).closest('tr').find('input').val();

        $.ajax({
            type: "get",
            url: "/notes/gain/ajax",
            data: {
                    'id': id,
                    'percent': percent,
                  },
            dataType: 'json',
        }).done(function(data){
            console.log(data)
            let percent = data['percent'];
            console.log(percent)
            p.find("td.price").remove();
            data['purchase']
            console.log(data['purchase']['gain_price'])
             html = `
                    <td class="price">${data['purchase']['gain_price']}8</td>
              `;
              p.append(html);

        }).fail(function() {
          console.log('失敗');
        });
    })
});
