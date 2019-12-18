<html>
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Операции с выбранной БД</title>
 </head>
 <body>
 <?php
 // Получаем ИМЯ выбранной для дальнейших действий БД 
$db_name=$_POST['db_name'];
// Подключаемся к серверу и к заданной БД
$db = mysqli_connect("localhost","root", "", $db_name);
		if (!$db)
		{echo "Error connect to MySQL";
			exit;
		}
 
 
 ?>
  <h1 align = center> Наша БД - <?php echo "[".$db_name."]";?></h1>
  <form name = "form" method =post action = "action_db_select.php" target = "frame4">
  <p><b> <?php echo "Выберите действия для БД"; ?> </b></p>
  <input type = text value = <?php echo $db_name ?> name =db_name>
  <input type = submit value = "Удалить" name = "choice">
  <input type = submit value = "Выбор таблиц" name = "choice">
 </form>
 </body>
</html>