<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!-- Код PHP в HTML   -->
<?php
// Получаем ИМЯ создаваемой БД методом POST
$db_name=$_POST['db_name'];
// Подключаемся к серверу и к справочной БД db_my
$db = mysqli_connect("localhost","root", "", "db_my");
		if (!$db)
		{echo "Error connect to MySQL";
			exit;
		}
// Создаем SQL-запрос на создание БД
$sql = 'Create DataBase '.$db_name.' default charset cp1251';
//  Выполнение запроса и проверка результата
if(mysqli_query($db, $sql))
	{
	echo "База ".$db_name." успешно создана\n";
	}	
	else {echo "Ошибка создания БД"; exit();}


// Создание запроса на ВСТАВКУ записи в справочник 
	
$sql = "insert into db_name (db_name) values('$db_name')";
$q = mysqli_query($db, $sql);
	if (!$q){
	echo "Запрос ".$sql." не выполнен";
	exit;
	}
	echo "Справочник БД дополнен именем ".$db_name;
?>	
	<form name="form1" method=post action="menu.php" target="frame1">
	<input type=submit name=OK value="БД создана. Возврат в МЕНЮ">
	</form>
</body>
</html>