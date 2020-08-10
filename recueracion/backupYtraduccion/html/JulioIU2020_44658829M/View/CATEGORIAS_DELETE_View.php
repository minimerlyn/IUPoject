<?php
//Clase : CATEGORIAS_DELETE_View
//Creado el : 8-06-2020
//Creado por: grvidal
//Muestra el formulario de Eliminar una categoria, que consta de el nombre de la categoria y no es editable
// y los manda por post a CATEGORIAS_CONTROLLER con el action DELEETE
//-------------------------------------------------------

		class CATEGORIAS_DELETE{

		var $valores;
		var $eliminable;

		function __construct($valores,$eliminable){		 
			$this->eliminable = $eliminable; 
			$this->valores = $valores;
			$this->render();
		}

		function render(){
		?>
		<head>
			<link rel="stylesheet" type="text/css" href="../View/css/estilo.css"> 
			<title class="Tedit"> Tedit</title>
		</head>
		
		<?php include '../View/Header.php'; //header necesita los strings?>
			<h1 class="eliminarProducto"></h1>	
			<form name = 'Form' action='../Controller/CATEGORIAS_Controller.php?action=DELETE' method='post' onsubmit="return comprobarCategoriaEdit(this);" enctype="multipart/form-data">
				 	
				 <?php if($this->eliminable == 'false'){ ?>
					<label class="CatNoEliminable tituloStyle errormsg" style="visibility: visible;"></label><br><br>
				<?php } ?>

				<div class="form-group">
				 	<label for="id" class="idCategoria">idCategoria </label> 
				 	<br> 
				 	<input class="form-control" type = 'text' name = 'id' id = 'id' value="<?php echo $this->valores['ID'] ;?>" onblur="comprobarEntero(this);" readonly>
				</div>&nbsp;&nbsp;
				 	
				<div class="form-group">
				 	<label for="nombre" class="nombreCategoria">nombreCategoria </label> 
				 	<br> 
				 	<input class="form-control" type = 'text' name = 'nombre' id = 'nombre' placeholder = 'Letras y numeros' size = '30' onblur="comprobarAlfabetico(this,50);" value="<?php echo $this->valores['NOMBRE_CATEGORIA'] ;?>" readonly>
				</div>&nbsp;&nbsp;


				<button type="submit" name='action' class="btn btn-primary submit" value="DELETE" >
					submit
				</button>

			</form>

			
			<a href='../Controller/CATEGORIAS_Controller.php'><img src="../View/icon/back.ico" height="32" width="32"> </a>
			<br><br>
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>