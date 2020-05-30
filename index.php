<?php
  include "formclass.php";
  $base = new formclass;
 ?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <h1 align ="center"><font color="darkblue">Абоненты</font></h1>
  <title>Accs</title>
  <style>
    table.til{
    margin: 0 auto;
  }
  .til td{
    width: 5%;
    text-align:center;
    border: 1px solid;
  }
  a{color: black; text-decoration: none;}
  a:hover{color: navy; text-decoration: underline;}
  </style>
 </head>
 <body background="back.png">
  <table class="til td" border = 1 align="center" width=100%> <tr> 
    <th width=2px><font face="CALIBRI">Номер телефона</font></th> 
    <th><font face="CALIBRI">Номер счёта</font></th> 
    <th><font face="CALIBRI">Баланс</font></th> 
    <th><font face="CALIBRI">Редактировать</font></th> 
    <th><font face="CALIBRI">Удалить</font></th> 
  </tr>
  <?php
    if(!empty($_GET)){
      if(isset($_GET['del'])){
        $base->del_table($_GET['id']);
      }
    }
    $base->ins_table();
  ?>
</table>
  <form action="form.php" method="POST">
   <p align="center"><input type="submit" value="Добавить задачу"></p>
  </form>
<div>
</div>
</body>
</html>
