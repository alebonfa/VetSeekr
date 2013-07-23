<?php
	$cidades = array("Campinas","Valinhos","Vinhedo");
	//$query = mysql_query("SELECT nome FROM cidades WHERE uf = 'AC' ORDER BY nome");
	//while($row = mysql_fetch_array($query)) {
	//	$cidades[] = $row["nome"];
	//}
	echo json_encode($cidades);
?>