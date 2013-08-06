<?php
	$nome = $_POST["txtNome"];
	if(isset($_POST['txtNome'])) {
		echo "<script>alert('Deu Certo!');</script>";
	} else {
		echo "<script>alert('Não deu certo!');</script>";
	}
?>