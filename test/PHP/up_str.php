<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!-- Код PHP в HTML   -->
	<?php 
	// Принять параметры (БД,ТАБЛИЦУ, ID редактируемой строки таблицы)
	$db_name=$_POST['db_name'];
	$tab_name=$_POST['tab_name'];
	$id = $_POST['id_str'];
	// Сообщения для отладки кода
	//echo "ID выбранной для редактирования строки = ".$id."<br> <br>";
	//echo "Редактирование строки в таблице -> ".$tab_name."<br> <br>";
	// Подключение к серверу и БД
	$db = mysqli_connect("localhost","root", "", $db_name);
		if (!$db)
		{echo "Ошибка подключения к серверу";
			exit;
		}
	// Зпрос на получени ИМЕН полей (столцов) в таблице
	$fields = mysqli_query($db, "SHOW COLUMNS FROM `$tab_name`");
	// Получить количество столбцов в таблице
	$columns=mysqli_num_fields($fields);	
	// запрос на вывод всего содрежимого из таблицы
	$sql=mysqli_query($db, "select * from $tab_name");	
	// 	// Сформировать заголовок таблицы, выводимой на экран
	?>
	<!-- Код PHP внедрен в код HTML  -->
	<FORM NAME=s METHOD=post ACTION="update_ac.php" target="frame4">
	<table border=2 align=center>
	<caption><strong> Таблица -> <?php echo $tab_name;?></strong></caption>
	<?php
	// Прочитать запись из таблицы с заданным ID и поместить её в ассоциативный массив
	$sql=mysqli_query($db, "select * from $tab_name where id = $id");
	$value = mysqli_fetch_array($sql);
		// Получить список ИМЕН полей строки в массив $col[]
	$i=0;
	while ($i<$columns-1)
	{
			$col[$i] = mysqli_fetch_assoc($fields);
			$i++;
	}
	// Вывести форму для реадактирования данных стороки без поля "ID"
		
	$i=1;
	while ($i<$columns-1)
	{
		$name_columns=$col[$i]['Field'];
	?>
		<tr>
		<td align=center><strong> <?php echo $name_columns;?></strong></td>
		<td align=center> <input type=text value=<?php echo $value[$name_columns]; ?>
		name=<?php echo $name_columns;?> 
		</td>
		</tr>
	<?php
    $i++;
	}
	?>
	<!-- Передача параметров в сценарий update_ac.php  -->
	<input type=hidden value=<?php echo $db_name;?> name=db_name>
	<input type=hidden value=<?php echo $tab_name;?> name=tab_name>
	<input type=hidden value=<?php echo $id;?> name=id_str>
	<br>
	<input type=submit name=OK value="Confirm" name=send>
	<input type=submit name=OK value="Cancel" name=send>
	</form>
	
</body>
</html>