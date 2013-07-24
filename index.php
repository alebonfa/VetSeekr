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
    <script src="//underscorejs.org/underscore-min.js"></script>

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
            <form>
                <legend>Encontre o seu Veterinário Especialista</legend>
                <div class="row-fluid">
                    <div class="span2">
                        <label>Especialidade</label>
                    </div>
                    <div class="span10">
                        <select class="span12 selectpicker" multiple title="Selecione os Especialistas Desejados..." data-selected-text-format="count>2">
                            <option>Selecione...</option>
                            <?php while($i = mysql_fetch_array($query)) { ?>
                            <option value="<?php echo $i['id'] ?>">
                                <?php echo $i['nome']?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2">
                        <label>Cidade</label>
                    </div>
                    <div class="span8">
                        <input autocomplete="off" autotype="text" class="span12 search-query" placeholder="Procurar" id= "srcCidades" 
                        data-provide="typeahead" data-items="6">
                    </div>
                    <div class="span2">
                        <a href="#" class="span12 btn btn-primary btn-medium" rel="" title="">Pesquisar</a>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- /container hero -->

    <script type="text/javascript">

        $(function(){

            var cidades = [];

            $('.selectpicker').selectpicker();

            /*
            var call = $.ajax({
                type: "POST",
                url: "php/getCidades.php",
                dataType: "json",
                async: false,
                success: function(result){
                    alert(result);
                }
            }).responseText;
            */

            $("#srcCidades").typeahead({
                source : function(query, process) {
                    $.ajax({
                        url: "php/getCidades.php",
                        cache: false,
                        success: function(data) {
                            cidades = [];
                            _.each( data, function(item, ix, list) {
                                cidades.push(item.nome);
                            });
                            alert(cidades)
                            process(cidades);
                        }
                    });
                }
            });
        });

    </script>


</body>
</html>