﻿<?php
//Clase : PRODUCTOS_Controller
//Creado el : 2-06-2020
//Creado por: grvidal
//Controla y administra las acciones enviadas por get
//-------------------------------------------------------
 

 session_start();
	if( !isset($_SESSION['login']) ){
		header('Location:../index.php');
	}

	include '../View/PRODUCTOS_SHOWCURRENT_View.php';
	include '../View/PRODUCTOS_SHOWALL_View.php';   
	include '../View/PRODUCTOS_SEARCH_View.php';   
	include '../View/PRODUCTOS_DELETE_View.php';	 
	include '../View/PRODUCTOS_EDIT_View.php';   
	include '../View/PRODUCTOS_ADD_View.php';   
	include_once '../Model/PRODUCTOS_Model.php';
	include '../View/MESSAGE_View.php';
	include_once '../Model/PRODUCTOS_CATEGORIAS_Model.php';
	include_once '../Model/CATEGORIAS_Model.php';
	include_once '../View/noPermiso.php';
	

// la función get_data_form() recoge los valores que vienen del formulario por medio de post y la action a realizar, crea una instancia PRODUCTOS y la devuelve
	function get_data_form(){


		if (!isset($_REQUEST['id'])) $_REQUEST['id'] = null;
		if (!isset($_REQUEST['titulo'])) $_REQUEST['titulo'] = null;
		if (!isset($_REQUEST['descripcion'])) $_REQUEST['descripcion'] = null;
		if (!isset($_REQUEST['foto'])) $_REQUEST['foto'] = null;
		if (!isset($_REQUEST['vendedorDNI'])) $_REQUEST['vendedorDNI'] = null;
		if (!isset($_REQUEST['origen'])) $_REQUEST['origen'] = null;
		if (!isset($_REQUEST['horasUnidades'])) $_REQUEST['horasUnidades'] = null;
		if (!isset($_REQUEST['estado'])) $_REQUEST['estado'] = null;

		return new PRODUCTOS_Model($_REQUEST['id'],$_REQUEST['titulo'],$_REQUEST['descripcion'],
		$_REQUEST['foto'],$_REQUEST['vendedorDNI'],$_REQUEST['origen'],$_REQUEST['horasUnidades'],$_REQUEST['estado']);// se Crea el modelo de Producto

	}

// sino existe la variable action la crea vacia para no tener error de undefined index

	if (!isset($_REQUEST['action'])) $_REQUEST['action'] = '';
	include_once '../Model/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_SESSION['login'],'','','','','','','','','','','','','');//Recuperamos el usuario que esta operando
	

