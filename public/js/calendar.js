$("#datepicker").datepicker({
    dateFormat: "yy-mm-dd",
    onSelect: function() {
    let date = $(this).datepicker('getDate');
    let y = date.getFullYear();
    let m = date.getMonth()+1;
    let d = date.getDate();
    console.log(y);
    console.log(m);
    console.log(d);
    window.location.href = `/notes/home/${y}/${m}/${d}`;
}
})
$(".dropdown-menu-right").on("click", function (e) {
  e.stopPropagation();
});
