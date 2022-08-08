<?php 
	
	include_once('conexao.php');

	session_start();
	$privilegio = $_SESSION['PRIVILEGIO'];

	$codigo = $_POST['codigo'];
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$telefone = $_POST['tel'];
	$bairro = $_POST['bairro'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	if(isset($_POST['complemento'])) {
		$complemento = $_POST['complemento'];
	}else {
		$complemento = 'NaN';
	}
	if(isset($_GET['op'])) {
		$operacao = $_GET['op'];
	}else {
		$operacao = 0;
	}

	switch ($operacao) {
		case 0:
			if($privilegio == 1) {
				$email = $_POST['email'];

				$sql = "UPDATE USUARIO SET NOME = '$nome', SOBRENOME = '$sobrenome', EMAIL = '$email', TELEFONE = '$telefone', BAIRRO = '$bairro', RUA = '$rua', NUMERO = $numero, COMPLEMENTO = '$complemento' WHERE CODIGO = $codigo";
			}else {
				$sql = "UPDATE USUARIO SET NOME = '$nome', SOBRENOME = '$sobrenome', TELEFONE = '$telefone', BAIRRO = '$bairro', RUA = '$rua', NUMERO = $numero, COMPLEMENTO = '$complemento' WHERE CODIGO = $codigo";
			}
			break;
		case 1:
			if (isset($_POST['antigaSenha']) && isset($_POST['novaSenha'])) {
				$antigaSenha = $_POST['antigaSenha'];
				$novaSenha = $_POST['novaSenha'];

				$sqlSenha = "SELECT SENHA FROM USUARIO WHERE CODIGO = $codigo";
				$querySenha = mysqli_query($con, $sqlSenha);
				$atualSenha = mysqli_fetch_array($querySenha)[0];

				if($antigaSenha === $atualSenha) {
					$sql = "UPDATE USUARIO SET SENHA = '$novaSenha' WHERE CODIGO = $codigo";
				}else {
					header('location: ../cliente/editar-conta.php?cliente='.$codigo.'&update_senha=0');
				}
			}else {
				header('location: ../cliente/editar-conta.php?cliente='.$codigo.'&update_senha=0');
			}
			break;
		case 2:
			if (isset($_POST['antigoEmail']) && isset($_POST['novoEmail'])) {
				$antigoEmail = $_POST['antigoEmail'];
				$novoEmail = $_POST['novoEmail'];

				$sqlEmail = "SELECT EMAIL FROM USUARIO WHERE CODIGO = $codigo";
				$queryEmail = mysqli_query($con, $sqlEmail);
				$atualEmail = mysqli_fetch_array($queryEmail)[0];

				if($antigoEmail === $atualEmail) {
					$sql = "UPDATE USUARIO SET EMAIL = '$novoEmail' WHERE CODIGO = $codigo";
				}else {
					header('location: ../cliente/editar-conta.php?cliente='.$codigo.'&update_email=0');
				}
			}else {
				header('location: ../cliente/editar-conta.php?cliente='.$codigo.'&update_email=0');
			}
	}

	$query = mysqli_query($con, $sql);

	if($query) {
		if($privilegio == 1) {
			header('location: ../adm/clientes.php');
		}else {
			if($operacao == 1) {
				header('location: ../cliente/editar-conta.php?cliente='.$codigo.'&update_senha=1');
			}else if($operacao == 2) {
				header('location: ../cliente/editar-conta.php?cliente='.$codigo.'&update_email=1');
			}else {
				header('location: ../cliente/editar-conta.php?cliente='.$codigo.'&update_dados=1');
			}
		}
	}

?>