// En funcion del action realizamos las acciones necesarias

		Switch ($_REQUEST['action']){
			case 'ADD':
				
				if (!$_POST){ // se incoca la vista de add de productos
					
					$categorias = new CATEGORIAS_Model('','');
					$categorias = $categorias->SEARCH();//recogemos todas las categorias
					new PRODUCTOS_ADD($categorias);
				}
				else{
					$respuesta = array(); // se crea el array de las salidas
					if(!$usuario->isAdmin()) $_REQUEST['vendedorDNI'] = $usuario->getDNI();// si el usuario no es admin se pone su dni como vendedor
					else if ($_REQUEST['vendedorDNI']== '') $_REQUEST['vendedorDNI'] = $usuario->getDNI();//si el usuario no es admin ya se coloco su dni, si es admin y no especifico dni, se coloca el del suyo
					array_push($respuesta, upload_image() );//si el tag foto esta puesto y es distinto de vacio se sube, y  para subir la foto necesita el vendedorDNI y la descripcion
					
					$PRODUCTOS = get_data_form(); //se recogen los datos del formulario
					$respuestaP = $PRODUCTOS->ADD();// se añade el producto
					array_push($respuesta, $respuestaP );// se crea el array de las salidas
					if($respuestaP == '00002' && isset($_REQUEST['categorias'])){//el producto se ha añadido y hay categorias que asignar
						
						$id = $PRODUCTOS->recoverID();
						foreach ($_REQUEST['categorias'] as $key ) {
					 		$prodCat = new PRODUCTOS_CATEGORIAS_Model($id,$key);
					 		array_push($respuesta, $prodCat->ADD());//se almacena la salida en el array
					 	} 
					}

					new MESSAGE($respuesta, '../Controller/PRODUCTOS_Controller.php');
				}
				break;
			case 'DELETE':
				$producto = new PRODUCTOS_Model($_REQUEST['id'],'','','','','','','');
				if( $usuario->isAdmin() || $usuario->getDNI() == $producto->getVendedorDNI()){
					if (!$_POST){ //nos llega el id a eliminar por get
						$PRODUCTOS = new PRODUCTOS_Model($_REQUEST['id'],'','','','','','','');
						$valores = $PRODUCTOS->RellenaDatos();
						$eliminable = $PRODUCTOS->esEliminable();
						new PRODUCTOS_DELETE($valores,$eliminable); //se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
					}
					else{
						$PRODUCTOS = get_data_form(); // llegan los datos confirmados por post y se eliminan
						$fotoPath = $PRODUCTOS->getFoto();//recuperamos el path de la foto
						$respuestaP = $PRODUCTOS->DELETE();//eliminamos al usuario
						$respuesta = array($respuestaP); // se crea el array de las salidas

						if($respuestaP == '00005'){// si la tupla se ha eliminado eliminamos tambien sus categorias asociadas
							if ($fotoPath != '') {//si existe foto
								@unlink($fotoPath);// si la tupla se ha eliminado correctamente tambien se elimina la foto
							}
							

							$prodCat = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],'');// creamos el producto_categoria
							$prodCat = $prodCat->getCategorias();//recuperamos todas las categorias del producto
							foreach ($prodCat as $key) {// para categoria del producto se hace un DELETE
								$actual = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],$key['ID_CATEGORIA']);//creamos la clase que vamos a eliminar
								array_push($respuesta, $actual->DELETE());//se almacena la salida en el array
							}
						}
						new MESSAGE($respuesta, '../Controller/PRODUCTOS_Controller.php');
					}
				}else new NoPermiso();
				
				break;

			case 'EDIT':
				$producto = new PRODUCTOS_Model($_REQUEST['id'],'','','','','','','');
				if( $usuario->isAdmin() || $usuario->getDNI() == $producto->getVendedorDNI()){
					if (!$_POST){ //nos llega el usuario a editar por get
						$PRODUCTOS = new PRODUCTOS_Model($_REQUEST['id'],'','','','','','',''); // Se crea el objeto PRODUCTO
						$valores = $PRODUCTOS->RellenaDatos(); // obtengo todos los datos de la tupla

						$categorias = new CATEGORIAS_Model('','');// Se crea el objeto CATEGORIAS
						$categorias = $categorias->SEARCH();//recogemos todas las categorias

						$prodCat = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],'');
						$prodCat = $prodCat->getCategorias();//recogemos todas las categorias a las que el producto ya pertenezca

						new PRODUCTOS_EDIT($valores,$categorias,$prodCat); //invoco la vista de edit con los datos precargados
					}
					else{

						$respuesta = array();// se almacena en el array

						if(!$usuario->isAdmin()) $_REQUEST['vendedorDNI'] = $usuario->getDNI();// si el usuario no es admin se pone su dni como vendedor
						else if ($_REQUEST['vendedorDNI']== '') $_REQUEST['vendedorDNI'] = $usuario->getDNI();//si el usuario no es admin ya se coloco su dni, si es admin y no especifico dni, se coloca el del suyo
						if( isset($_FILES['foto']) ) {// si se adjunto alguna foto
							$respuestaI = upload_image();//si el tag foto esta puesto y es distinto de vacio se sube, y  para subir la foto necesita el vendedorDNI y la descripcion
							if (!$respuestaI) array_push($respuesta, $respuestaI);
						}
						$PRODUCTOS = get_data_form(); //recojo los valores del formulario
						array_push($respuesta, $PRODUCTOS->EDIT()); // update en la bd  y guardado en las respuestas
						if($respuestaP= '00007' ){//Si se ha actualizado exitosamente y hay alguna categoria
							
							if(isset($_REQUEST['categorias'])){// si hay alguna categoria seleccionada

								//cogemos las viejas, las comparamos con las nuevas, las que no coinciden se hace delete
								$prodCat = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],'');//creamos el objeto
								$prodCat = $prodCat->getCategorias();//cogemos todas las categorias antiguas

								foreach ($prodCat as $oldCat) {//recorremos todas las categorias antiguas
									$eliminar = true;// en principio se marca para eliminar
									foreach ($_REQUEST['categorias'] as $newCat) {//recorremos las categorias nuevas
										if($oldCat['ID_CATEGORIA'] == $newCat) $eliminar = false;// si la antigua esta entre las nuevas no se marca para eliminar
									}
									if($eliminar == true){//si esta marcada para eliminar se elimina
										$aux = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],$oldCat['ID_CATEGORIA']);//creamos el objeto
										array_push($respuesta, $aux->DELETE()); //se elimina desde el modelo
									}
									
								}

								//cogemos las nuevas, las comparamos con las viejas, las que no coinicden se hace add
								foreach ($_REQUEST['categorias'] as $newCat) {//recorremos las categorias nuevas
									$insertar = true;// en principio se marca para añadir
									foreach ( $prodCat as $oldCat) {//recorremos todas las categorias antiguas
										if($oldCat['ID_CATEGORIA'] == $newCat) $insertar = false;// si la nueva esta entre las antiguas no se marca para añadir
									}
									if($insertar == true){//si esta marcada para añadir se añade
										$aux = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],$newCat);//creamos el objeto
										array_push($respuesta, $aux->ADD()); //se añade desde el modelo
									}
									
								}
							}else{//si no hay ninguna categoria marcada se eliminan todas

								$prodCat = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],'');//creamos el objeto
								$prodCat = $prodCat->getCategorias();//cogemos todas las categorias antiguas

								foreach ($prodCat as $key) {
									$aux = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],$key['ID_CATEGORIA']);//creamos el objeto
									array_push($respuesta, $aux->DELETE()); //se eliminan desde el modelo
								}
							}
						}

						//control de añadir/eliminar las categorias

						new MESSAGE($respuesta, '../Controller/PRODUCTOS_Controller.php');
					}
				}else new NoPermiso();
				break;

			case 'SEARCH':
				if (!$_POST){// si no hay elementos en post se muestra el formulario
					new PRODUCTOS_SEARCH();
				}
				else{ 
					$PRODUCTOS = get_data_form();// se recogen los datos
					$datos = $PRODUCTOS->SEARCH();// se hace la busqueda
					new PRODUCTOS_SHOWALL($datos,$usuario);//se muestra
				}
				break;

			case 'SHOWCURRENT':
				$PRODUCTOS = new PRODUCTOS_Model($_REQUEST['id'],'','','','','','',''); // Se crea el objeto
				$valores = $PRODUCTOS->RellenaDatos();

				$prodCat = new PRODUCTOS_CATEGORIAS_Model($_REQUEST['id'],'');//creamos el objeto
				$prodCat = $prodCat->getCategorias();//cogemos todas las categorias antiguas

				$valoraciones = $PRODUCTOS->getValoraciones();//se recuperan las valoraciones de dicho producto

				new PRODUCTOS_SHOWCURRENT($valores,$prodCat,$valoraciones,$usuario);
				break;

			default:

				$PRODUCTOS = get_data_form();
				$datos = $PRODUCTOS->SHOW_ALL();

				new PRODUCTOS_SHOWALL($datos,$usuario);
		}


		//Sube la foto del producto, devuelve true si todo salio bien, o una cadena si hubo algun error
	function upload_image(){

		$toRet = true;
		$target_dir = "../Files/";
		$target_file = $target_dir . basename($_FILES["foto"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
		//Comprueba que la foto sea una imagen real
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["foto"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        $uploadOk = 0;
		    } 
		}
		// Comprueba el tamaño
		if ($_FILES["foto"]["size"] > 500000) { //500KB si es mayor se guarda el retorno
		    $toRet= "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {//compruegba que la extension sea la adecuada
			if ($toRet) {// si la cadena estaba vacia se sobrepone la salida
				$toRet = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			}else $toRet= $toRet. " 
		Sorry, only JPG, JPEG, PNG & GIF files are allowed.";// si ya hubo algun error la linea se añade
		    $uploadOk = 0;
		}

		if ($uploadOk == 0) {//comprueba que $uploadOk es 0 debido algun error 
			return $toRet;
		}else{

			if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {//comprueba que $uploadOk es 0 debido algun error 
			 $oldname = '../Files/' .basename( $_FILES["foto"]["name"]);
			 $catch = array("\n"," ","\r","\t");//caracteres a remplazar
			 $titulo = str_replace($catch, "_", $_REQUEST['titulo']);//se substituyen los caracteres del titulo y se guardan en $titulo
			 $newname = '../Files/' . $titulo .'_'. $_REQUEST['vendedorDNI'].'.'.$imageFileType;//se le da el nuevo nombre
			rename($oldname, $newname);
			$_REQUEST['foto'] = $newname;
			return "";
			}else return "ERROR DESCONOCIDO";
			
		}

		
	}


?>
