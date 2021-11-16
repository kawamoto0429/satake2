<div>
    
        {{$id}}
    
</div>
<div>
    <a href="#">&lt;</a>
    {{$day}}
    <a href="">&gt;</a>
</div>
<div>
    @foreach($purchases as $purchase)
    <div>
        {{$purchase->maintenance->name}}
    </div>
    @endforeach 
</div>