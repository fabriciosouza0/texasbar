<?php
	include_once('conexao.php');

	$pedido = $_GET['pedido'];
	if(isset($_GET['cliente'])) {
		$codigo = $_GET['cliente'];
	}else {
		$codigo = null;
	}

	$sql = "DELETE FROM VENDA WHERE PEDIDO_CODIGO =  $pedido";
	$query = mysqli_query($con, $sql);

	$sql = "DELETE FROM PEDIDO_HAS_ITEM WHERE PEDIDO_CODIGO =  $pedido";
	$query = mysqli_query($con, $sql);

	$sql = "DELETE FROM PEDIDO WHERE CODIGO =  $pedido";
	$query = mysqli_query($con, $sql);

	if($query) {
		session_start();

		$privilegio = $_SESSION['PRIVILEGIO'];

		if($privilegio == 1) {
			header('location: ../adm/pedidos.php');
		}else {
			header('location: ../cliente/meus-pedidos.php?cliente='.$codigo);
		}
	}else {
		echo "Erro ao cancelar pedido!";
	}
?>