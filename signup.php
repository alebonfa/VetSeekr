<?php

    if(isset($_POST['txtNome'])) {

        include_once 'php/conn.php';
        include_once 'php/functions.php';

        //inializando arrays de mensagens de sucesso/erro
        $action = array();
        $action['result'] = null;

        $text = array();

        //transporte de variáveis, previnindo mysql injection
        $nome = mysql_real_escape_string($_POST['txtNome']);
        $email = mysql_real_escape_string($_POST['txtEmail']);
        $senha = mysql_real_escape_string($_POST['txtSenha']);
        
        //validações
        if(empty($email)) { 
        	$action['result'] = 'error'; 
        	array_push($text,'O e-mail deve ser válido!'); 
        } else {

        	$procura = mysql_query("SELECT * FROM usuarios WHERE email = '$email'") or die("Execução de consulta gerou o seguinte erro no MYSQL: " . mysql_error());
        	if(mysql_num_rows($procura)>0) {
	        	$action['result'] = 'error'; 
    	    	array_push($text,'Este e-mail já está cadastrado!'); 
        	} else {
		        if(empty($nome)) { 
		        	$action['result'] = 'error'; 
		        	array_push($text,'O Nome deve ser preenchido!'); 
		        }
		        if(empty($senha)) { 
		        	$action['result'] = 'error'; 
		        	array_push($text,'A Senha não pode estar em branco!'); 
		       	}
		    }
        }
        

        if($action['result'] != 'error'){
            $senha = md5($senha); 
            //adicionando ao banco de dados
            $add = mysql_query("INSERT INTO usuarios VALUES(NULL,'$email','$nome','$senha',0)");
            if($add){
                //salvando o ID recém criado
                $userid = mysql_insert_id();
                //criando uma chave randômica, baseado no nome e e-mail
                $key = $nome . $email . date('mY');
                $key = md5($key);
                //add confirm row
                $confirm = mysql_query("INSERT INTO confirm VALUES(NULL,'$userid','$key','$email')"); 
                if($confirm){
                    //incluindo a classe swift para controlar envios de e-mail
                    include_once 'php/swift/swift_required.php';
                    //criando array de informações para envio do e-mail de confirmações
                    $info = array(
                        'nome' => $nome,
                        'email' => $email,
                        'senha' => $senha,
                        'key' => $key);
                    //enviando o e-mail
                    if(send_email($info)){
                        //email enviado
                        $action['result'] = 'success';
                        array_push($text,'Obrigado por se Cadastrar! Verifique seu e-mail para confirmação.');
                    }else{
                        $action['result'] = 'error';
                        array_push($text,'O e-mail não pôde ser enviado.');
                    }
                }else{
                    $action['result'] = 'error';
                    array_push($text,'A confirmação não pôde ser salva. Motivo: ' . mysql_error());
                }
            }else{
                $action['result'] = 'error';
                array_push($text,'O usuário não pôde ser salvo. Motivo: ' . mysql_error());
            }
        }

        $action['text'] = $text;

            echo json_encode(array("success", "Foi!"));
            exit;

  

        return json_encode($action);


    }


?>