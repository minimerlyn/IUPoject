<?php
//Clase : GENERAL_test
//Creado el : 20-11-2019
//Creado por: grvidal
//Fichero de test que llama al resto de ficheros de test 
//Contiene php para mostrar el resultado de los tests
//-------------------------------------------------------
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting( E_PARSE);

// crear el array principal de test
	$ERRORS_array_test = array();
// incluimos aqui tantos ficheros de test como entidades
	include_once '../test/Global_test.php';	
	include_once '../test/USUARIOS_test.php';
	include_once '../test/EDIFICIO_test.php';
	include_once '../test/CENTRO_test.php';
	include_once '../test/TITULACION_test.php';
	include_once '../test/PROFESOR_test.php';
	include_once '../test/PROF_TITULACION_test.php';
	include_once '../test/ESPACIO_test.php';
	include_once '../test/PROF_ESPACIO_test.php';
	include_once '../test/CLEAN_test.php';
	include_once '../test/USUARIOS_VADLICACION_test.php';
	include_once '../test/TITULACION_VADLICACION_test.php';
	include_once '../test/PROFESOR_VADLICACION_test.php';
	include_once '../test/PROF_TITULACION_VADLICACION_test.php';
	include_once '../test/PROF_ESPACIO_VADLICACION_test.php';
	include_once '../test/ESPACIO_VADLICACION_test.php';
	include_once '../test/EDIFICIO_VADLICACION_test.php';
	include_once '../test/CENTRO_VADLICACION_test.php';

			

?>
<head>
	<title>Tests</title>
	<link rel="stylesheet" type="text/css" href="../View/css/estilo.css"> 
</head>
<body style="margin-left: 20px">

<h1> RESUMEN</h1>
<h2>Numero de pruebas: <?php echo count($ERRORS_array_test); ?> -Numero de errores :  
	<?php $n = 0;
		foreach ($ERRORS_array_test as $test ) {
			if ($test['resultado'] == 'FALSE') $n++; 
		}
		echo $n ;
	?> 
</h2>
<br>
<div class="MainDiv">
		
	<h1>DETALLE</h1>
	<?php
	// presentacion de resultados
	?>
	<h2>Pruebas Globales</h2>

	<table  border="1" >
		<tr>
			<th>
				Error testeado
			</th>
			<th>
				Valor Esperado
			</th>
			<th>
				Valor Obtenido
			</th>
			<th>
				Resultado
			</th>
		</tr>
	<?php
		foreach ($ERRORS_array_test as $test)
		{
			if ($test['tipo'] == 'GLOBAL') {
	?>
		<tr>
			<td>
				<?php echo $test['error']; ?>
			</td>
			<td>
				<?php echo $test['error_esperado']; ?>
			</td>
			<td>
				<?php echo $test['error_obtenido']; ?>
			</td>
			<td>
				<?php echo $test['resultado']; ?>
			</td>
		</tr>
	<?php
			}
		}
	?>
	</table>

	<h2>Pruebas Unitarias</h2>
	<table  border="1">
		<tr>
			<th>
				Entidad
			</th>
			<th>
				Método
			</th>
			<th>
				Error testeado
			</th>
			<th>
				Valor Esperado
			</th>
			<th>
				Valor Obtenido
			</th>
			<th>
				Resultado
			</th>
		</tr>
	<?php
		foreach ($ERRORS_array_test as $test)
		{
			if ($test['tipo'] == 'P_UNITARIA') {
	?>
		<tr>
			<td>
				<?php echo $test['entidad'];?>
			</td>
			<td>
				<?php echo $test['metodo']; ?>
			</td>
			<td>
				<?php echo $test['error']; ?>
			</td>
			<td>
				<?php echo $test['error_esperado']; ?>
			</td>
			<td>
				<?php echo $test['error_obtenido']; ?>
			</td>
			<td>
				<?php echo $test['resultado']; ?>
			</td>
		</tr>
	<?php	
			}
		}
	?>
	</table>

	<h2>Pruevas Validación</h2>
	<table border="1">
		<tr>
			<th>
				Entidad
			</th>
			<th>
				Atributo
			</th>
			<th>
				Error testeado
			</th>
			<th>
				Valor Esperado
			</th>
			<th>
				Valor Obtenido
			</th>
			<th>
				Resultado
			</th>
		</tr>
	<?php
		foreach ($ERRORS_array_test as $test)
		{
			if($test['tipo'] == 'VALIDACION' ){
	?>
		<tr>
			<td>
				<?php echo $test['entidad'];?>
			</td>
			<td>
				<?php echo $test['metodo']; ?>
			</td>
			<td>
				<?php echo $test['error']; ?>
			</td>
			<td>
				<?php echo $test['error_esperado']; ?>
			</td>
			<td>
				<?php echo $test['error_obtenido']; ?>
			</td>
			<td>
				<?php echo $test['resultado']; ?>
			</td>
		</tr>
	<?php	
			}
		}
	?>
	</table>
</div>
</body>
