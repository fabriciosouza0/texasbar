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
$descricao = $_GET['descricao'];
$preco = $_GET['preco'];
$categoria = $_GET['categoria'];

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
                <li class="nav-item">
                    <a class="nav-link" href="pedidos.php">Pedidos<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown active">
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
        <form id="cad-user" action="../php/editar_produto.php" method="POST" class="form-horizontal p-3 mb-5 rounded">
            <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
            <div class="big-title small-title" style="padding-top: 0px; padding-bottom: 15px;">
                Editar produto - <?php echo $nome; ?>
            </div>
            <?php
            if (isset($_GET['update_dados'])) {
                $update_dados = $_GET['update_produto'];

                if ($update_dados == 0) {
                    echo ('<div class="alert alert-danger">
                                Erro ao atualizar produto!
                            </div>');
                } else {
                    echo ('<div class="alert alert-success">
                                Produto atualizado com sucesso!
                            </div>');
                }
            }
            ?>
            <div class="form-row">
                <input type="hidden" class="form-control" id="codigo" name="codigo" placeholder="Nome" value="<?php echo $codigo ?>" />
                <div class="form-group col-md-2" id="nome-inp">
                    <label for="novoCodigo">Codigo <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="novoCodigo" name="novoCodigo" placeholder="Código de identificação" value="<?php echo $codigo ?>" required />
                </div>
                <div class="form-group col-md-5" id="nome-inp">
                    <label for="nome">Nome <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome ?>" required />
                </div>
                <div class="form-group col-md-5" id="sobrenome-inp">
                    <label for="descricao">Descrição <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do produto" value="<?php echo $descricao; ?>" required />
                </div>
                <div class="form-group col-md-12" id="tel-inp">
                    <label for="preco">Preço <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="preco" maxlength="5" name="preco" placeholder="Preço do produto" value="<?php echo $preco; ?>" required />
                </div>
                <div class="form-group col-md-12" id="email-inp">
                    <label for="categoria">Categoria <span style="color: #FFBA08">*</span></label>
                    <select class="form-control" id="categoria" name="categoria" required>
                        <?php
                        include_once('../php/conexao.php');

                        $sql = "SELECT * FROM CATEGORIA";
                        $query = mysqli_query($con, $sql);

                        while ($rowC = mysqli_fetch_assoc($query)) {
                            if ($rowC['CODIGO'] == $codigo) {
                                echo ('<option value="' . $rowC['CODIGO'] . '" selected>' . $rowC['NOME'] . '</option>');
                            } else {
                                echo ('<option value="' . $rowC['CODIGO'] . '">' . $rowC['NOME'] . '</option>');
                            }
                        }
                        ?>
                    </select>
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