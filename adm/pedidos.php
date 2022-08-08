<?php
session_start();

include_once('../php/conexao.php');

if (isset($_SESSION['ATIVA']) && $_SESSION['ATIVA']) {
	$nome = $_SESSION['NOME'];
	$privilegio = $_SESSION['PRIVILEGIO'];

	if ($privilegio != 1) {
		header('location: ../');
	}
} else {
	header('location: ../');
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Restaurante - ADM <?php echo $nome; ?></title>
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
	</style>
</head>

<body class="bg-dark">
	<div class="container-fluid" id="header">

	</div>
	<nav class="navbar navbar-rigth navbar-expand-lg navbar-dark fixed-top shadow-b" style="background: #333;">
		<a class="navbar-brand" href="#">
			<img src="../arquivos/brand.png" width="50px" height="45px" alt="" />
			<span id="brand-text">O melhor restaurante - ADM <?php echo $nome; ?></span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="../">Home<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">Pedidos<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Produtos</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="cadastro-produto.php">Cadastrar</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="produtos.php">Listar</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Clientes</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="cadastrar-cliente.php">Cadastrar</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="clientes.php">Listar</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../php/logout.php" id="l_c">Log-out</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container" id="main" style="padding-bottom: 50px;">
		<div class="big-title">Lista de pedidos</div>
		<div class="table-responsive">
			<table class="table table-striped table-dark">
				<thead>
					<tr>
						<th scope="col">Cliente</th>
						<th scope="col">Pedido</th>
						<th scope="col">Bairro</th>
						<th scope="col">Rua</th>
						<th scope="col">Número</th>
						<th scope="col">Situação</th>
						<th scope="col">Total</th>
						<th scope="col">Elevar situação</th>
						<th scope="col">Cancelar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "select pedido.codigo as PEDIDO, pedido.SITUACAO, usuario.nome as CLIENTE, usuario.codigo as CLIENTECODIGO, venda.total, usuario.bairro as BAIRRO, usuario.rua as RUA, usuario.numero as NUMERO from pedido
						inner join usuario on usuario.codigo = pedido.usuario_codigo
						inner join venda on pedido.codigo = venda.pedido_codigo";
					$query = mysqli_query($con, $sql);
					if ($query) {
						while ($row = mysqli_fetch_assoc($query)) {
							$bairro = $row['BAIRRO'];
							$rua = $row['RUA'];
							$numero = $row['NUMERO'];
					?>
							<tr>
								<th scope="row"><?php echo $row['CLIENTE'] ?></th>
								<td>
									<?php
									$sql_produtos_pedido = "select pedido.codigo, produto.nome from pedido_has_item 
										inner join produto on produto.codigo = pedido_has_item.produto_codigo
										inner join pedido on pedido.codigo = pedido_has_item.pedido_codigo where pedido_has_item.pedido_codigo = " . $row['PEDIDO'] . " and pedido.usuario_codigo = " . $row['CLIENTECODIGO'];
									$query_produtos_pedido = mysqli_query($con, $sql_produtos_pedido);

									$arr = array();
									while ($row_produtos_pedido = mysqli_fetch_assoc($query_produtos_pedido)) {
										$arr[] = $row_produtos_pedido;
									}

									foreach ($arr as $key => $value) {
										if ($key + 1 != sizeof($arr)) {
											echo $value['nome'] . ', ';
										} else {
											echo $value['nome'];
										}
									}
									?>
								</td>
								<td><?php echo $bairro; ?></td>
								<td><?php echo $rua; ?></td>
								<td><?php echo $numero; ?></td>
								<td><?php
									switch ($row['SITUACAO']) {
										case 0:
											echo "Em preparo";
											break;
										case 1:
											echo "Saiu para entrega";
											break;
										case 2:
											echo "entregue";
											break;
										case 3:
											echo "Cancelado";
											break;
									}
									?></td>
								<td><?php echo $row['total'] . ' R$'; ?></td>
								<td>
									<a href="../php/subir_situacao.php?codigo=<?php echo $row['PEDIDO']; ?>&situacao=<?php echo $row['SITUACAO']; ?>">
										<img src="../arquivos/up.png" class="icone" />
									</a>
								</td>
								<td>
									<a href="../php/cancelar.php?pedido=<?php echo $row['PEDIDO'] ?>">
										<img src="../arquivos/cancelar.png" class="icone" />
									</a>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
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
						Todos os direitos reservados - <a class="" href="">Fabricio Souza</a>
					</p>
				</div>
			</center>

		</div>
	</div>
</body>

</html>