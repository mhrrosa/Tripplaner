<html>    
    <head>
    <link rel="stylesheet" type="text/css" href="CSS/cadastro.css">
    <title>Cadastro Local - TripPlanner</title>
    <link rel="icon" type="image/jpg" href="IMG/logo_transparente.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

        <style>
        .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: left;
        }
        .rating > span {
            display: inline-block;
            position: relative;
            width: 1.1em;
        }
        .rating > span:hover:before,
        .rating > span:hover ~ span:before {
            content: "\2605";
            position: absolute;
            color: gold;
        }

        .menu {
            position: fixed;
            top: 0;
            left: -100%;
            width: 10%;
            height: 100%;
            background-color: #5C4033;
            z-index: 9999;
            transition: left 0.3s;
            border-radius: 0; /* Remova esta propriedade */
        }

        .menu.show {
            left: 0;
        }

        .menu a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }

        .menu a:hover {
            background-color: #3D291F;
        }
    </style>
</head>
<body>
    <!-- CONEXÃO COM O BANCO DE DADOS -->
    <?php require 'conectaBD.php'; ?>
    <!-- CABEÇALHO -->
    <header class="cabecalho">
        <div class="menu" id="menu">
            <a href="inicio.php">Inicio</a>
            <a href="cadastroUsuario.php">Cadastrar Usuário</a>
            <a href="mostrarLocal.php">Locais Cadastrados</a>
            <a href="cadastroLocal.php">Cadastrar Local</a>
        </div>

        <script>
            function toggleMenu() {
                var menu = document.getElementById("menu");

                menu.classList.toggle("show");
            }

            function openModal() {
                // Implemente aqui a lógica para abrir a janela modal
            }
        </script>

        <img class="logo" src="IMG/logo_horizontal.png"/>

        <div class="botao-cabecalho">
            <ul>
                <li><a href="#" onclick="toggleMenu()"><h3>MENU</h3></a></li>
                <li><a href=""><h3>SOBRE</h3></a></li>
                <li><a href=""><h3>CONTATO</h3></a></li>
            </ul>
        </div>
    </header>
    <!-- LINHA DE DIVISÃO -->
    <header class="linha-divisao"></header>
    <!-- FORMULÁRIO -->
    <div class="formcadastro">
        <form id="cadastro" action="cadastroLocal_exe.php" enctype="multipart/form-data" method="post">
            <div class="form">
                <label class="titulo-form" for="text"><b>CADASTRO DE LOCAL</b></label>
                <label for="nome">Nome
                    <input type="text" name="nome" required>
                </label>
                <label for="rua">Descrição
                    <textarea name="descricao" required></textarea>
                </label>
                <label for="rua">Rua
                    <input type="text" name="rua" required>
                </label>
                <label for="numero">Número
                    <input type="text" name="numero" required>
                </label>
                <label for="bairro">Bairro
                    <input type="text" name="bairro" required>
                </label>
                <label for="cidade">Cidade
                    <input type="text" name="cidade" required>
                </label>
                
                <label for="name"> Preferencia
                            <select name="preferencia" required>
                                <option class="indicacao-option" value="">Selecione a preferencia desejada:</option>
                        <?php		
                            $id=$_GET['id'];

                            // Cria conexão
                            $conn = mysqli_connect($servername, $username, $password, $database);

                            // Verifica conexão
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
                            // Configura para trabalhar com caracteres acentuados do português	 
                            mysqli_query($conn,"SET NAMES 'utf8'");
                            mysqli_query($conn,'SET character_set_connection=utf8');
                            mysqli_query($conn,'SET character_set_client=utf8');
                            mysqli_query($conn,'SET character_set_results=utf8');

                            // Faz Select na Base de Dados

                            $sql = "SELECT id, nome from preferencia";

                            if ($result = mysqli_query($conn, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $nome = $row['nome'];
                        ?>

                                <option value="<?php echo $id ?>"><?php echo $nome ?></option>
                            
                        <?php
                                    }
                                } else {
                                    //ENCERRA CONEXÃO COM O BANCO DE DADOS
                                    mysqli_close($conn);
                                }
                            }
                        ?>
                        </select>
                        </label>
                <p>
                    <label class="w3-text-deep-brown"><b>Imagem:</b></label>
                    <label class="w3-btn w3-theme"><b>Selecione uma imagem</b>
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                    <input type="file" style="display:none;background-color:brown;" id="Imagem" name="Imagem" accept="imagem/*" onchange="previewImagem();"></label>
                </p>
                <img id="imgCamp" style="width:20vw;height:auto;">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script>
                    function previewImagem(){
                        var imagem = document.querySelector('input[name=Imagem]').files[0];
                        var preview = document.getElementById('imgCamp');

                        var reader = new FileReader();
                        reader.onload = function(e){
                            preview.src = e.target.result;
                        }
                        if(imagem){
                            reader.readAsDataURL(imagem);
                        }else{
                            preview.src = "";
                        }
                    }
                </script>
                <label for="submit"> 
                    <button class="botao-cadastro" type="submit"><b>Cadastrar</b></button>
                </label>
            </div>
        </form>
    </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    <!-- RODAPÉ -->
    <footer>
        <header class="linha-divisao"></header>
        <img class="img-rodape" src="IMG/logo_principal.png">
        <p class="copyright">&copy; Copyright TripPlanner - 2023</p>
    </footer>
<?php 
    //FIM DA DIV FORM
    echo "</div>";
    //ENCERRA CONEXÃO COM O BANCO DE DADOS
    mysqli_close($conn);
?>
</body>
</html>
