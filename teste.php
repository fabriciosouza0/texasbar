<?php
session_start();
include_once('php/conexao.php');

$logado = false;
$error_login = false;

if (isset($_POST['login']) && $_POST['senha']) {
	$login = $_POST['login'];
	$senha = $_POST['senha'];

	$sql = "SELECT * FROM USUARIO WHERE EMAIL = '$login' AND SENHA = '$senha'";
	$query = mysqli_query($con, $sql);
	$nUsuario = mysqli_num_rows($query);

	if ($nUsuario > 0) {
		if (isset($_SESSION['ATIVA'])) {
			$_SESSION = array();
		}

		while ($row = mysqli_fetch_assoc($query)) {
			$codigo = $row['CODIGO'];
			$nome = $row['NOME'];
			$privilegio = $row['PRIVILEGIO'];
		}

		$_SESSION['ATIVA'] = true;
		$_SESSION['CODIGO'] = $codigo;
		$_SESSION['NOME'] = $nome;
		$_SESSION['PRIVILEGIO'] = $privilegio;

		if ($privilegio == 1) {
			header('location: adm/pedidos.php');
		} else {
			header('location: ../valeria_fernanda');
		}
	} else {
		$error_login = true;
	}
}

if (isset($_SESSION['ATIVA']) && $_SESSION['ATIVA']) {
	$nome = $_SESSION['NOME'];
	$privilegio = $_SESSION['PRIVILEGIO'];
	$logado = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Restaurante</title>
	<link href="css/fontes.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		#cad-link {
			color: rgba(255, 255, 255, 0.5);
		}

		#log-link {
			color: rgba(255, 255, 255, 0.5);
		}
	</style>
</head>

