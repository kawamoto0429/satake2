<div>
    {{$id}}
</div>
<div>
    {{$day}}
</div>
<div>
    @foreach($purchases as $purchase)
    <div>
        {{$purchase->maintenance->name}}
    </div>
    @endforeach 
</div>