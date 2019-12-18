<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!-- Код PHP в HTML   -->
	<?php
	// Принять парметры: ИМЯ_БД, ИМЯ_ТАБЛИЦЫ
	$db_name = $_POST['db_name'];
	$tab_name = $_POST['name_table'];
	// Подключиться к серверу
	$db = mysqli_connect("localhost","root", "", $db_name);
		if (!$db)
		{echo "Ошибка подключения к серверу";
			exit;
		}
 // Выбор альтернатив: "Создать таблицу", "Показать список таблиц"	
	switch($tab_name)
	{
		case "Создать таблицу": // Создать таблицу
	?>
		Введите ИМЯ таблицы: <br>
		<form name="form" method=POST action="create_tab_ac.php" target="frame3">
		<input type="text" value='' name=tab_name>
		<input type=hidden value=<?php echo $db_name; ?> name=db_name>
		<input type=submit name=OK value='Ok' name=send>
		</form>
		<?php
		break;
// ---------------------------------------------------------------------------
	default: // Вывод таблиц из заданной БД
	
	$db = mysqli_connect("localhost","root", "", $db_name);
		if (!$db)
		{echo "Ошибка подключения к серверу";
			exit;
		}
// Зпрос на получение ИМЕН полей (столцов) в таблице
	$fields = mysqli_query($db, "SHOW COLUMNS FROM `$tab_name`");
	// Получить количество столбцов в таблице
	$columns=mysqli_num_fields($fields);
	//echo $columns; код для отладки
// запрос на вывод всего содержимого из таблицы
	$sql=mysqli_query($db, "select * from $tab_name");
// Сформировать заголовок таблицы, выводимой на экран. Код HTML внедрен в код PHP
	echo "<table border = 2 align = center width = 100%>";
	echo "<caption><strong> ТАБЛИЦА - ".$tab_name." </strong></caption>";
	echo "<tr>";
	$i=0;
	while ($i<$columns-1)
	{
		$col[$i]= mysqli_fetch_array($fields);
		$name_columns[$i]=$col[$i]['Field'];
		echo "<td align=center><strong>".$name_columns[$i]."</strong></td>";
		$i++;
	}
	echo "<td align=center><strong>"."Delete"."</strong></td>";
	echo "<td align=center><strong>"."Update"."</strong></td>";
	echo "</tr>";
	?>
	<form name=form2 method=post  >
	<?php
	// Вывод на экран содержимого таблицы
	while ($rows = mysqli_fetch_array($sql))
	{
	echo "<tr>"; // Формирование строки
		// Вывод в ячейки содержимого таблицы (строки)
		for ($i=0; $i<$columns-1; $i++)
		{
		echo "<td>".$rows[$i]."</td>";
		}
	
	?>
	<td> <!-- Формирование ячеек c КНОПКАМИ. Значение VALUE - id модифицируемой записи -->
	<button name=id_str type=submit formmethod=post formaction="del_str.php"
	value="<?php echo $rows[0];?>">Удалить</button>
	</td>
	<td>
	<button name=id_str type=submit formmethod=post formaction="up_str.php"
	value="<?php echo $rows[0];?>">Обновить</button>
	<input type=hidden value=<?php echo $db_name; ?> name=db_name>
	<input type=hidden value=<?php echo $tab_name; ?> name=tab_name>
	</td>
	<?php
	echo "</tr>";
	}
	echo "</table>";
	}
	?>
	<input type=hidden value=<?php echo $db_name; ?> name=db_name>
	<input type=hidden value=<?php echo $tab_name; ?> name=tab_name>
	</form>
	<br>
	<form name="form1" method=POST action="insert.php" target="frame4">
	<input type=hidden value=<?php echo $db_name; ?> name=db_name>
	<input type=hidden value=<?php echo $tab_name; ?> name=tab_name>
	<input type=submit name=OK value='Вставка строки в таблицу' name=send>
	</form>
</body>
</html>