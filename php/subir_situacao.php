<?php 

	include_once('conexao.php');

	$situacao = $_GET['situacao'];
	$codigo = $_GET['codigo'];

	if($situacao >= 2) {
		$e_situacao = 2;
	}else {
		$e_situacao = $situacao+1;
	}

	$sql = "UPDATE PEDIDO SET SITUACAO = $e_situacao WHERE CODIGO = $codigo";
	$query = mysqli_query($con, $sql);

	if($query) {
		session_start();

		$privilegio = $_SESSION['PRIVILEGIO'];
		
		if($privilegio == 1) {
			header('location: ../adm/pedidos.php');
		}
	}
?>