<?php
session_start();

include_once('../php/conexao.php');

if (isset($_SESSION['ATIVA']) && $_SESSION['ATIVA']) {
	$nome = $_SESSION['NOME'];
	$privilegio = $_SESSION['PRIVILEGIO'];
	$cliente = $_GET['cliente'];

	if ($privilegio != 2 || $_SESSION['CODIGO'] != $cliente) {
		header('location: ../');
	}

	$sql = "SELECT * FROM USUARIO WHERE CODIGO = $cliente";
	$query = mysqli_query($con, $sql);
	$dadosDoCliente = mysqli_fetch_assoc($query);

	$nome = $dadosDoCliente['NOME'];
	$sobrenome = $dadosDoCliente['SOBRENOME'];
	$telefone = $dadosDoCliente['TELEFONE'];
	$bairro = $dadosDoCliente['BAIRRO'];
	$rua = $dadosDoCliente['RUA'];
	$numero = $dadosDoCliente['NUMERO'];
	$complemento = $dadosDoCliente['COMPLEMENTO'];
} else {
	header('location: ../');
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Restaurante - Cliente <?php echo $nome; ?></title>
	<link href="../css/fontes.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		.icone {
			width: 45px;
			height: 45px;
		}

		table tr td,
		th {
			text-align: center;
		}

		.list-group .list-group-item {
			font-family: 'Playfair Display', serif;
			font-weight: bold;
			color: #333;
			transition: ease-in-out .2s;
		}

		.list-group .list-group-item:hover {
			cursor: pointer;
			background: #FFBA08;
			color: #FFF;
		}
	</style>
</head>

