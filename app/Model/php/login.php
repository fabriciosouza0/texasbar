<?php 

	function login($login, $senha, $con) {
		$sql = "SELECT * FROM USUARIO WHERE EMAIL = '$login' AND SENHA = '$senha'";
		$query = mysqli_query($con, $sql);
		$nUsuario = mysqli_num_rows($query);

		if($nUsuario > 0) {
			session_start();

			if(isset($_SESSION['ATIVA'])) {
				$_SESSION = array();
			}

			while($row = mysqli_fetch_assoc($query)) {
				$codigo = $row['CODIGO'];
				$nome = $row['NOME'];
				$privilegio = $row['PRIVILEGIO'];
			}
			
			$_SESSION['ATIVA'] = true;
			$_SESSION['CODIGO'] = $codigo;
			$_SESSION['NOME'] = $nome;
			$_SESSION['PRIVILEGIO'] = $privilegio;

			echo $privilegio;

			if($privilegio == 1) {
				header('location: ../adm/pedidos.php');
			}else {
				header('location: ../');
			}
		}else {
			echo "Falha no login !";
		}
	}

?>