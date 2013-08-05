<?php

    function validateAndSend() {

        include_once 'inc/php/config.php';
        include_once 'inc/php/functions.php';

        //setup some variables/arrays
        $action = array();
        $action['result'] = null;

        $text = array();

        //cleanup the variables
        //prevent mysql injection
        $username = mysql_real_escape_string($_POST['username']);
        $password = mysql_real_escape_string($_POST['password']);
        $email = mysql_real_escape_string($_POST['email']);
        
        //quick/simple validation
        if(empty($username)){ $action['result'] = 'error'; array_push($text,'You forgot your username'); }
        if(empty($password)){ $action['result'] = 'error'; array_push($text,'You forgot your password'); }
        if(empty($email)){ $action['result'] = 'error'; array_push($text,'You forgot your email'); }
        
        if($action['result'] != 'error'){
                    
            $password = md5($password); 
                
            //add to the database
            $add = mysql_query("INSERT INTO `users` VALUES(NULL,'$username','$password','$email',0)");
            
            if($add){
                
                //get the new user id
                $userid = mysql_insert_id();
                
                //create a random key
                $key = $username . $email . date('mY');
                $key = md5($key);
                
                //add confirm row
                $confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')"); 
                
                if($confirm){
                
                    //include the swift class
                    include_once 'inc/php/swift/swift_required.php';
                
                    //put info into an array to send to the function
                    $info = array(
                        'username' => $username,
                        'email' => $email,
                        'key' => $key);
                
                    //send the email
                    if(send_email($info)){
                                    
                        //email sent
                        $action['result'] = 'success';
                        array_push($text,'Thanks for signing up. Please check your email for confirmation!');
                    
                    }else{
                        
                        $action['result'] = 'error';
                        array_push($text,'Could not send confirm email');
                    
                    }
                
                }else{
                    
                    $action['result'] = 'error';
                    array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
                    
                }
                
            }else{
            
                $action['result'] = 'error';
                array_push($text,'User could not be added to the database. Reason: ' . mysql_error());
            
            }
        
        }
        
        $action['text'] = $text;

    }

?>

<!--
<script>

    function validaCadastrar() {
        if(document.Cadastro.txtNome.value=="") {
            alert('Nome em Branco');
        } else {
            document.getElementById("mostraNome").innerHTML = "ABC" ;//<?php teleportaNome(document.getElementById('txtNome').value); ?>";
        }
        if(document.Cadastro.txtEmail.value=="") {
            alert('e-mail em Branco');
        }
        if(document.Cadastro.txtSenha.value=="") {
            alert('Senha em Branco');
        }
        return true;
    }

</script>
-->

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
                    <li class="active"><a href="index.php" title="Página inicial">Encontre o Seu Especialista</a></li>
                    <li><a href="#" title="">Ranking</a></li>
                </ul>

                <ul class="nav pull-right">
                    <ul class="nav">
                        <li><a href="#mdlSignup" role="button" data-toggle="modal">Cadastre-se</a></li>
                    </ul>
                    <li class="dropdown">
                        <a id="" href="" class="dropdown-toggle" data-toggle='dropdown' style='padding-top:8px;padding-bottom:2px;'>
                            Bem Vindo, Usuário
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" role="menu" arialabledy="">
                            <li><a href="" role="menuitem">Edit Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="" role="menuitem">Log Out</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>

</div>

<div id="mdlSignup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Cadastre-se</h3>
    </div>
    <div class="modal-body">
        <form name="Cadastro" method="POST">
            <!--
            <div class="row-fluid">
                
                <div class="alert">
                    
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>Atenção!</strong> Preencha todos os campos
                    
                </div>
                
            </div>
            -->
            <div id="mostraNome"></div>

            <div class="row-fluid">
                <div class="span2">
                    <label>Nome:</label>
                </div>
                <div class="span10">
                    <input class="span12" type="text" id="txtNome">
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2">
                    <label>e-mail:</label>
                </div>
                <div class="span10">
                    <input class="span12" type="text" id="txtEmail">
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2">
                    <label>Senha:</label>
                </div>
                <div class="span5">
                    <input class="span12" type="password" id="txtSenha">
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
        <button class="btn btn-primary" name="btnCadastrar">Salvar mudanças</button>
    </div>

</div>