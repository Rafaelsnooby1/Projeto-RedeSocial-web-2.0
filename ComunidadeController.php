<?php
	
	namespace DankiCode\Controllers;

	class ComunidadeController{


		public function index(){
			if(isset($_SESSION['login'])){

				if(isset($_GET['solicitarAmizade'])){
					$idPara = (int) $_GET['solicitarAmizade'];
					if(\DankiCode\Models\UsuariosModel::solicitarAmizade($idPara)){
						\DankiCode\Utilidades::alerta('Amizade solicitada com sucesso!');
						\DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}else{
						\DankiCode\Utilidades::alerta('Ocorreu um erro ao solicitar a amizade...');
						\DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}
				}

			\DankiCode\Views\MainView::render('comunidade');
			}else{
				\DankiCode\Utilidades::redirect(INCLUDE_PATH);
			}
			
		}

	}

?>