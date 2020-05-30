<?php
  include "formclass.php";
  $base = new formclass;
  if(empty($_GET) and !empty($_POST)){
    $base->data_insert();
    if ($base->sqlsave()){
      header('Location: /calendar'); 
    }
  }
  if(!empty($_GET) and empty($_POST)){
      $base->ins_fromdb($_GET['id']);
      $base->data_insert();
  }
  if(!empty($_GET) and !empty($_POST)){
    if(isset($_POST['pod'])){
        $base->sqlupd($_GET['id']);
      }
  }
?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <h1 align><font color="darkblue">Абонентский счёт</font></h1>
  <title>data</title>
  <style>
    .inp{
      position: absolute;
      left: 170px;
      width: 20%; 
      background: #E9EFF6; 
    }
    .dat{
      position: absolute;
      left: 170px;
      width: 9%; 
      background: #E9EFF6; 
    }
    .comm{
      position: absolute;
      left: 170px;
      width: 20%; 
      height: 10%;
      background: #E9EFF6; 
    }
    .sub{  
      margin-top: 80px;  
    }
  </style>
 </head>
 <body background="back.png">
  <form action="<?= $_SERVER['REQUEST_URI'];?>" method="POST">
  <p>Номер телефона: <input class="inp" placeholder="Номер телефона" name="number" value="<?= isset($_POST['number']) ? $_POST['number']:''?>"></p>
  <p>Номер счёта: <input class="inp" placeholder="Номер счёта" name="account" value="<?= isset($_POST['account']) ? $_POST['account']:''?>"></p>
  <p>Баланс: <input class="inp" placeholder="Баланс" name="balance" value="<?= isset($_POST['balance']) ? $_POST['balance']:''?>"></p>
  <p>Подтверждение: <input type="checkbox" name="pod" value="yes"> <input type="submit" value="Cохранить задачу"></p>
  </form>
<div>
</div>
</body>
</html>
