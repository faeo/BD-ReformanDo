<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once("config/conexao_bd.php");
	
	$db = new DB();

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT nome FROM pessoas where idpessoas = $id"; 
	}
	else{
		$sql = "SELECT nome FROM pessoas"; 
	}

	$query = $db->query($sql);

	$resultado = $db->resultSet($query);

	//var_dump($resultado);
	$pessoas = array('pessoas' => array() );

	foreach ($resultado as $key => $value) {
		$pessoas['pessoas'][]['nome'] = $value["nome"]; 
		//echo $key . "=>" .$value["nome"] . "<br>";
	}
	
	header("Access-Control-Allow-Origin: *");

	header('Content-Type: application/json');
	echo json_encode($pessoas);

?>