<div>
    {{$day_sub}}
    @foreach($purchases as $purchase)
    <div>
        {{$purchase->maintenance->name}}
    </div>
    @endforeach
</div>