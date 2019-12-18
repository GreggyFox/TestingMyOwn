<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!-- Код PHP в HTML   -->
	<?php
	echo "Обновление строки"."<br>"."<br>"; // Отладочное сообщение
	// Принять параметры из сценария up_str.php
	$db_name=$_POST['db_name'];
	$tab_name=$_POST['tab_name'];
	$id = $_POST['id_str'];
	$action=$_POST['OK'];        // Значение выбора: Confirm или Cancel
	//echo "Выбрана БД ->".$db_name."<br> <br>";
	//echo "ID выбранной для редактирования строки = ".$id."<br> <br>";
	// Выбор действия: обновление vs отмена операции
	switch($action)
	{	
		case "Confirm": // Обновить
		
		$db = mysqli_connect("localhost","root", "", $db_name);
		if (!$db)
		{echo "Ошибка подключения к серверу";
			exit;
		}
		// Запрос на получени ИМЕН полей (столцов) в таблице
		$fields = mysqli_query($db, "SHOW COLUMNS FROM `$tab_name`");
		// Получить количество столбцов в таблице
		$columns=mysqli_num_fields($fields);	
		// Получить список ИМЕН полей строки в массив $col[]
	$i=0;
	while ($i<$columns-2)
	{
		
		$col[$i] = mysqli_fetch_assoc($fields);
			$i++;
	}
	// Сформировать текстовую строку, содержащую ЗАПРОС на обновление строки.
	// Строка состоит из постоянной части и переменной, которая формируется из 
	// информации о таблице, в которой производится обновление записи (имена полей таблицы)
	// и значения, переданные из up_str.php
	// Форма запроса: "UPDATE  $tab_name  SET Поле1= Значение1, Поле2 = Значение2, ... where id='$id'"
	
	$sql="UPDATE  $tab_name SET ";
	
	$i=1;
	while ($i<$columns-3)
	{
		$prom=$col[$i]['Field']; // Получить очередное ИМЯ_ПОЛЯ из ассоциативного массива
		// Принять ЗНАЧЕНИЯ полей, введенных в форме сценария up_str.php
		$n[$i]=$_POST[$prom]; // Получить ЗНАЧЕНИЕ для поля, опреденного текущем ИМЕНЕМ
		$sql=$sql.$prom." = "."'$n[$i]',";
		
		$i++;
		$j = $i;
	}
	//
	$prom=$col[$j]['Field'];
	$n[$j]=$_POST[$prom];
	$sql=$sql.$prom." = "."'$n[$j]' where id = $id";
	//
	//echo $sql."<br>"."<br>"; // Вывод сформированного SQL-запроса для проверки (отладки кода)
	// Вызов функции для выполнения запроса на обновление строки
	$q = mysqli_query($db, $sql);
	if (!$q)
		{
		echo "Запрос ".$sql." не выполнен";
		exit;
		}
		?>
		<form name="form" method=post action="action_db.php" target="frame2">
		<input type=hidden value=<?php echo $db_name; ?> name=db_name>
		<input type=hidden value=<?php echo $tab_name; ?> name=tab_name>
		
		<input type=submit name=OK value='Строка обновлена. Нажмите кнопку'>
		</form>
		<?php
		break;
		// Отмена обновления строки
		case "Cancel":
		?>
		<form name="form1" method=post action="action_db.php" target="frame">
		<input type=hidden value=<?php echo $db_name;?> name=db_name>
		<input type=hidden value=<?php echo $tab_name;?> name=tab_name>
		
		<input type=submit name=OK value='Обновление отменено. Нажмите кнопку'>
		</form>
		<?php
		break;
		}
		?>
</body>
</html>>