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
    <div></div>
    <div class="container">
        @if(count($purchases_kasi) > 0)
        <div>菓子パン</div>
        <table border="1" >
            <tr>
                <th>納品日</th>
                <th width="200px" height="20px">商品名</th>
                <th>発注数量</th>
                <th>入数</th>
                <th>納価</th>
            </tr>
            
            @foreach($purchases_kasi as $purchase)
            <tr>
                <td>
                    {{date('m/d', strtotime($purchase->arrived_at))}}
                    <label>({{$purchase->week_name}})</label>
                </td>
                <td height="20px">
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
            @endforeach
                
            
        </table>
        @endif
        
        @if(count($purchases_huku) > 0)
        <div>袋パン</div>
        <table border="1" >
            <tr>
                <th>納品日</th>
                <th>曜日</th>
                <th width="200px" height="20px">商品名</th>
                <th>発注数量</th>
                <th>入数</th>
                <th>納価</th>
            </tr>
            
            @foreach($purchases_huku as $purchase)
            <tr>
                <td>
                    {{date('m/d', strtotime($purchase->arrived_at))}}
                    <label>({{$purchase->week_name}})</label>
                </td>
                <td>
                    {{$purchase->week_name}}
                </td>
                <td height="20px">
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
            @endforeach
                
            
        </table>
        @endif
        
        @if(count($purchases_syoku) > 0)
        <div>食パン</div>
        <table border="1" >
            <tr>
                <th>納品日</th>
                <th width="200px" height="20px">商品名</th>
                <th>発注数量</th>
                <th>入数</th>
                <th>納価</th>
            </tr>
            
            @foreach($purchases_syoku as $purchase)
            <tr>
                <td>
                    {{date('m/d', strtotime($purchase->arrived_at))}}
                    <label>{{$purchase->week_name}}</label>
                </td>
                <td height="20px">
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
            @endforeach
                
            
        </table>
        @endif
        
        @if(count($purchases_you) > 0)
        <div>洋菓子</div>
        <table border="1" >
            <tr>
                <th>納品日</th>
                <th width="200px" height="20px">商品名</th>
                <th>発注数量</th>
                <th>入数</th>
                <th>納価</th>
            </tr>
            
            @foreach($purchases_you as $purchase)
            
            <tr>
                <td>
                    {{date('m/d', strtotime($purchase->arrived_at))}}
                    <label>{{$purchase->week_name}}</label>
                </td>
                <td height="20px">
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
            @endforeach
                
            
        </table>
        @endif
    </div>
</div>
</body>
</html>