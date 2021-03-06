<?php
//Clase : PROF_ESPACIO_SHOWCURRENT_View
//Creado el : 2-10-2019
//Creado por: grvidal
//Muestra todos los campos con los datos de la relacion
//-------------------------------------------------------
class PROF_ESPACIO_SHOWCURRENT {

	var $lista;
	var $datos;


	function __construct($lista){
		session_start();
		$this->lista = $lista;
		$this->render();
	}

	function render(){
	
		include '../Locale/Strings_' . $_SESSION['idioma'] . '.php';

		?>
		<head>
			<title class="TShowC"><?php echo $strings['TShowC']; ?></title>
			<link rel="stylesheet" type="text/css" href="../View/css/estilo.css"> 
		</head>

		<?php include '../View/Header.php'; //header necesita los strings ?>

		<h1 class="TShowC"><?php echo $strings['TShowC']; ?></h1>
		<table border="1">
			<th>
				DNI
			</th>
			<th class="CodEspacio">
				<?php echo $strings['CodEspacio']; ?>
			</th>


			<tr>
				<td>
					<?php echo $this->lista['DNI'] ; ?>
				</td>
				<td>
					<?php  echo $this->lista['CODESPACIO']; ?>
				</td>
				<td>
					<a href = "../Controller/PROF_ESPACIO_Controller.php?action=EDIT&&DNI=<?php echo $this->lista['DNI'];?>&&codE=<?php echo $this->lista['CODESPACIO']; ?>"  > 
						<img src='../View/icon/edituser.ico'>
					</a>
				</td>
				<td>
					<a href = "../Controller/PROF_ESPACIO_Controller.php?action=DELETE&&DNI=<?php echo $this->lista['DNI']; ?>&&codE=<?php echo $this->lista['CODESPACIO']; ?>"  > 
						<img src='../View/icon/deleteuser.ico'>
					</a>
				</td>
			</tr>
			

		</table>
		<br>

		<a href='../Controller/PROF_ESPACIO_Controller.php'><img src="../View/icon/back.ico" height="32" width="32"> </a>

		<?php
		include '../View/Footer.php';
	}

}

?>