<body class="bg-dark">
	<div class="container-fluid" id="header">

	</div>
	<nav class="navbar navbar-rigth navbar-expand-lg navbar-dark fixed-top shadow-b" style="background: #333;">
		<a class="navbar-brand" href="#">
			<img src="arquivos/brand.png" width="50px" height="45px" alt="" />
			<span id="brand-text">O melhor restaurante
				<?php
				if ($logado) {
					if ($privilegio == 1) {
						echo " - ADM " . $nome;
					} else {
						echo " - " . $nome;
					}
				}
				?></span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="">Home</a>
				</li>
				<?php
				if (!$logado) {
					echo ('<li class="nav-item">
				        <a class="nav-link" href="#">Quem Somos</a>
				        <span class="line-hover"></span>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="fazer-pedido.php">Fazer Pedido</a>
				      </li>');
				} else {
					if ($privilegio == 1) {
						echo ('<li class="nav-item">
					        <a class="nav-link" href="adm/pedidos.php">Pedidos<span class="sr-only">(current)</span></a>
					      </li>
					      <li class="nav-item dropdown">
				            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Produtos</a>
				            <div class="dropdown-menu">
				              <a class="dropdown-item" href="adm/cadastro-produto.php">Cadastrar</a>
				              <div class="dropdown-divider"></div>
				              <a class="dropdown-item" href="adm/produtos.php">Listar</a>
				            </div>
				          </li>
					      <li class="nav-item dropdown">
				            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Clientes</a>
				            <div class="dropdown-menu">
				              <a class="dropdown-item" href="adm/cadastrar-cliente.php">Cadastrar</a>
				              <div class="dropdown-divider"></div>
				              <a class="dropdown-item" href="adm/clientes.php">Listar</a>
				            </div>
					      </li>');
					} else {
						echo ('
					      <li class="nav-item">
					        <a class="nav-link" href="fazer-pedido.php">Fazer Pedido</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="cliente/meus-pedidos.php?cliente=' . $_SESSION['CODIGO'] . '">Meus Pedidos</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="cliente/editar-conta.php?cliente=' . $_SESSION['CODIGO'] . '">Conta</a>
					      </li>
				      ');
					}
				}
				?>
				<li class="nav-item">
					<a class="nav-link" href="php/logout.php" id="l_c">
						<?php
						if (!$logado) {
							echo "Log-in / Cadastro";
						} else {
							echo "Log-out";
						}
						?>
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container" id="main">
		<div class="big-title">
			Nosso cardápio
		</div>
		<div class="row m-70">
			<div class="col-md-6" data-anime="top">
				<p class="text-medium">
					Temos uma ampla variedade de pratos e bebidas para satisfazer qualquer um. Venha desfrutar desse sabor e tormar uma boa cerveja com a gente.
				</p>
				<center>
					<button class="circle-btn text-medium" style="border-radius: 5px; margin-bottom: 10px;">
						Ler mais
					</button>
				</center>
			</div>
			<div class="col-md-6" data-anime="top">
				<img src="arquivos/banner.jpg" width="100%" draggable="false" />
			</div>
		</div>
		<div class="big-title">
			Localização
		</div>
		<div class="row m-70">
			<div class="col-md-6" data-anime="top">
				<img src="arquivos/banner.jpg" width="100%" draggable="false" />
			</div>
			<div class="col-md-6" data-anime="top">
				<p class="text-medium">
					Não possuimos endereço físico, mas fazemos entregas na região e garantimos a melhor qualidade possível.
				</p>
				<center>
					<button class="circle-btn text-medium" style="border-radius: 5px;">
						Ler mais
					</button>
				</center>
			</div>
		</div>
		<div class="big-title">
			Nosso Chefe
		</div>
		<div class="row m-70" style="margin-bottom: 55px;">
			<div class="col-md-6" data-anime="top">
				<p class="text-medium">
					Nosso chefe possuí vasta experiência na culinária local, e garante que seus pratos vão te fazer pedir replay!
				</p>
				<center>
					<button class="circle-btn text-medium" style="border-radius: 5px; margin-bottom: 10px;">
						Ler mais
					</button>
				</center>
			</div>
			<div class="col-md-6" data-anime="top">
				<img src="arquivos/banner.jpg" width="100%" draggable="false" />
			</div>
		</div>
	</div>

	<div class="container-fluid" id="footer">
		<div class="container" id="footer-content">
			<div class="mapasite">
				<div class="row" style="font-family: 'Playfair Display', serif;">
					<div class="col-md-3" id="local">
						<span class="small-title" style="color: #fff">Localidade</span>
						<p>Não possuimos endereço físico</p>
						<p>(88) 8107-1542</p>
					</div>
					<div class="col-md-3">
						<span class="small-title" style="color: #fff">Como fazer pedidos</span>
						<p>1 - Cadastre-se</p>
						<p>2 - Faça log-in</p>
						<p>3 - Faça seu pedido</p>
					</div>
					<div class="col-md-3">
						<span class="small-title" style="color: #fff">Entragamos bebidas</span>
						<p>Sim, fazemos entregas de bebidas</p>
					</div>
					<div class="col-md-3">
						<span class="small-title" style="color: #fff">Não se preocupe</span>
						<p>Caso aja algum engano entre em contado com o número abaixo</p>
						<p>(88) 8107-1542</p>
					</div>
				</div>
			</div>

			<center>
				<div id="division">
					<img src="arquivos/mail-icon.png" width="45" height="45" />
				</div>
			</center>

			<div class="row">
				<div class="col-md-12">
					<p align="center" class="small-title">Assine nossa newslleter para receber novidades !</p>
				</div>
				<div class="col-md-12">
					<form class="form-newslleter" action="" method="POST">
						<div class="form-n">
							<input type="email" class="form-c" id="staticEmail2" placeholder="Seu e-mail">
						</div>
						<div class="form-n">
							<input type="text" class="form-c" id="inputPassword2" placeholder="Seu nome">
						</div>
						<button type="submit" class="circle-btn" id="circle">Ok</button>
					</form>
				</div>
			</div>

			<center>
				<div class="copyrigth">
					<p>
						Todos os direitos reservados - <a class="link" href="">Fabricio Souza</a>
					</p>
				</div>
			</center>

		</div>
	</div>
	<div class="modal-container" id="log_cad">
		<div class="modal-window">
			<div class="close-n">X</div>
			<div class="row">

				<div class="col-md-12" id="login">
					<div class="big-title" style="padding-bottom: 30px;">
						Login <?php
								if ($error_login) {
									echo " - Erro no login";
								}
								?>
					</div>
					<form action="" method="POST" class="form-newslleter inline-f" style="left: 50%;">
						<div class="form-n">
							<label for="email">E-mail</label>
							<input class="form-c" type="email" id="email" name="login" placeholder="Exemplo: valdir@gmail.com" />
						</div>
						<div class="form-n">
							<label for="senha">Senha</label>
							<input class="form-c" type="password" id="senha" name="senha" placeholder="Senha de login" />
						</div>
						<center style="padding: 10px;">
							<button type="submit" class="circle-btn" style="border-radius: 5px;">Log-in</button>
						</center>
						<center style="padding: 10px;">
							<a href="cadastro.php" id="cad-link">Ou cadastre-se</a>
						</center>
					</form>
				</div>

			</div>
		</div>
	</div>

	<script type="text/javascript">
		var janelaModal = document.querySelector('#log_cad');
		var abreJanela = $('#l_c');
		var login = $('#login');
		var cadastro = $('#cadastro');

		<?php
		if (!$logado) {
			echo "abreJanela.click(function(e) {
						e.preventDefault();
						abrirJanela(janelaModal);
					});";
		}
		?>

		<?php
		if ($error_login) {
			echo "abrirJanela(janelaModal)";
		}
		?>

		function abrirJanela(janela) {
			janela.classList.toggle('show-modal');
			$('.modal-window').addClass('show-top');

			janela.addEventListener('click', function(e) {
				e.stopPropagation();

				if (e.target == janela) {
					fecharJanela(janela);
				}
			});

			janela.querySelector('.close-n').onclick = function() {
				janela.classList.toggle('show-modal');
			}
		}

		function fecharJanela(janela) {
			janela.classList.remove('show-modal');
			$('.modal-window').removeClass('show-top');
		}
	</script>

</body>

</html>