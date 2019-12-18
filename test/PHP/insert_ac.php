<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!-- Код PHP в HTML   -->
	<?php
	//echo "Вставка строки"."<br>"."<br>"; // Отладочное сообщение
	// Принять параметры из сценария isert.php
	$db_name=$_POST['db_name'];
	$tab_name=$_POST['tab_name'];
	$action=$_POST['OK'];
	// Выбор действия: вставка vs отмена операции
	switch($action)
	{	
		case "Confirm": // Вставить
		
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
	while ($i<$columns-1)
	{
		
		$col[$i] = mysqli_fetch_assoc($fields);
			$i++;
	}
	// Сформировать текстовую строку, содержащую ЗАПРОС на вставку строки.
	// Строка состоит из постоянной части и переменной, которая формируется из 
	// информации о таблице, в которую производится вставка записи (имена полей таблицы)
	// и значения, переданные из insert.php
	// Поле "ID" не вводится, т.к. оно обладает свойством "auto_increment"
	
		$sql="insert into $tab_name (";
		$s_val=" values (";
		
	$i=1;
	while ($i<$columns-2)
	{
		$prom=$col[$i]['Field'];
		// Принять ЗНАЧЕНИЯ полей, введенных в форме сценария insert.php
		$n[$i]=$_POST[$prom];
		$sql=$sql.$prom.",";
		$s_val=$s_val."'$n[$i]',";
		$i++;
		$j = $i;
	}
	//
	
	$prom=$col[$j]['Field'];
	$n[$j]=$_POST[$prom];
	$sql=$sql.$prom;
	$s_val=$s_val."'$n[$j]'";
	$sql=$sql.")".$s_val.')';
	//echo $sql."<br>"."<br>"; // Вывод сформированного SQL-запроса для проверки (отладки кода)
	// Вызов функции для выполнения запроса на вставку
	$q = mysqli_query($db, $sql);
	if (!$q){
		echo "Запрос ".$sql." не выполнен";
		exit;
	}
	?>
	<form name="form" method=post action="action_db.php" target="frame2">
	<input type=hidden value=<?php echo $db_name; ?> name=db_name>
	<input type=hidden value=<?php echo $tab_name; ?> name=tab_name>
	<input type=submit name=OK value='Строка вставлена. Нажмите кнопку'>
	</form>
	<?php
	break;
	// Отмена вставки строки
	case "Cancel":
	?>
	<form name="form1" method=post action="action_db.php" target="frame2">
	<input type=hidden value=<?php echo $db_name;?> name=db_name>
	<input type=hidden value=<?php echo $tab_name;?> name=tab_name>
	<input type=submit name=OK value='Вставка отменена. Нажмите кнопку'>
	</form>
	<?php
	break;
	}
	?>
</body>
</html>