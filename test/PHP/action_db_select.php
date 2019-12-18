<html>
<head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Actions for DB</title>
 </head>
<body
<?php
	$p = "<br>"; // Переменная содержит тег перевода строки для HTML
	// Получить параметры: ДЕЙСТВИЕ, ИМЯ БД
	$choice=$_POST['choice'];
	$db_name=$_POST['db_name'];
	// Подключиться к серверу и к заданной БД
	$db = mysqli_connect("localhost","root", "", $db_name);
		if (!$db)
		{echo "Error connect to MySQL";
			exit;
		}
	// Показать выбранной действие и имя БД
	echo "Выбрано действие -".$choice.$p;
	echo "Выбрана БД       -".$db_name.$p;
	//  Переключатель между действиями
	switch ($choice)
	{
		case "Удалить": // Если выбрано удаление
		echo "Удаление...".$p;
	// Запрос на удаление
	$sql='drop database '.$db_name;
	if (!mysqli_query($db, $sql))
		{echo "Ошибка удаления БД ".$db_name; exit();}
	echo "БД - ".$db_name." Успешно удалена".$p;
	// Удаление записи в таблице-справочнике
	//   подключаемся к базе-справочнику
	$db = mysqli_connect("localhost","root", "", "db_my");
		if (!$db)
		{echo "Error connect to MySQL";
			exit;
		}
	// формируем запрос на удаление
	$sql="delete from db_name where db_name='$db_name'";
	if(!mysqli_query($db, $sql))
		{echo "Ошибка корректровки справочника БД"; exit();}
	echo "БД - ".$db_name." успешно удалена из справочника ".$p;
?>
	<FORM NAME=Del METHOD=post ACTION="menu.php" target="frame1">
	<INPUT TYPE="submit" VALUE="БД удалена успешно" name=ok>
	</FORM>
	<?php
	break;
	//
	case "Выбор таблиц": // Если выбран просмотр таблиц
		echo "Просмотр таблиц ".$p;
		$result=mysqli_query($db, "Show tables from $db_name");

	?>
	<!-- Создание формы для вывода списка таблиц и выбора действия: Создать таблицу -->
		<form name="form1" method=post action="create_tab.php" target="frame4">
		<input type=hidden value=<?php echo $db_name?> name=db_name>
		Создание/Выбор таблицы
		<select name=name_table>
		<option>Создать таблицу</option>
		<?php
		while($rows=mysqli_fetch_array($result))
			{?>
			<option><?php echo $rows[0];?></option>
		<?php
			}
		?>
		<input type=submit name=OK value="OK" name=send>
		</select>
		</form>
		<?php
		break;
	default:
		exit();
}
?>
</html>
