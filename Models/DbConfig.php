<?php 
$servidor = "...";
$usuario = "...";
$senha = "...";
$dbname = "...";
$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);
mysqli_set_charset($conexao,'utf8');

if(!$conexao){
	die("Falha na conexao: " . mysqli_connect_error());
}	
?>
