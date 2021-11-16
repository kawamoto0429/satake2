<div>
    <form method="POST" action="/orders/day/store">
        {{ csrf_field() }}
    <input type="text" name="month"><label>月</label>
    <input type="text" name="day"><label>日</label>
    <button type="submit">決定</button>
    </form>
</div>