<body class="bg-dark">
	<div class="container-fluid" id="header">

	</div>
	<nav class="navbar navbar-rigth navbar-expand-lg navbar-dark fixed-top shadow-b" style="background: #333;">
		<a class="navbar-brand" href="#">
			<img src="../arquivos/brand.png" width="50px" height="45px" alt="" />
			<span id="brand-text">O melhor restaurante - Pedidos / <?php echo $nome; ?></span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="../">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../fazer-pedido.php">Fazer Pedido</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="meus-pedidos.php?cliente=<?php echo $cliente; ?>">Meus Pedidos<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">Conta</a>
					<span class="line-hover"></span>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../php/logout.php" id="l_c">Log-out</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container" id="main" style="padding-bottom: 50px;">
		<div class="row">
			<div class="col-md-3">
				<section>
					<ul class="list-group" style="margin-top: 45px;">
						<li class="list-group-item"><a class="blocked" data-toggle="collapse" href="#dados-pessoais">Dados Pessoais</a></li>
						<li class="list-group-item"><a class="blocked" data-toggle="collapse" href="#email">E-mail</a></li>
						<li class="list-group-item"><a class="blocked" data-toggle="collapse" href="#senha">Senha</a></li>
					</ul>
				</section>
			</div>
			<div class="col-md-9">
				<div id="accordion">
					<div id="dados-pessoais" class="collapse show" data-parent="#accordion">
						<div class="big-title">Dados Pessoais</div>
						<form id="cad-user" action="../php/editar_usuario.php?op=0" method="POST" class="form-horizontal" style="color: #fff;">
							<?php
							if (isset($_GET['update_dados'])) {
								$update_dados = $_GET['update_dados'];

								if ($update_dados == 0) {
									echo ('<div class="alert alert-danger">
								            	Erro ao atualizar dados!
								            </div>');
								} else {
									echo ('<div class="alert alert-success">
								            	Dados atualizados com sucesso!
								            </div>');
								}
							}
							?>
							<input type="hidden" name="codigo" value="<?php echo $cliente; ?>">
							<div class="form-row">
								<div class="form-group col-md-6" id="nome-inp">
									<label for="nome">Nome <span style="color: #FFBA08">*</span></label>
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome ?>" />
								</div>
								<div class="form-group col-md-6" id="sobrenome-inp">
									<label for="sobreNome">Sobrenome <span style="color: #FFBA08">*</span></label>
									<input type="text" class="form-control" id="sobreNome" name="sobrenome" placeholder="Sobrenome" value="<?php echo $sobrenome ?>" />
								</div>
								<div class="form-group col-md-12" id="tel-inp">
									<label for="tel">Telefone <span style="color: #FFBA08">*</span></label>
									<input type="text" class="form-control" id="tel" maxlength="15" name="tel" placeholder="Telefone" value="<?php echo $telefone ?>" />
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4" id="data-inp">
									<label for="bairro">Bairro <span style="color: #FFBA08">*</span></label>
									<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Exemplo: Serrinha" value="<?php echo $bairro ?>" />
								</div>
								<div class="form-group col-md-4" id="data-inp">
									<label for="rua">Rua <span style="color: #FFBA08">*</span></label>
									<input type="text" class="form-control" id="rua" name="rua" placeholder="Exemplo: João Quintino" value="<?php echo $rua ?>" />
								</div>
								<div class="form-group col-md-4" id="data-inp">
									<label for="numero">Número <span style="color: #FFBA08">*</span></label>
									<input type="text" class="form-control" id="numero" name="numero" placeholder="Exemplo: 44" value="<?php echo $numero ?>" />
								</div>
								<div class="form-group col-md-12" id="data-inp">
									<label for="complemento">Complemento</label>
									<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento do endereço" value="<?php echo $complemento ?>" />
								</div>
							</div>
							<button id="submit" type="submit" class="circle-btn" style="width: 100%; border-radius: 5px;">
								Atualizar
							</button>
						</form>
					</div>

					<div id="senha" class="collapse" data-parent="#accordion">
						<div class="big-title">Senha</div>
						<form id="cad-user" action="../php/editar_usuario.php?op=1" method="POST" class="form-horizontal" style="color: #fff;">
							<?php
							if (isset($_GET['update_senha'])) {
								$update_senha = $_GET['update_senha'];

								if ($update_senha == 0) {
									echo ('<div class="alert alert-danger">
								            	Erro ao atualizar senha, a senha informada não corresponde!
								            </div>');
								} else {
									echo ('<div class="alert alert-success">
								            	Senha atualizada com sucesso!
								            </div>');
								}
							}
							?>
							<input type="hidden" name="codigo" value="<?php echo $cliente; ?>">
							<div class="form-row">
								<div class="form-group col-md-12" id="email-inp">
									<label for="senha">Senha Antiga <span style="color: #FFBA08">*</span></label>
									<input type="password" class="form-control" id="antigaSenha" name="antigaSenha" placeholder="Senha anterior" />
								</div>
								<div class="form-group col-md-12" id="email-inp">
									<label for="senha">Senha Nova <span style="color: #FFBA08">*</span></label>
									<input type="password" class="form-control" id="novaSenha" name="novaSenha" placeholder="Senha desejada" />
								</div>
							</div>
							<button id="submit" type="submit" class="circle-btn" style="width: 100%; border-radius: 5px;">
								Atualizar
							</button>
						</form>
					</div>

					<div id="email" class="collapse" data-parent="#accordion">
						<div class="big-title">E-mail</div>
						<form id="cad-user" action="../php/editar_usuario.php?op=2" method="POST" class="form-horizontal" style="color: #fff;">
							<?php
							if (isset($_GET['update_email'])) {
								$update_email = $_GET['update_email'];

								if ($update_email == 0) {
									echo ('<div class="alert alert-danger">
								            	Erro ao atualizar e-mail!
								            </div>');
								} else {
									echo ('<div class="alert alert-success">
								            	E-mail atualizado com sucesso!
								            </div>');
								}
							}
							?>
							<input type="hidden" name="codigo" value="<?php echo $cliente; ?>">
							<div class="form-row">
								<div class="form-group col-md-12" id="email-inp">
									<label for="senha">E-mail Antigo <span style="color: #FFBA08">*</span></label>
									<input type="email" class="form-control" id="antigoEmail" name="antigoEmail" placeholder="E-mail anterior" />
								</div>
								<div class="form-group col-md-12" id="email-inp">
									<label for="senha">E-mail Novo <span style="color: #FFBA08">*</span></label>
									<input type="email" class="form-control" id="novoEmail" name="novoEmail" placeholder="E-mail desejado" />
								</div>
							</div>
							<button id="submit" type="submit" class="circle-btn" style="width: 100%; border-radius: 5px;">
								Atualizar
							</button>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

	</script>

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
					<img src="../arquivos/mail-icon.png" width="45" height="45" />
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
						Todos os direitos reservados - <a class="" href="">Fabricio</a>
					</p>
				</div>
			</center>

		</div>
	</div>
</body>

</html>