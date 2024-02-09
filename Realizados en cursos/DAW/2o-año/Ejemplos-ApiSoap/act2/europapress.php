<?php 
    $fichero = new DOMDocument();
	$fichero->load("https://www.europapress.es/rss/rss.aspx?ch=00066");
	$salida = array(); 
	$noticias = $fichero->getElementsByTagName("item");
    foreach($noticias as $entry) {
		$nuevo = array();
		$nuevo["title"] = $entry->getElementsByTagName("title")[0]->nodeValue;
        $nuevo["description"] = $entry->getElementsByTagName("description")[0]->nodeValue;
		$nuevo["guid"] =  $entry->getElementsByTagName("guid")[0]->nodeValue;
		$salida[] = $nuevo;
    }
?>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Noticias</title>
		<style> table, td, th { border-style: solid} </style>
	</head>
	<body>
		<table>
			<tr><td>Título</td><td>Descripción</td><td>Enlace</td></tr>
			<?php
				foreach($salida as $elemento) {
					$titulo = $elemento["title"];
					$desc = $elemento["description"];
					$url = $elemento["guid"];
					echo "<tr><td>$titulo</td><td>$desc</td><td><a href=".$url." target='_blank'>Ir a la noticia</a></td></tr>";
				}
			?>
		</table>
	</body>
</html>