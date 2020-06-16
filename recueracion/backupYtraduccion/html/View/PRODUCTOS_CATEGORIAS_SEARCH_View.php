<?php
//Clase : PRODUCTOS_CATEGORIAS_ADD_View
//Creado el : 10-06-2020
//Creado por: grvidal
//Muestra unos campos para ser rellenados y los manda por post al controlador
//-------------------------------------------------------

	class PRODUCTOS_CATEGORIAS_SEARCH{


		function __construct(){	
			$this->render();
		}

		function render(){ 
		?>
		<head>
			<link rel="stylesheet" type="text/css" href="../View/css/estilo.css"> 
			<title class="Tsearch"> Buscar</title>
		</head>
		
		<?php include '../View/Header.php'; //header necesita los strings 
			include_once '../Model/USUARIOS_Model.php';
					$usuario = new USUARIOS_Model($_SESSION['login'],'','','','','','','','','','','','','');//Recuperamos el usuario que esta operando
					$usuariosProductos = $usuario->getUsuariosConProductos();//recuperamos los nombres de las personas con productos en oferta?>
			<h1 class="searchProducto"><?php echo $strings['searchProducto']; ?></h1>	
			<form name = 'Form' action='../Controller/PRODUCTOS_CATEGORIAS_Controller.php?action=SEARCH' method='post' onsubmit="return comprobarCategoriasSearch(this);" enctype="multipart/form-data">
				 	
				<div class="form-group">
				 	<label for="idProducto" class="nombreCategoria"><?php echo $strings['nombreCategoria'] ?> </label> 
				 	<br> 
				 	<input class="form-control" type = 'text' name = 'idProducto' id = 'idProducto' placeholder = 'Letras y numeros' size = '30' onblur="comprobarAlfabeticoVacio(this,50);">
				 	<label class="errormsg letrasynumeros" for="idProducto" id="idProducto_error" > <?php echo $strings['letrasynumeros'] ?> </label>
				 	<label class="errormsg tooShortNoNum" for="idProducto" id="idProducto_errorLength" > <?php echo $strings['tooShortNoNum'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="idCategoria" class="nombreCategoria"><?php echo $strings['nombreCategoria'] ?> </label> 
				 	<br> 
				 	<input class="form-control" type = 'text' name = 'idCategoria' id = 'idCategoria' placeholder = 'Letras y numeros' size = '30' onblur="comprobarAlfabeticoVacio(this,50);">
				 	<label class="errormsg letrasynumeros" for="idCategoria" id="idCategoria_error" > <?php echo $strings['letrasynumeros'] ?> </label>
				 	<label class="errormsg tooShortNoNum" for="idCategoria" id="idCategoria_errorLength" > <?php echo $strings['tooShortNoNum'] ?> </label>
				</div>&nbsp;&nbsp;


				<button type="submit" name='action' class="btn btn-primary submit" value="SEARCH" >
					<?php echo $strings['submit'] ; ?>
				</button>

			</form>

			
			<a href='../Controller/PRODUCTOS_CATEGORIAS_Controller.php'><img src="../View/icon/back.ico" height="32" width="32"> </a>
			<br><br>
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>