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

</style>
</head>
<body>
    <div>
        <div>
            <h2><label>取引様：</label><label>{{$maker->name}}</label><label>担当者様</label></h2>
            <h2><label>発注店舗名：</label><label>佐竹食品朝日町本店</label><label>1ページ</label></h2>
        </div>
        
        <div class="container">
                <div>
                    @foreach($counting as $category_name => $c)
                      <label>{{$category_name}}</label><label>{{$c}}個</label>
                    @endforeach
                </div>
                <table border="1">
                    <tr>
                        <th width="100px" height="20px">納品日</th>
                        <th width="300px" height="20px">商品名</th>
                        <th width="50px" height="20px">入数</th>
                        <th width="80px" height="20px">発注数量</th>
                        <th width="50px" height="20px">納価</th>
                    </tr>
                    
                    @foreach($purchases as $n => $purchase)
                        @if( $n < 45 )
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
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div style="page-break-after: always"></div>
    <div>
        <div>
            <h2><label>取引様：</label><label>{{$maker->name}}</label><label>担当者様</label></h2>
            <h2><label>発注店舗名：</label><label>佐竹食品朝日町本店</label><label>２ページ</label></h2>
        </div>
       
        <div>
            <div>
                @foreach($counting as $category_name => $c)
                  <label>{{$category_name}}</label><label>{{$c}}個</label>
                @endforeach
            </div>
            <table border="1">
                <tr>
                    <th width="100px" height="20px">納品日</th>
                    <th width="300px" height="20px">商品名</th>
                    <th width="50px" height="20px">入数</th>
                    <th width="80px" height="20px">発注数量</th>
                    <th width="50px" height="20px">納価</th>
                </tr>
                
                @foreach($purchases as $n => $purchase)
                    @if( $n >= 45 && $n < 90)
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
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>