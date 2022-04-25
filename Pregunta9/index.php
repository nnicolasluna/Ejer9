<?php
include "Conexion.php";
$pdo = new Conexion();
// DAR DE ALTA
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$s="INSERT INTO persona(ci, Nombrecompleto, fechanacimiento, departamento) VALUES (:ci,:Nombrecompleto,:fechanacimiento,:departamento)";
	$sql = $pdo->prepare($s);
	$sql->bindValue(':ci',$_POST["ci"]);
	$sql->bindValue(':Nombrecompleto',$_POST["Nombrecompleto"]);
	$sql->bindValue(':fechanacimiento',$_POST["fechanacimiento"]);
	$sql->bindValue(':departamento',$_POST["departamento"]);
	$sql->execute();
	$state=$pdo->lastInsertId();
	if ($state)
	{
		header("HTTP/1.1 200 insercion correcta");
		echo json_encode($state);
		exit;
	}
}
// DAR DE BAJA
if ($_SERVER["REQUEST_METHOD"]=="DELETE")
{
	$sql = $pdo->prepare("delete from persona where ci=:ci");
	$sql->bindValue(':ci',$_GET["ci"]);
	$sql->execute();
	header("HTTP/1.1 200 borrado");
	exit;
}
// DAR CAMBIOS
if($_SERVER['REQUEST_METHOD'] == 'PUT')
{		
	$sql = "UPDATE persona SET Nombrecompleto=:Nombrecompleto, fechanacimiento=:fechanacimiento, departamento=:departamento WHERE ci=:ci";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':Nombrecompleto', $_GET['Nombrecompleto']);
	$stmt->bindValue(':fechanacimiento', $_GET['fechanacimiento']);
	$stmt->bindValue(':departamento', $_GET['departamento']);
	$stmt->bindValue(':ci', $_GET['ci']);
	$stmt->execute();
	header("HTTP/1.1 200 Ok");
	exit;
}
?>