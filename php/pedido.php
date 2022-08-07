<?php 
	include_once('conexao.php');

	$itens = $_POST['codigo'];
	$codigo = $_POST['usuario'];
	$total = $_POST['valor'];

	date_default_timezone_set('America/Sao_Paulo');
	$data = date("Y-m-d H:i:s");

	$sql = "INSERT INTO PEDIDO (USUARIO_CODIGO, SITUACAO) VALUES ($codigo,0)";
	$query = mysqli_query($con,$sql);
	$pedido_codigo = mysqli_insert_id($con);

	foreach ($itens as $key => $value) {
		$sql = "INSERT INTO PEDIDO_HAS_ITEM (PEDIDO_CODIGO, PRODUTO_CODIGO) VALUES ($pedido_codigo,$value)";
		$query = mysqli_query($con, $sql);
	}

	$sql = "INSERT INTO VENDA (PEDIDO_CODIGO, TOTAL, DATAVENDA) VALUES ($pedido_codigo, $total, '$data')";
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
		echo "Erro ao realizar pedido!";
	}
?>