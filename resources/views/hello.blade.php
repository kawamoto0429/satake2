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
page-break-inside: avoid;
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
        <h2><label>取引様：</label><label>{{$maker->name}}</label><label>担当者様</label></h2>
        <h2><label>発注店舗名：</label><label>佐竹食品朝日町本店</label></h2>
    </header>
   
    <div class="container">
        @foreach($counting as $category_name => $c)
            <div>{{$category_name}}<label>{{$c}}個</label></div>
        @endforeach
        <table border="1">
            <tr>
                <th width="100px" height="20px">納品日</th>
                <th width="300px" height="20px">商品名</th>
                <th width="50px" height="20px">入数</th>
                <th width="80px" height="20px">発注数量</th>
                <th width="50px" height="20px">納価</th>
            </tr>
            
            @foreach($purchases as $purchase)
                @if($purchase->arrived_at == $today->addDays()->format('Y-m-d'))
                <tr>
                    <td>
                        {{date('m/d', strtotime($purchase->arrived_at))}}
                        <label>({{$purchase->week_name}})</label>
                    </td>
                    <td>
                        {{$purchase->maintenance->name}}
                    </td>
                    <td>
                        {{$purchase->maintenance->lot}}
                    </td>
                    <td>
                        {{$purchase->purchase_qty}}
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
                @else
                 <td>aaaa</td>
                @endif
            @endforeach
        </table>
    </div>
</div>
</body>
</html>