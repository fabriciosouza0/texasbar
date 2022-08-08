<?php 

	include_once('conexao.php');

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$telefone = $_POST['tel'];
	$bairro = $_POST['bairro'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	if(isset($_POST['complemento'])) {
		$complemento = $_POST['complemento'];
	}else {
		$complemento = 'NaN';
	}
	if(isset($_POST['acesso'])) {
		$acesso = $_POST['acesso'];
		$sql = "INSERT INTO USUARIO(NOME, SOBRENOME, EMAIL, SENHA, TELEFONE, BAIRRO, RUA, NUMERO, COMPLEMENTO, PRIVILEGIO) VALUES ";
		$sql .= "('$nome', '$sobrenome', '$email', '$senha', '$telefone', '$bairro', '$rua', $numero, '$complemento', $acesso)";

		$query = mysqli_query($con, $sql);
		header('location: ../adm/clientes.php');
	}else {
		$sql = "INSERT INTO USUARIO(NOME, SOBRENOME, EMAIL, SENHA, TELEFONE, BAIRRO, RUA, NUMERO, COMPLEMENTO, PRIVILEGIO) VALUES ";
		$sql .= "('$nome', '$sobrenome', '$email', '$senha', '$telefone', '$bairro', '$rua', $numero, '$complemento', 2)";

		$query = mysqli_query($con, $sql);
		
		include('login.php');

		login($email, $senha, $con);
	}

?>