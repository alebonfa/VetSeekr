<?php
    include 'php/conn.php';
    $query = mysql_query("SELECT id, nome, descricao FROM especialidades");
?>

<!DOCTYPE html>
<html lang="pt-BR" class="no-js">

  <head>

    <title>ABVET - Associação Brasileira de Veterinários Especialistas</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="js/modernizr/modernizr-latest.js"></script>
    <script src="js/jquery/jquery.js"></script>
    <script src="js/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/bootstrap/js/bootstrap-select.min.js"></script>

    <link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="js/bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/app.css">

  </head>

  <body>

        <!-- Início da barra de navegação -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">ABVET</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="index.html" title="Página inicial">Home</a></li>
                            <li><a href="#" title="">VetSeekr</a></li>
                            <li><a href="#" title="">Estatísticas</a></li>
                            <li><a href="#" title="">Perfil</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
               </div>
           </div>
        </div>

        <div class="container-fluid hero">
 
            <!-- Hero unit para o showcase -->
            <div class="hero-unit">
                <form class="form-inline">
                    <legend>Encontre o seu Veterinário Especialista</legend>
                    <div class="controls controls-row">
                        <label class="span2">Especialidade</label>
                        <select class="span10 selectpicker" multiple>
                            <option>Selecione...</option>
                            <?php while($i = mysql_fetch_array($query)) { ?>
                                <option value="<?php echo $i['id'] ?>">
                                    <?php echo $i['nome']?>
                                </option>
                            <?php } ?>
                        </select>
                        <label class="span2">Cidade</label>
                        <select class="span10 selectpicker">
                        </select>
                        <a href="#" class="btn btn-primary btn-medium span2 offset1" rel="" title="">Pesquisar 1</a>
                    </div>
                </form>
            </div>
        </div> <!-- /container hero -->

        <div class="container-fluid submenu"><!-- Submenu -->
            <div class="row-fluid">
                <div class="span12">
                    <p>Aqui podemos colocar um submenu, ou até mesmo utilizar Breadcrumbs!</p>
                </div>
            </div>
        </div><!-- /Submenu -->

        <div class="row">
            <div class="span4"><!-- Primeiro bloco de conteúdo -->
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="span4"><!-- Segundo bloco de conteúdo -->
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="span4"><!-- Terceiro bloco de conteúdo -->
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div><!-- Fim da linha -->


        <!-- Aqui colocaremos nosso container e uma linha com 3 colunas -->
        <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span4">
                            <h2>Título</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <p><a class="btn" href="#" title="">Veja mais »</a></p>
                        </div>
                        <div class="span4">
                            <h2>Título</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <p><a class="btn" href="#" title="">Veja mais »</a></p>
                       </div>
                        <div class="span4">
                            <h2>Título</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <p><a class="btn" href="#" title="">Veja mais »</a></p>
                        </div>
                    </div>
        </div> <!-- /container-->




    <div class="row">
      <div class="span2"></div>
      <div class="span6"></div>
    </div>

    <script type="text/javascript">
        $('.selectpicker').selectpicker();
    </script>


  </body>
</html>