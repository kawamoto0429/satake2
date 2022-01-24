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

<style> 
    @page { margin: 180px 50px; } 
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; } 
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; } 
    #footer .page:after { content: counter(page, upper-roman); } 
    </style> 

</style>
</head>
<body> 
    <div id="div1"></div>
    <div id="header"> 
    <h1>Widgets Express</h1> 
    </div> 
    <div id="footer"> 
    <p class="page">Page <?php $PAGE_NUM ?></p> 
    </div> 
    <div id="content"> 
    <p>the first page</p> 
    <p style="page-break-before: always;">the second page</p> 
    </div> 
</body>
<script>
  function clickBtn1() {
    const div1 = document.getElementById("div1");
    // 要素の追加
    if (!div1.hasChildNodes()) {
      const p1 = document.createElement("p");
      const text1 = document.createTextNode("テスト");
      p1.appendChild(text1);
      div1.appendChild(p1);
    }
  }
  function clickBtn2() {
    // 要素の削除
    const div1 = document.getElementById("div1");
    if (div1.hasChildNodes()) {
      div1.removeChild(div1.firstChild);
    }
  }
</script>
</html>