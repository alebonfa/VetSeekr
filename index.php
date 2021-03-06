<?php
    include 'php/conn.php';
    $query = mysql_query("SELECT id, nome, descricao FROM especialidades");
?>

<?php
    include 'elements/header.php';
?>

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
                            <input autocomplete="on" autotype="text" class="span12 search-query" placeholder="Procurar" id= "srcCidades" 
                            data-provide="typeahead" data-items="8">
                        </div>
                        <div class="span2">
                            <a href="#" class="span12 btn btn-primary btn-medium" rel="" title="">Pesquisar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- /container hero -->

        <div class="row-fluid">
            <div class="span6">
                <label>Cidade:</label><span id="lblCidade"></span>
           </div>
        </div>

            <section>
                <p><input type=button id="btnMyPosition" value="Obter minha Posição"></p>
                <p id="msg"></p>
            </section>
            <section>
                <div id="mapa"></div>
            </section>

<?php
    include 'elements/footer.php'; 
?>
