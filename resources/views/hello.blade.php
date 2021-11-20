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
        <div> ヤマザキ 担当者様 </div>
    </header>
    <div class="container">
    @foreach($purchases as $purchase)
    <div>{{$purchase->maintenance->name}}</div>
    <div>{{$purchase->purchase_qty}}</div>
        @if($purchase->purchase_qty < 10)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_1pc}}">円</input>-->
            <div>{{$purchase->maintenance->price_1pc}}円</div>
            @elseif($purchase->purchase_qty < 30)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_10pcs}}">円</input>-->
            <div>{{$purchase->maintenance->price_10pcs}}円</div>
            @elseif($purchase->purchase_qty <= 30)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_30pcs}}">円</input>-->
            <div>{{$purchase->maintenance->price_30pcs}}円</div>
        @endif
    @endforeach
    </div>
</div>
</body>
</html>