<?php 
session_start();
require_once('db.php');

            
//echo $_POST['content'];
    $ugh = '';
    if (isset($_POST['sub_login'])) {
    	$kod_gr = $_POST['inp_login'];
        if ($kod_gr == '---') {
            $ugh = 'Неверное имя групу';
        } else {
    	$sel = $db->prepare("SELECT * FROM users WHERE kod_gr='$kod_gr'"); // достаем права и имя пользователя
		$sel->execute();
	    $d_m = $sel->fetch(PDO::FETCH_ASSOC);
        $ugh = '';

                $pr = $d_m['Prava'];
                $_SESSION['pr'] = $pr;
                $_SESSION['kod_gr'] = $kod_gr;
                //$_SESSION['user'] = $d_m['Fio'];
                header('Location: test3.php?kod_gr='.$kod_gr);
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
        <div class="block-form-l"><br>
          <div class="header">ГБПОУ "Соликамский горно-химический техникум"</div><br>
        	<div class="onlinetest">Тестирование v2.0</div>
        	<div class="sign">Вход</div>
            <form action="index.php" method="post" class="form-login"><br>
            	<label class="label selt">Выберите группу</label><br><br>
                <select name="inp_login" id="sel" class="input-login-1">
                	<option style="text-align: center;">---</option>
                <?php 
                 $sel3 = $db->prepare("SELECT * FROM gruppa");
                 $sel3->execute();
		        while($d_m2 = $sel3->fetch(PDO::FETCH_ASSOC)){
		                echo '<option value="'.$d_m2['id'].'">'.$d_m2['Naim'].'</option>';
		            }
                ?>
                </select><br><?=$ugh;?><br>
                <input type="submit" name="sub_login" value="Далее" class="sub-login" />
            </form><br>
        </div>
    </div>
</body>
</html>