<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!-- Код PHP в HTML   -->
	<?php 
	echo "Вставка строки в таблицу"."<br>";
	// Принять параметры (БД и ТАБЛИЦУ)
	$db_name=$_POST['db_name'];
	$tab_name=$_POST['tab_name'];
	// Подключение к серверу и БД
	$db = mysqli_connect("localhost","root", "", $db_name);
		if (!$db)
		{echo "Ошибка подключения к серверу";
			exit;
		}
	// Запрос на получение ИМЕН полей (столцов) в таблице
	$fields = mysqli_query($db, "SHOW COLUMNS FROM `$tab_name`");
	// Получить количество столбцов в таблице
	$columns=mysqli_num_fields($fields);	
	// запрос на вывод всего содрежимого из таблицы
	$sql=mysqli_query($db, "select * from $tab_name");	
	// 	// Сформировать заголовок таблицы, выводимой на экран
	?>
	<!-- Код PHP внедрен в код HTML  -->
	<FORM NAME=s METHOD=post ACTION="insert_ac.php" target="frame4">
	<table border=2 align=center>
	<caption><strong> Таблица -> <?php echo $tab_name;?></strong></caption>
	<?php
	// Получить список ИМЕН полей строки в массив $col[]
	$i=0;
	while ($i<$columns-1)
	{
		
		$col[$i] = mysqli_fetch_assoc($fields);
			$i++;
	}
	// Вывести форму для ввода данных стороки без поля "ID"
	$i=1;
	while ($i<$columns-1)
	{
		$name_columns=$col[$i]['Field'];
	?>
		<tr>
		<td align=center><strong> <?php echo $name_columns;?></strong></td>
		<td align=center> <input type=text value=""
		name=<?php echo $name_columns;?> 
		</td>
		</tr>
	<?php
    $i++;
	}
	?>
	<input type=hidden value=<?php echo $db_name;?> name=db_name>
	<input type=hidden value=<?php echo $tab_name;?> name=tab_name><br>
	<input type=submit name=OK value="Confirm" name=send>
	<input type=submit name=OK value="Cancel" name=send>
	</form>
	
</body>
</html>