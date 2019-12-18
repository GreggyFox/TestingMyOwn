<html>
<body>
	<?php
	$db_name=$_POST['db_name'];
	$tab_name=$_POST['tab_name'];
// 	
	$db = mysqli_connect("localhost","root", "", $db_name);
		if (!$db)
		{echo "Ошибка подключения к серверу";
			exit;
		}
// 
		$sql = "CREATE TABLE $tab_name
			(id int auto_increment,
			Name varchar(20),
			Family varchar(30),
			Position varchar(40),
			Password varchar (10),
			primary key (id))";
			if(!mysqli_query($db, $sql))
		{
			echo "Ошибка при создании таблицы ".$tab_name;
			exit;
		}
	?>
	<form name="form" method=post action="create_tab.php" target="frame4">
	<input type=hidden value=<?php echo $db_name; ?> name=db_name>
	<input type=submit name=OK value=' Таблица удачно создана! '>
	</form>
<body>
</html>