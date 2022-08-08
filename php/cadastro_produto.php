<?php 
	
	include_once('conexao.php');

	$codigo = $_POST['codigo'];
	$nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$preco = $_POST['preco'];
	$categoria = $_POST['categoria'];

	$sql = "INSERT INTO PRODUTO (CODIGO, NOME, DESCRICAO, PRECO, CATEGORIA_CODIGO) VALUES ($codigo, '$nome', '$descricao', $preco, $categoria)";

	$query = mysqli_query($con, $sql);

	if($query) {
		header('location: ../adm/produtos.php');
	}

?>