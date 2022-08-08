<?php
	include_once('conexao.php');

	$codigo = $_GET['codigo'];

	$sql = "SELECT * FROM PEDIDO WHERE USUARIO_CODIGO = $codigo";
	$query = mysqli_query($con, $sql);
	$nRows = mysqli_num_rows($query);

	if($nRows > 0) {
		while($row = mysqli_fetch_assoc($query)) {
			$codigoP = $row['CODIGO'];
			
			$sqlD = "DELETE FROM VENDA WHERE PEDIDO_CODIGO = $codigoP";
			mysqli_query($con, $sqlD);

			$sqlD = "DELETE FROM PEDIDO_HAS_ITEM WHERE PEDIDO_CODIGO = $codigoP";
			mysqli_query($con, $sqlD);

			$sqlD = "DELETE FROM PEDIDO WHERE CODIGO = $codigoP";
			mysqli_query($con, $sqlD);
		}
	}

	$sql = "DELETE FROM USUARIO WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);

	if($query) {
		header('location: ../adm/clientes.php');
	}

	var_dump($query);
?>