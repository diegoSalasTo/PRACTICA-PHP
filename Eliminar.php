	<?php 
	$db = new PDO('mysql:host=localhost;dbname=financiera','diego','123456');
	
	$id = $_GET['id'];

	$sql = "delete from cliente where id='$id'";
	$resultado = $db->query($sql);
	if($resultado){
		header('location:index.php');
	}
	exit;

