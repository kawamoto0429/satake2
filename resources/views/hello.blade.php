<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PDF</title>
<style>
@font-face{
    font-family: ipag;
    font-style: normal;
    font-weight: normal;
    src:url('{{ storage_path('fonts/ipag.ttf')}}');
}
body {
font-family: ipag;
}

/*.container {*/
/*    display: flex;*/
/*}*/
/*header {*/
/*    display: flex;*/
/*}*/

</style>
</head>
<body>
    <header>
        <div><label>取引様：</label><label>{{$maker->name}}</label><label>担当者様</label></div>
        <div><label>発注店舗名：</label><label>佐竹食品朝日町本店</label></div>
    </header>
   
    <div class="container">
        @foreach ($categories as $category)
            
            <div>{{$category->name}}</div>
            <table border="1" >
                <tr>
                    <th width="100px" height="20px">納品日</th>
                    <th width="130px" height="20px">JANコード</th>
                    <th width="200px" height="20px">商品名</th>
                    <th width="80px" height="20px">発注数量</th>
                    <th width="50px" height="20px">入数</th>
                    <th width="50px" height="20px">納価</th>
                </tr>
                
                @foreach($purchases as $purchase)
                    @if($category->id == $purchase->category_id)
                    <tr>
                        <td>
                            {{date('m/d', strtotime($purchase->arrived_at))}}
                            <label>({{$purchase->week_name}})</label>
                        </td>
                        <td>
                            {{$purchase->maintenance->jan}}
                        </td>
                        <td>
                            {{$purchase->maintenance->name}}
                        </td>
                        <td>
                            {{$purchase->purchase_qty}}
                        </td>
                        <td>
                            {{$purchase->maintenance->lot}}
                        </td>
                        @if($purchase->purchase_qty < 10)
                            <td>
                                 {{$purchase->maintenance->price_1pc}}円
                            </td>
                        @elseif($purchase->purchase_qty < 30)
                            <td>
                                {{$purchase->maintenance->price_10pcs}}円
                            </td>
                        @elseif($purchase->purchase_qty >= 30)
                            <td>
                                {{$purchase->maintenance->price_30pcs}}円
                            </td>
                        @endif
                    </tr>
                    
                    @endif
                @endforeach
                    
                
            </table>
           
        @endforeach
    </div>
</div>
</body>
</html>