<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
</head>
<body>
<div>
	<h1 align="center">Создание новых БД</h1> <br>
	<form name="form" method=post action="create_db.php" target="frame3">
		Создать БД <input type="text" name="db_name" value="none">
		<input type="submit" name="OK" value="OK">
	</form>
</div>
<div>
	<h1 align="center"> Выбор БД для работы </h1> <br>
	<?php // Исправлено для версии PHP 7
		$db = mysqli_connect("localhost","root", "", "db_my");
		if (!$db)
		{echo "Error connect to MySQL";
			exit;
		}
		// Сформировать SQL-запрос к таблице db_name
		$str = 'SELECT * FROM db_name';
		$query = mysqli_query($db, $str);
	?>

	<form name="form1" method="post" action="action_db.php" target="frame2">
		Выбрать БД
		<select name="db_name">
			<?php
			while($rows=mysqli_fetch_array($query))
				{?>
			<option><?php echo $rows['db_name'];?></option>
			<?php
			}
			?>
			<input type="submit" name="OK" value="OK" name="send">		
		</select>
	</form>
</div>
</body>
</html>