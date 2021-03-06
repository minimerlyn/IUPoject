<?php
//Clase : TITULACION_DELETE_View
//Creado el : 2-10-2019
//Creado por: grvidal
//Muestra los campos de la tupla antes de eliminarlo
//-------------------------------------------------------
	class TITULACION_DELETE{

		var $valores;

		function __construct($valores){	
			session_start();
			$this->valores = $valores;
			$this->render();
		}

		function render(){

			include '../Locale/Strings_' . $_SESSION['idioma'] . '.php';
		?>
			<head>
				<link rel="stylesheet" type="text/css" href="../css/estilo.css"> 
				<script type="text/javascript" src='../js/validaciones.js'></script>
				<title class="Tdelete"> <?php echo $strings['Tdelete']; ?> </title>
			</head> 

			<?php include '../View/Header.php'; //header necesita los strings ?>
			<h1 class="deleteTitulation"><?php echo $strings['deleteTitulation']; ?></h1>	
			<form name = 'Form' action='../Controller/TITULACION_Controller.php?action=DELETE' method='post' onsubmit="return comprobar_registro();">

				 	<div class="form-group">
				 	<label for="titulacion" class="CODTITULACION"><?php echo $strings['CODTITULACION'] ?> </label>  
				 	<input class="form-control" type = 'text' name = 'titulacion' id = 'titulacion' value = '<?php echo $this->valores['CODTITULACION']; ?>' placeholder = 'letras y numeros' size = '10' onblur="comprobarAlfabetico(this,10);" readonly>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="centro" class="NomCentro"><?php echo $strings['NomCentro'] ?> </label> 
				 	<input type = 'text' name = 'centro' id = 'centro' placeholder = 'Letras y numeros' size = '10' value = '<?php echo $this->valores['CODCENTRO']; ?>' onblur="comprobarAlfabetico(this,10);" readonly>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="name" class="nameTitulation"><?php echo $strings['nameTitulation'] ?>  </label> 
				 	<input class="form-control" type = 'text' name = 'nameT' id = 'nameT' value = '<?php echo $this->valores['NOMBRETITULACION']; ?>' placeholder = 'Solo letras' size = '20' onblur="comprobarTexto(this,50)" readonly >
				</div>&nbsp;&nbsp;
 
 				<div class="form-group">
				 	<label for="responsable" class="responsableTitulation"><?php echo $strings['responsableTitulation'] ?>  </label>

				 	<input class="form-control" type = 'text' name = 'responsable' id = 'responsable' value = '<?php echo $this->valores['RESPONSABLETITULACION']; ?>' placeholder = 'Solo letras' size = '20' value = '' onblur="comprobarTexto(this,60)" readonly >
				</div>&nbsp;&nbsp;

				<button type="submit" name='action' class="btn btn-primary submit" value="DELETE" >
					<?php echo $strings['submit'] ; ?>
				</button>

			</form>
				
		
			<a href='../Controller/TITULACION_Controller.php'><img src="../View/icon/back.ico" height="32" width="32"> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>