<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Cadastro</title>
	<link href="css/fontes.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		body {
			background: url(arquivos/banner.jpg) center no-repeat;
			background-size: cover;
			background-attachment: fixed
		}

        #cad-user {
           	background-color: rgba(0,0,0,0.5); color: #fff;
        }

        .centered {
            position: absolute;
            left: 50%; top: 50%;
            transform: translate(-50%, -50%);
        }
        
        @media screen and (max-width: 778px) {
            #cad-user {
            	width: 90%;
                background-color: rgba(0,0,0,0.5); 
                color: #fff;
            }
        }
	</style>
</head>
<body>
	<div class="container">
        <form id="cad-user" action="php/cadastro.php" method="POST" class="form-horizontal centered shadow p-3 mb-5 rounded">
        	<div class="big-title small-title" style="padding-top: 0px; padding-bottom: 15px;">
				Campos com * são obrigatórios
			</div>
            <div class="alert" id="alert" style="display: none;"></div>
            <div class="form-row">
                <div class="form-group col-md-6" id="nome-inp">
                    <label for="nome">Nome <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" />
                </div>
                <div class="form-group col-md-6" id="sobrenome-inp">
                    <label for="sobreNome">Sobrenome <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="sobreNome" name="sobrenome" placeholder="Sobrenome" />
                </div>
                <div class="form-group col-md-12" id="tel-inp">
                    <label for="tel">Telefone <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="tel" maxlength="15" name="tel" placeholder="Telefone" />
                </div>
                <div class="form-group col-md-12" id="email-inp">
                    <label for="nome">E-mail <span style="color: #FFBA08">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" />
                </div>
                <div class="form-group col-md-12" id="email-inp">
                    <label for="senha">Senha <span style="color: #FFBA08">*</span></label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4" id="data-inp">
                    <label for="bairro">Bairro <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Exemplo: Serrinha" />
                </div>
                <div class="form-group col-md-4" id="data-inp">
                    <label for="rua">Rua <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="rua" name="rua" placeholder="Exemplo: João Quintino" />
                </div>
                <div class="form-group col-md-4" id="data-inp">
                    <label for="numero">Número <span style="color: #FFBA08">*</span></label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Exemplo: 44" />
                </div>
                <div class="form-group col-md-12" id="data-inp">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento do endereço" />
                </div>
            </div>
            <button id="submit" type="submit" class="circle-btn" style="width: 100%; border-radius: 5px;">
           		Cadastrar-se
        	</button>
        </form>
    </div>
</body>
</html>