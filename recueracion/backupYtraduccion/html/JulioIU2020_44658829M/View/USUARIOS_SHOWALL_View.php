<?php
//Clase : USUARIO_SHOWALL_View
//Creado el : 2-10-2019
//Creado por: grvidal
//Muestra la tabla con los usuarios de la base de datos, si es un usuario permite añadir, editar y eliminar a usuarios distintos de uno mismo
//-------------------------------------------------------

class USUARIOS_SHOWALL {

	var $lista;
	var $usuario;

	function __construct($datos,$usuario){
		//session_start();
		$this->usuario = $usuario;
		$this->lista = $datos;
		$this->render();
	}

	function render(){
	  
		?>
		
		<head>
			<title class="TShowAll"></title>
			<link rel="stylesheet" type="text/css" href="../View/css/estilo.css"> 
		</head>

		<?php include '../View/Header.php'; //header necesita los strings ?>

		<h1 class="TShowAll"></h1>

		<?php if ($this->usuario->isAdmin()) { ?>
			<a href = '../Controller/USUARIOS_Controller.php?action=ADD' style="color:#FFFFFF;">
				<img src='../View/icon/adduser.ico'>
			</a>
		<?php } ?>

		
		
		
		<a href = '../Controller/USUARIOS_Controller.php?action=SEARCH'>
			<img src='../View/icon/searchuser.ico'>
		</a>
		<br>
		<div>
		<table border = ¨1¨>
			<th class="Login">
				id
			</th>
		<?php if ($this->usuario->isAdmin()) { ?>
			<th class="DNI">
				DNI
			</th>
		<?php } ?>
			<th class="name">
				nombre
			</th>
			<th class="surname">
				apellido
			</th>
			<th class="email">
				Email
			</th>
		<?php if ($this->usuario->isAdmin()) { ?>
			<th class="tipo_usuario">
				tipo
			</th>
		<?php } ?>
			<?php 
			foreach ($this->lista as $key ) { ?>

				<tr>
					<td>
						<?php echo $key['LOGIN'] ; ?>
					</td>
				<?php if ($this->usuario->isAdmin()) { ?>
					<td>
						<?php  
						echo $key['DNI']; ?>
					</td>
				<?php } ?>
					<td>
						<?php echo $key['NOMBRE'] ; ?>
					</td>
					<td>
						<?php echo $key['APELLIDOS'] ; ?>
					</td>
					<td>
						<?php  
						echo $key['EMAIL']; 
						?>
					</td>
				<?php if ($this->usuario->isAdmin()) { ?>
					<td>
						<?php  
						echo $key['TIPO_USUARIO']; 
						?>
					</td>
				<?php } 
				 if ($this->usuario->isAdmin() || $this->usuario->RellenaDatos()['LOGIN'] == $key['LOGIN']) { ?>
					<td>
						<a href = "../Controller/USUARIOS_Controller.php?action=EDIT&&login=<?php echo $key['LOGIN']; ?>"  > 
							<img src='../View/icon/edituser.ico'>
						</a>
					</td>
				<?php } ?>
					<td>
						<a href = "../Controller/USUARIOS_Controller.php?action=SHOWCURRENT&&login=<?php echo $key['LOGIN']; ?>"  > 
							<img src='../View/icon/showuser.ico'>
						</a>
					</td>
				<?php if ($this->usuario->isAdmin() || $this->usuario->RellenaDatos()['LOGIN'] == $key['LOGIN']) { ?>
					<td>
						<a href = "../Controller/USUARIOS_Controller.php?action=DELETE&&login=<?php echo $key['LOGIN']; ?>"  > 
							<img src='../View/icon/deleteuser.ico'>
						</a>
					</td>
				<?php } ?>
				</tr>
			<?php }		?>
			
		</table>
	</div>
		<br>
		<a href="../../Controller/Index_Controller.php"> <img src="../View/icon/back.ico" height="32" width="32"> </a>
		<br><br>

		<?php
		include '../View/Footer.php';
	}

}

?>