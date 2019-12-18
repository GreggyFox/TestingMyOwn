<html>
<?php
	$db_name=$_POST['db_name'];
	$tab_name=$_POST['tab_name'];
	$id=$_POST['id_str'];
	//echo $db_name."<br>";
	//echo $tab_name."<br>";
	//echo "ID=".$id."<br>";
	$db=mysqli_connect('localhost', 'root', "", $db_name);
	//mysql_select_db($db_name)or die("Cannot select DB");
	$sql="delete from $tab_name where id='$id'";
	mysqli_query($db, $sql)or die("Cannot delete string");
	?>
	<form name="form1" method=post action="action_db.php" target="frame4">
	<input type=hidden value=<?php echo $db_name; ?> name=db_name>
	<input type=hidden value=<?php echo $tab_name; ?> name=tab_name>
	<input type=submit name=OK value='Удаление выполненено. Нажмите кнопку'>
	</form>
</html>