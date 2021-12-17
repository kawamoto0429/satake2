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
    @foreach($makers as $maker)
        @foreach($purchases as $purchase)
            @if($purchase->maker_id == $maker->id)
                <div><lable>{{$maker->name}}</lable>{{$purchase->maintenance_name}}</div> 
            @endif
        @endforeach
    @endforeach
</body>
</html>