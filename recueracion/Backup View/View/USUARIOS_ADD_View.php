<?php
//Clase : USUARIO_ADD_View
//Creado el : 2-10-2019
//Creado por: grvidal
//Muestra unos campos para ser rellenados y los manda por post al controlador
//-------------------------------------------------------

	class USUARIOS_ADD{


		function __construct(){	
			//session_start();
			$this->render();
		}

		function render(){
		?>
		<head>
			<link rel="stylesheet" type="text/css" href="../View/css/estilo.css"> 
			<title class="Tadd"> <?php echo $strings['Tadd']; ?></title>
		</head>
		
		<?php include '../View/Header.php'; //header necesita los strings ?>
			<h1 class="addUser">Añadir usuario</h1>	
			<form name = 'Form' action='../Controller/USUARIOS_Controller.php?action=ADD' method='post' onsubmit="return comprobarUsuarios(this);" enctype="multipart/form-data">
				 	
				<div class="form-group">
				 	<label for="login" class="Login">Login </label>  
				 	<input class="form-control" type = 'text' name = 'login' id = 'login' placeholder = 'Utiliza tu login' size = '10' onblur="comprobarAlfabetico(this,15);" required>
				 	<label class="errormsg letrasynumeros" for="login" id="login_error" > <?php echo $strings['letrasynumeros'] ?> </label>
				 	<label class="errormsg tooShortNoNum" for="login" id="login_errorLength" > <?php echo $strings['tooShortNoNum'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="password" class="password"><?php echo $strings['password'] ?> </label> 
				 	<input class="form-control" type = 'password' name = 'password' id = 'password' placeholder = 'letras y numeros' size = '15' value = '' onblur="comprobarAlfabetico(this,128)" required >
				 	<label class="errormsg letrasynumeros" for="password" id="password_error" > <?php echo $strings['letrasynumeros'] ?> </label>
				 	<label class="errormsg tooShortNoNum" for="password" id="password_errorLength" > <?php echo $strings['tooShortNoNum'] ?> </label>
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
				 	<label class="errormsg tooShortNoNum" for="nombre" id="nombre_errorLength" > <?php echo $strings['tooShortNoNum'] ?> </label>
				</div>&nbsp;&nbsp; 
 
 				<div class="form-group">
				 	<label for="apellidos" class="surname"><?php echo $strings['surname'] ?>  </label>
				 	<input class="form-control" type = 'text' name = 'apellidos' id = 'apellidos' placeholder = 'Solo letras' size = '50' value = '' onblur="comprobarTexto(this,50)" required >
				 	<label class="errormsg textonly" for="apellidos" id="apellidos_error" > <?php echo $strings['textonly'] ?> </label>
				 	<label class="errormsg tooShortNoNum" for="apellidos" id="apellidos_errorLength" > <?php echo $strings['tooShortNoNum'] ?> </label>
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
				 	<label for="fechaNacimiento" class="bDate"><?php echo $strings['bDate'] ?>  </label>
				 	<input class="form-control" type = 'date' name = 'fechaNacimiento' id = 'fechaNacimiento' onblur="comprobarFechaNacimiento(this);" onkeydown=" return false" required>
				 	<label class="errormsg fechaNacimientoError" for="fechaNacimiento" id="fechaNacimiento_error" > <?php echo $strings['fechaNacimientoError'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="alergias" class="alergias"> <?php echo $strings['alergias']; ?>  </label>
				 	<input class="form-control" type = 'text' name = 'alergias' id = 'alergias' placeholder = 'Letras y numeros' size = '50' value = '' onblur="comprobarAlfabeticoVacio(this,50)" >
				 	<label class="errormsg letrasynumeros" for="alergias" id="alergias_error" > <?php echo $strings['letrasynumeros']; ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="direccion" class="direccion"><?php echo $strings['direccion']; ?>  </label>
				 	<input class="form-control" type = 'text' name = 'direccion' id = 'direccion' placeholder = 'Letras y numeros' size = '50' value = '' onblur="comprobarAlfabeticoVacio(this,250)" >
				 	<label class="errormsg letrasynumeros" for="direccion" id="direccion_error" > <?php echo $strings['letrasynumeros']; ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="cp" class="cp"><?php echo $strings['cp']; ?>  </label>
				 	<input class="form-control" type = 'text' name = 'cp' id = 'cp' placeholder = 'codigo postal' size = '5' value = '' onblur="comprobarCP(this)" >
				 	<label class="errormsg errorCP" for="cp" id="cp_error" > <?php echo $strings['errorCP']; ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="sexo" class="sexo"><?php echo $strings['sexo'] ?>  </label>
				 	<select name="sexo" required>
    						<option class="male" value="hombre"> <?php echo $strings['male'] ; ?></option>
    						<option class="female" value="mujer"> <?php echo $strings['female'] ; ?></option>
					</select>

				 	<label class="errormsg sexoError" for="sexo" id="sexo_error" > <?php echo $strings['sexoError'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="tipo_usuario" class="tipo_usuario"><?php echo $strings['tipo_usuario']; ?></label>
				 	<select name="tipo_usuario" required>
    						<option value="admin" class="admin">Administrador</option>
    						<option value="usuario" class="usuario"> Usuario</option>
					</select>

				 	<label class="errormsg tipo_usuarioError" for="tipo_usuario" id="tipo_usuario_error" > <?php echo $strings['tipo_usuarioError'] ?> </label>
				</div>&nbsp;&nbsp;

				<div class="form-group">
				 	<label for="activado" class="activado"><?php echo $strings['activado']; ?></label>
				 	<select name="activado" id="activado" required>
    						<option value="activado" class="activado"> Activado</option>
    						<option value="desactivado" class="desactivado"> Desctivado </option>
					</select>

				 	<label class="errormsg activadoError" for="activado" id="activado_error" > <?php echo $strings['activadoError'] ?> </label>
				</div>&nbsp;&nbsp;

				<button type="submit" name='action' class="btn btn-primary submit" value="ADD" >
					<?php echo $strings['submit'] ; ?>
				</button>

			</form>

			
			<a href='../Controller/USUARIOS_Controller.php'><img src="../View/icon/back.ico" height="32" width="32"> </a>
			<br><br>
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>