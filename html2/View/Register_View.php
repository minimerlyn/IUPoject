<?php

	class Register{


		function __construct(){	
			$this->render();
		}

		function render(){

			include '../Locale/Strings_' . $_SESSION['idioma'] . '.php';
		?>
		<head>
			<link rel="stylesheet" type="text/css" href="../View/css/estilo.css"> 
			<script type="text/javascript" src='../js/validaciones.js'></script>
			<title class="Tadd"> <?php echo $strings['Tadd']; ?></title>
		</head>
		<?php include '../View/Header.php'; //header necesita los strings ?>
		
			<h1 class="Registro"><?php echo $strings['Registro']; ?></h1>	
			<form name = 'Form' action='../Controller/Register_Controller.php' method='post' onsubmit="return comprobarUsuarios(this);">
			
				<div class="form-group">
				 	<label for="login" class="Login"><?php echo $strings['Login'] ?> </label>  
				 	<input class="form-control" type = 'text' name = 'login' id = 'login' placeholder = 'Utiliza tu login' size = '10' onblur="comprobarAlfabetico(this,15);" required>
				 	<label class="errormsg letrasynumeros" for="login" id="login_error" > <?php echo $strings['letrasynumeros'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="password" class="password"><?php echo $strings['password'] ?> </label> 
				 	<input class="form-control" type = 'password' name = 'password' id = 'password' placeholder = 'letras y numeros' size = '15' value = '' onblur="comprobarAlfabetico(this,128)" required >
				 	<label class="errormsg letrasynumeros" for="password" id="password_error" > <?php echo $strings['letrasynumeros'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="DNI" class="DNI">DNI  </label> 
				 	<input class="form-control" type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu dni' size = '9' onblur="comprobarDni(this)" required >
				 	<label class="errormsg dniError" for="DNI" id="DNI_error" > <?php echo $strings['dniError'] ?> </label>
				</div>&nbsp;&nbsp; 

				<div class="form-group">
					<label for="nombre" class="name"><?php echo $strings['name'] ?>  </label>
				 	<input class="form-control" type = 'text' name = 'nombre' id = 'nombre' placeholder = 'Solo letras' size = '20' onblur="comprobarTexto(this,30)" required >
				 	<label class="errormsg textonly" for="nombre" id="nombre_error" > <?php echo $strings['textonly'] ?> </label>
				</div>&nbsp;&nbsp; 
 
 				<div class="form-group">
				 	<label for="apellidos" class="surname"><?php echo $strings['surname'] ?>  </label>
				 	<input class="form-control" type = 'text' name = 'apellidos' id = 'apellidos' placeholder = 'Solo letras' size = '50' value = '' onblur="comprobarTexto(this,50)" required >
				 	<label class="errormsg textonly" for="apellidos" id="apellidos_error" > <?php echo $strings['textonly'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="tlf" class="tlf"><?php echo $strings['tlf'] ?>  </label>
				 	<input class="form-control" type = 'number' name = 'tlf' id = 'tlf' placeholder = 'Numero de telefono' size = '9' value = '' onblur="comprobarTelf(this)" required >
				 	<label class="errormsg tlfError" for="tlf" id="tlf_error" > <?php echo $strings['tlfError'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="email" class="email">Email </label>
				 	<input class="form-control" type = 'text' name = 'email' id = 'email' placeholder ='Utiliza tu correo' size = '40' value = '' onblur="comprobarEmail(this,60)" required >

				 	<label class="errormsg emailError" for="email" id="email_error" > <?php echo $strings['emailError'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="bday" class="bDate"><?php echo $strings['bDate'] ?>  </label>
				 	<input class="form-control" type = 'date' name = 'bday' id = 'bday' onblur="comprobarFechaNacimiento(this);" required>
				 	<label class="errormsg bdayError" for="bday" id="bday_error" > <?php echo $strings['bdayError'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="foto" class="picture"><?php echo $strings['picture'] ?>  </label>
				 	<input type = 'file' name = 'foto' id = 'foto' onblur="comprobarExtension(this)" required >
				 	<label class="errormsg fotoError" for="foto" id="foto_error" > <?php echo $strings['fotoError'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="sexo" class="sexo"><?php echo $strings['sexo'] ?>  </label>
				 	<select name="sexo" required>
    						<option class="male" value="hombre"> <?php echo $strings['male'] ; ?></option>
    						<option class="female" value="mujer"> <?php echo $strings['female'] ; ?></option>
					</select>

				 	<label class="errormsg sexoError" for="sexo" id="sexo_error" > <?php echo $strings['sexoError'] ?> </label>
				</div>&nbsp;&nbsp;

				<button type="submit" name='action' class="btn btn-primary submit" value="REGISTER" >
					<?php echo $strings['submit'] ; ?>
				</button>

			
			<a href='../Controller/Index_Controller.php'> <?php echo $strings['Volver']; ?> </a>
			</form>
				
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	