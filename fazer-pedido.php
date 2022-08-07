<?php
	session_start();
	include_once('php/conexao.php');

	$logado = false;
	$error_login = false;

	if(isset($_POST['login']) && $_POST['senha']) {
		$login = $_POST['login'];
		$senha = $_POST['senha'];

		$sql = "SELECT * FROM USUARIO WHERE EMAIL = '$login' AND SENHA = '$senha'";
		$query = mysqli_query($con, $sql);
		$nUsuario = mysqli_num_rows($query);

		if($nUsuario > 0) {
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
				header('location: adm/pedidos.php');
			}else {
				header('location: fazer-pedido.php');
			}
		}else {
			$error_login = true;
		}
	}

	if(isset($_SESSION['ATIVA']) && $_SESSION['ATIVA']) {
		$codigo = $_SESSION['CODIGO'];
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
		#main {
			padding-bottom: 50px;
		}

		#total {
			position: fixed;
			display: flex;
			justify-content: center;
			align-items: center;
			bottom: 15px;
			right: 0px;
			padding: 7px;
			height: 40px;
			background: rgba(0,0,0, 0.5);
			border-top-left-radius: 5px;
			border-bottom-left-radius: 5px;
			color: #FFBA08;
		}

		#valor {
			padding-left: 7px;
			padding-right: 4px;
		}

		.read {
			border: 0;
			outline: 0;
			color: #FFF;
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
	  		if($logado) {
	  			if($privilegio == 1) {
	  				echo " - ADM ".$nome;
	  			}else {
	  				echo " - ".$nome;
	  			}
	  		}
	  		?></span>
	  </a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="../valeria_fernanda">Home</a>
	      </li>
	      <?php 
	      	if(!$logado) {
	      		echo ('<li class="nav-item">
				        <a class="nav-link" href="#">Quem Somos</a>
				        <span class="line-hover"></span>
				      </li>
				      <li class="nav-item active">
				        <a class="nav-link" href="fazer-pedido.php">Fazer Pedido</a>
				      </li>');
	      	}else {
	      		if($privilegio == 1) {
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
	      		}else {
	      			echo ('
					      <li class="nav-item active">
					        <a class="nav-link" href="#">Fazer Pedido</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="cliente/meus-pedidos.php?cliente='.$_SESSION['CODIGO'].'">Meus Pedidos</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="cliente/editar-conta.php?cliente='.$_SESSION['CODIGO'].'">Conta</a>
					      </li>
				      ');
	      		}
	      	}
	      ?>
	      <li class="nav-item">
	        <a class="nav-link" href="php/logout.php" id="l_c">
	        	<?php 
	        		if(!$logado) {
	        			echo "Log-in / Cadastro";
	        		}else {
	        			echo "Log-out";
	        		}
	        	?>
	    	</a>
	      </li>
	    </ul>
	  </div>
	</nav>

	<div class="container" id="main">
		<?php

			if($logado) {
				echo('<div class="big-title">
					Monte seu pedido abaixo !
				</div>');
			}else {
				echo('<div class="big-title">
					Faça login para fazer um pedido !
				</div>
				<center><button class="circle-btn" id="abreJanela-btn" style="border-radius: 5px;">Log-in</button></center>');
			}

			$sql_numero_de_categorias = "SELECT * FROM CATEGORIA ORDER BY NOME";
			$query_numero_de_categorias = mysqli_query($con, $sql_numero_de_categorias);
			$nCategorias = mysqli_num_rows($query_numero_de_categorias);

			if($nCategorias > 0 && $logado) {
				while ($row = mysqli_fetch_assoc($query_numero_de_categorias)) {
					$arr[] = $row;
				}
				echo('<form class="form-horizontal" id="pedido_form" action="php/pedido.php" method="POST">
					<input type="hidden" name="usuario" value="'.$codigo.'">');
				echo('<input type="hidden" name="valor" id="valor-input">');

				for($i = 0; $i < $nCategorias; $i++) {
					$sql_produtos = "SELECT * FROM PRODUTO WHERE CATEGORIA_CODIGO = ".$arr[$i]["CODIGO"];
					$query_produtos = mysqli_query($con, $sql_produtos);
					$nProdutos = mysqli_num_rows($query_produtos);

					if($nProdutos > 0) {
						echo '<center><div class="small-title" style="font-size: 1.3em;">'.$arr[$i]["NOME"].'</div></center>';
						
						echo('<div class="table-responsive text-center"><table class="table table-striped table-dark">
							  <thead>
							    <tr>
							      <th scope="col">Selecionar</th>
							      <th scope="col">Prato</th>
							      <th scope="col">Descrição</th>
							      <th scope="col">Preço</th>
							    </tr>
							  </thead><tbody>');
						while($row_p = mysqli_fetch_assoc($query_produtos)) {
							echo('<tr>
									<td align="center"><input type="checkbox" name="codigo[]" value="'.$row_p["CODIGO"].'" onchange="somaTotal();"></td>
					    			<th scope="row">'.$row_p["NOME"].'</th>
					    			<td>'.$row_p["DESCRICAO"].'</td>
					    			<td>
					    				<div class="form-row">
					    					<div class="form-group col-md-6">
					    						<input type="text" class="read form-control-plaintext form-control-sm text-right" readonly value="R$"/>
					    					</div>
					    					<div class="form-group col-md-6">
					    						<input type="text" name="preco" class="read form-control-sm form-control-plaintext stext-left" readonly value="'.$row_p["PRECO"].'"></td>
					    					</div>
					    				</div>
					    		</tr>');
						}
						echo('</tbody></table></div>');
					}else {

					}
				}
				echo('<center><button type="submit" class="circle-btn" style="border-radius: 5px;">Fazer pedido</button><center></form>');
			}else {

			}
		?>
	</div>

	<script type="text/javascript">
		function somaTotal() {
			var selecionados = document.querySelectorAll('input[type=checkbox]');
			var preco = document.querySelectorAll('input[name=preco]');
			var totalE = document.getElementById('valor');
			var totalInput = document.getElementById('valor-input');
			var total = 0;

			for(var i = 0; i < selecionados.length; i++) {
				if(selecionados[i].checked){
					total += +preco[i].value;
				}
			}

			totalE.innerHTML = total.toFixed(2);
			totalInput.value = total.toFixed(2);
		}
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
			</div>

			<center>
				<div id="division">
					<img src="arquivos/mail-icon.png" width="45" height="45" />
				</div>
			</center>

			<div class="row" style="margin: 0;">
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
						Todos os direitos reservados - <a class="link" href="">Valéria Kessia</a> e <a class="link" href="">Fernanda Antunes</a>
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
							if($error_login) {
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
							<a href="cadastro.php" class="link">Ou cadastre-se</a>
						</center>
					</form>
				</div>

			</div>
		</div>
	</div>

	<script type="text/javascript">
		var janelaModal = document.querySelector('#log_cad');
		var abreJanela = $('#l_c');
		var abreJanela_btn = $('#abreJanela-btn');
		var login = $('#login');
		var cadastro = $('#cadastro');
		var pedido_form = $('#pedido_form');

		<?php  

			if(!$logado) {
				echo('pedido_form.submit(function(e) {
					e.preventDefault();
					alert("Faça login antes de concluir");
				});');
			}

		?>

		<?php 
			if(!$logado) {
				echo "abreJanela.click(function(e) {
						e.preventDefault();
						abrirJanela(janelaModal);
					});";
				echo "abreJanela_btn.click(function(e) {
					e.preventDefault();
					abrirJanela(janelaModal);
				});";
			}
		?>

		<?php 
			if($error_login) {
				echo "abrirJanela(janelaModal)";
			}
		?>

		function abrirJanela(janela) {
			janela.classList.toggle('show-modal');
			$('.modal-window').addClass('show-top');

			janela.addEventListener('click', function(e) {
				e.stopPropagation();

				if(e.target == janela) {
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
	<div id="total">
		Total:<span id="valor">0</span>R$
	</div>
</body>
</html>