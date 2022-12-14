<?php

session_start();

if (isset($_SESSION['ATIVA']) && $_SESSION['ATIVA']) {
    $nomeS = $_SESSION['NOME'];
    $privilegio = $_SESSION['PRIVILEGIO'];

    if ($privilegio != 1) {
        header('location: ../');
    }
} else {
    header('location: ../');
}

$codigo = $_GET['codigo'];
$nome = $_GET['nome'];
$sobrenome = $_GET['sobrenome'];
$telefone = $_GET['telefone'];
$email = $_GET['email'];
$bairro = $_GET['bairro'];
$rua = $_GET['rua'];
$numero = $_GET['numero'];
$complemento = $_GET['complemento'];

?>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Editar - Cliente <?php echo $nome; ?></title>
    <link href="../css/fontes.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
        #cad-user {
            color: #fff;
        }

        .icone {
            width: 45px;
            height: 45px;
        }

        table tr td,
        th {
            text-align: center;
        }
    </style>

<body class="bg-dark">
    <div class="container-fluid" id="header">

    </div>
    <nav class="navbar navbar-rigth navbar-expand-lg navbar-dark fixed-top shadow-b" style="background: #333;">
        <a class="navbar-brand" href="#">
            <img src="../arquivos/brand.png" width="50px" height="45px" alt="" />
            <span id="brand-text">O melhor restaurante - ADM <?php echo $nomeS; ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../">Home</a>
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
    <div class="container" id="main" style="padding-top: 50px; padding-bottom: 50px;">
        <form id="cad-user" action="../php/editar_usuario.php" method="POST" class="form-horizontal p-3 mb-5 rounded">
            <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
            <div class="big-title small-title" style="padding-top: 0px; padding-bottom: 15px;">
                Editar usu??rio <?php echo $nome; ?>
            </div>
            <div class="alert" id="alert" style="display: none;"></div>
            <div class="form-row">
                <div class="form-group col-md-6" id="nome-inp">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome ?>" />
                </div>
                <div class="form-group col-md-6" id="sobrenome-inp">
                    <label for="sobreNome">Sobrenome</label>
                    <input type="text" class="form-control" id="sobreNome" name="sobrenome" placeholder="Sobrenome" value="<?php echo $sobrenome; ?>" />
                </div>
                <div class="form-group col-md-12" id="tel-inp">
                    <label for="tel">Telefone</label>
                    <input type="text" class="form-control" id="tel" maxlength="15" name="tel" placeholder="Telefone" value="<?php echo $telefone; ?>" />
                </div>
                <div class="form-group col-md-12" id="email-inp">
                    <label for="nome">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4" id="data-inp">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Exemplo: Serrinha" value="<?php echo $bairro; ?>" />
                </div>
                <div class="form-group col-md-4" id="data-inp">
                    <label for="rua">Rua</label>
                    <input type="text" class="form-control" id="rua" name="rua" placeholder="Exemplo: Jo??o Quintino" value="<?php echo $rua; ?>" />
                </div>
                <div class="form-group col-md-4" id="data-inp">
                    <label for="numero">N??mero</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Exemplo: 44" value="<?php echo $numero; ?>" />
                </div>
                <div class="form-group col-md-12" id="data-inp">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento do endere??o" value="<?php echo $complemento; ?>" />
                </div>
            </div>
            <button id="submit" type="submit" class="circle-btn" style="width: 100%; border-radius: 5px;">
                Atualizar
            </button>
        </form>
    </div>

    <div class="container-fluid" id="footer">
        <div class="container" id="footer-content">
            <div class="mapasite">
                <div class="row" style="font-family: 'Playfair Display', serif;">
                    <div class="col-md-3" id="local">
                        <span class="small-title" style="color: #fff">Localidade</span>
                        <p>N??o possuimos endere??o f??sico</p>
                        <p>(88) 8107-1542</p>
                    </div>
                    <div class="col-md-3">
                        <span class="small-title" style="color: #fff">Como fazer pedidos</span>
                        <p>1 - Cadastre-se</p>
                        <p>2 - Fa??a log-in</p>
                        <p>3 - Fa??a seu pedido</p>
                    </div>
                    <div class="col-md-3">
                        <span class="small-title" style="color: #fff">Entragamos bebidas</span>
                        <p>Sim, fazemos entregas de bebidas</p>
                    </div>
                    <div class="col-md-3">
                        <span class="small-title" style="color: #fff">N??o se preocupe</span>
                        <p>Caso aja algum engano entre em contado com o n??mero abaixo</p>
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