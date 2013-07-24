<?php
	include 'conn.php';
	$cidades = array();
	$rsCidades = mysql_query("SELECT nome FROM cidades WHERE uf LIKE 'AC' ORDER BY nome");

	if($rsCidades === FALSE) {
		die(mysql_error());
	}

	while($row = mysql_fetch_array($rsCidades)) {
		$cidades[] = $row["nome"];
	}

	echo json_encode($cidades);
?>