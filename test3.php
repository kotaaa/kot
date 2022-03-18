<?php 
session_start();
require_once('db.php');
$_SESSION['kod_gr'];
if ($_GET['kod_gr'] == 0 || !$_SESSION['kod_gr'] || !$_GET['kod_gr'] || ($_GET['kod_gr'] !== '' && !$_SESSION['kod_gr'])) {
  header('Location: ../../logout.php');
}
$kod_gr = $_GET['kod_gr'];
if ($kod_gr == 1) {
  $sp = 'Администратора';
  $mode = 'Режим управления: ';
} else {
  $sp = 'Студента';
  $mode = 'Пользователь: ';
}
$inf = '';
        if(isset($_POST['sub_login'])) {
		      $kod_st = $_POST['inp_login'];
          $pass = md5(md5($_POST['inp_password']));
            //$gr = $_POST['inp_login'];
            
          //echo $_POST['content'];
              
              $sel = $db->prepare("SELECT * FROM users WHERE kod_gr='$kod_gr' and id='$kod_st'");
          	  $sel->execute();
              $d_m = $sel->fetch(PDO::FETCH_ASSOC);
              $_POST['inp_login'];
              if ($pass == $d_m['pass'] && isset($_POST['inp_login'])) {
              $pr = $d_m['prava'];
              $kod_st = $d_m['id'];
              $_SESSION['pr'] = $pr;
              $_SESSION['user'] = $d_m['Fio'];
              if ($pr == 1 && $kod_gr == 1) {
              	$_SESSION['kod_st'] = $kod_st;
                $_SESSION['kod_gr'] = $kod_gr;
                $_SESSION['st3'] = '1';
                header('Location: manager/main.php?kod_st='.$kod_st);
              } else {
              	$_SESSION['kod_st'] = $kod_st;
                $_SESSION['st3'] = '0';
                header('Location: manager/main-s.php?kod_st='.$kod_st);
            }
            } else {
              $inf = 'Неправильный пароль';
            }
          }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<script src="../js/jquery-1.js"></script>
  <script src="../js/jquery.js"></script> 
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div class="content"><br><br><br><br><br>
        <div class="block-form-l-2"><br>
          <div class="header">ГБПОУ "Соликамский горно-химический техникум"</div>
        	<div class="onlinetest">Тестирование</div>
        	<div class="sign">Вход</div>
            <form action="test3.php?kod_gr=<?=$kod_gr;?>" method="post" class="form-login"><br>
              <div class="center_info" style="width: 350px;">
                <a href="../../logout.php" class="a-link exit">&nbsp;&nbsp;&nbsp;&nbsp;Назад</a>
              <label class="label selt"><?=$mode;?></label><br><br>
            </div>
                <select name="inp_login" id="sel" class="input-login-1">
                	<option style="text-align: center;">---</option>
                <?php 
                 $sel_st = $db->prepare("SELECT * FROM Users WHERE kod_gr='$kod_gr'");
                 $sel_st->execute();
		        while($d_m3 = $sel_st->fetch(PDO::FETCH_ASSOC)){
		                echo '<option value="'.$d_m3['id'].'">'.$d_m3['Fio'].'</option>';
		            }
                ?>
                </select>
                <!--<select name="inp_log" class="input-login-1 sel">
                    <option style="text-align: center;">---</option>
                <?php 
                 $sel4 = $db->prepare("SELECT * FROM Student WHERE kod_Gr='$kod_gr'");
                 $sel4->execute();
                while($d_m3 = $sel4->fetch(PDO::FETCH_ASSOC)){
                		echo '<option value="'.$d_m3['kod'].'">'.$d_m3['Fio'].'</option>';
                    }
                ?>
                </select><br>-->
                <input type="password" name="inp_password" placeholder="Пароль" required class="input-login-2" pattern="^[a-zA-Z0-9]+$" title="Только латинские буквы и цифры"/><br>
                <input type="submit" name="sub_login" value="Вход" class="sub-login" />
            </form><br>
            <p class="p-text"><?=$inf;?></p>
        <!--<p class="info"><?=$inf;?></p>-->
        </div>
        <script type="text/javascript">
        	/*function savedata(elementidsave,contentsave) {
      var text = document.getElementById('text');
      var reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";   //функция для сохранения отредактированного текста с помощью ajax
        $.ajax({    url: 'test2.php',                           //url который обрабатывает и сохраняет наш текст
                    type: 'POST',
                    data: {content: select,     //наш пост запрос
                          id:elementidsave},                
                    success:function (data) {
                    }});
       } 
    $(document).ready(function() {
        $('select').change(function (e) {
          var text = document.getElementById('text');
            var contentold={};
            alert(var select = document.getElementById('sel').selectedIndex);
                   //объявляем переменную для хранения неизменного текста
                    
                    
               
             elementid=this.id;
             contentold[elementid]=$(this).html();
              
             //показываем кнопку "сохранить"
            var elementidsave=this.id;                       //id элемента потерявшего фокус         
               var contentsave = $(this).html();
                          //текст для сохранения     // значит фокус  в редактируемом элементе, кнопку не прячем
                     savedata(elementidsave,select);
                 //отправляем на сервер      
    });
      });
      */
        </script>
    </div>
</body>
</html>