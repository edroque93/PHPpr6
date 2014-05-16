<?php

if(!$_POST){

	echo <<<ALERT
		
	<h1>Error 404</h1>
	<p>o algo asi...</p>

ALERT;

}else{ 

include_once "../db/db_utils.php";

$db = getDB();

$user = array();

$columns = getTable("usuarios")["columns"];

$opt = $_POST['opt'];

if($opt == "mod"){
	$opt_code = "Modificar";
	$id = $_POST['id'];
	$query = "select * from usuarios where id = $id";
	$user_raw = $db->query($query)->fetch();
	foreach($columns as $col){
		$user[$col] = $user_raw[$col];
	}
}
elseif($opt == "add"){
	$opt_code = "Crear";
	foreach($columns as $col){
		$user[$col] = "";
	}
} 
else {
	echo "Undefined Post Option";
}

$form = '<form action="usuario_submit.php" method="post">';
foreach($columns as $col){
	$data = $user[$col];
	$form .= "<input type=\"text\" name=\"$col\" value=\"$data\">";
}
$form .= "<input type=\"submit\" value=\"$opt_code\"></form>";

echo $form;

}?>





