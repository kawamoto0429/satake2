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
        <div><label>{{$maker->name}}</label><label>担当者様</label></div>
    </header>
    <div class="container">
    @foreach($purchases as $purchase)
    @if($purchase->purchase_qty < 10)
    <div>
        {{$purchase->maintenance->name}} {{$purchase->purchase_qty}}個 {{$purchase->maintenance->price_1pc}}円
    </div>
    @elseif($purchase->purchase_qty < 30)
    <div>
        {{$purchase->maintenance->name}} {{$purchase->purchase_qty}}個 {{$purchase->maintenance->price_10pcs}}円
    </div>
    @elseif($purchase->purchase_qty <= 30)
    <div>
        {{$purchase->maintenance->name}} {{$purchase->purchase_qty}}個 {{$purchase->maintenance->price_30pcs}}円
    </div>
    @endif
    @endforeach
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_1pc}}">円</input>-->
    
            
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_10pcs}}">円</input>-->
            
            
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_30pcs}}">円</input>-->
            
        
   
    </div>
</div>
</body>
</html>