<?php
//Clase : Index_controler
//Creado el : 2-06-2020
//Creado por: grvidal
//Comprueba si el usuario esta autentificado y si es asi lo muestra la vista general
//-------------------------------------------------------

//session
session_start();
//incluir funcion autenticacion
include_once '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php');
}
//esta autenticado
else{
	include_once '../View/users_index_View.php';
	include_once '../Model/PRODUCTOS_Model.php';
	include_once '../Model/INTERCAMBIOS_Model.php';
	include_once '../Model/CATEGORIAS_Model.php';
	include_once '../View/MEJORES_CATEGORIAS_View.php';
	include_once '../View/MEJORES_PRODUCTOS_View.php';
	include_once '../View/MEJORES_INTERCAMBIOS_View.php';

	// sino existe la variable vista la crea vacia para no tener error de undefined index
	if (!isset($_REQUEST['vista'])) $_REQUEST['vista'] = '';

	Switch ($_REQUEST['vista']){//se toma una accion u otra dependiendo de la palabra vista

		case 'RANKING_CATEGORIAS'://se muestra la seccion de ranking por categorias
		  $product = new PRODUCTOS_Model('','','','','','','','');
		  $product = $product->getMejoresCategorias();
			new MEJORES_CATEGORIAS($product);

		break;

		case 'RANKING_PRODUCTOS'://se muestra la seccion de raking por productos
		  $product = new PRODUCTOS_Model('','','','','','','','');
		  $product = $product->getMejoresProductos();
			new MEJORES_PRODUCTOS($product);

		break;

		case 'RANKING_INTERCAMBIOS'://se muestra la seccion de raking por intercambios
		  $product = new INTERCAMBIOS_Model('','','','','','','','');
		  $product = $product->getMejoresIntercambios();
			new MEJORES_INTERCAMBIOS($product);

		break;

		default:
			$product = new PRODUCTOS_Model('','','','','','','','tramite');
			$product = $product->SEARCH();

			$categorias = new CATEGORIAS_Model('','');
			$categorias = $categorias->SEARCH();

			new Index($product,$categorias);
	}

	
}

?>