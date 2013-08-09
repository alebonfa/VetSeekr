<?php
	include 'php/conn.php';
    include 'elements/header.php';
?>

<?php

//setup some variables
$action = array();
$action['result'] = null;

//check if the $_GET variables are present
	
//quick/simple validation
if(empty($_GET['email']) || empty($_GET['key'])){
	$action['result'] = 'ALGO ESTÁ ERRADO!';
	$action['text'] = 'Não encontramos seus dados. Favor verificar novamente o seu e-mail.';
}
		
if($action['result'] != 'ALGO ESTÁ ERRADO!'){

	//cleanup the variables
	$email = mysql_real_escape_string($_GET['email']);
	$key = mysql_real_escape_string($_GET['key']);
	
	//check if the key is in the database
	$check_key = mysql_query("SELECT * FROM `confirm` WHERE `email` = '$email' AND `chave` = '$key' LIMIT 1") or die(mysql_error());
	
	if(mysql_num_rows($check_key) != 0){
				
		//get the confirm info
		$confirm_info = mysql_fetch_assoc($check_key);
		
		//confirm the email and update the users database
		$update_users = mysql_query("UPDATE `usuarios` SET `ativo` = 1 WHERE `id` = '$confirm_info[usuario_id]' LIMIT 1") or die(mysql_error());
		//delete the confirm row
		$delete = mysql_query("DELETE FROM `confirm` WHERE `id` = '$confirm_info[id]' LIMIT 1") or die(mysql_error());
		
		if($update_users){
						
			$action['result'] = 'PARABÉNS!';
			$action['text'] = 'Seu cadastro está confirmado! Obrigado!';
		
		}else{

			$action['result'] = 'ALGO ESTÁ ERRADO!';
			$action['text'] = 'Estamos com problemas de acesso ao nosso Banco de Dados. Favor tentar mais tarde!';
		
		}
	
	}else{
	
		$action['result'] = 'ALGO ESTÁ ERRADO!';
		$action['text'] = 'Seus dados de confirmação não se encontram em nosso Banco de Dados!';
	
	}

}

?>
<div class="container-fluid hero">
	<div class="hero-unit">
		<legend><strong>CONFIRMAÇÃO DE CADASTRO</strong></legend>
		<?php if($action['result']=="ALGO ESTÁ ERRADO!") {
				echo '<div class="alert alert-error">';
			} else {
				echo '<div class="alert alert-success">';
			}
			echo $action['result'];
			echo '</div>';
		?>
		<p><?php echo $action['text']?></p>
		<a href="index.php" class="btn btn-primary btn-large pull-right" title="">Ir para a Página Inicial</a>
	</div>
</div>

<?php
    include 'elements/footer.php';
?>

