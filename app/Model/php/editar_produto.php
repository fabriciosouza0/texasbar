<?php 
	
	include_once('conexao.php');

	session_start();
	$privilegio = $_SESSION['PRIVILEGIO'];

	$codigo = $_POST['codigo'];
	$novoCodigo = $_POST['novoCodigo'];
	$nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$preco = $_POST['preco'];
	$categoria = $_POST['categoria'];

	$sql = "UPDATE PRODUTO SET CODIGO = $novoCodigo, NOME = '$nome', DESCRICAO = '$descricao', PRECO = $preco, CATEGORIA_CODIGO = $categoria WHERE CODIGO = $codigo";

	$query = mysqli_query($con, $sql);

	if($query) {
		header('location: ../adm/produtos.php');
	}

?>