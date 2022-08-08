<?php
	include_once('conexao.php');

	$codigo = $_GET['codigo'];

	$sql = "DELETE FROM PRODUTO WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);

	header('location: ../adm/produtos.php');
?>