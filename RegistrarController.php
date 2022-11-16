<?php
	
	namespace DankiCode\Controllers;

	class RegistrarController{


		public function index(){

			if(isset($_POST['registrar'])){
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];

				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					\DankiCode\Utilidades::alerta('E-mail Inválido.');
					\DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else if(strlen($senha) < 6){
					\DankiCode\Utilidades::alerta('Sua senha é muito curta.');
					\DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else if(\DankiCode\Models\UsuariosModel::emailExists($email)){
					\DankiCode\Utilidades::alerta('Este e-mail já existe no banco de dados!');
					\DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else{
					//Registrar usuário.
					$senha = \DankiCode\Bcrypt::hash($senha);
					$registro = \DankiCode\MySql::connect()->prepare("INSERT INTO usuarios VALUES (null,?,?,?,'')");
					$registro->execute(array($nome,$email,$senha));

					\DankiCode\Utilidades::alerta('Registrado com sucesso!');
					\DankiCode\Utilidades::redirect(INCLUDE_PATH);
				}


			}
			
			\DankiCode\Views\MainView::render('registrar');
			

		}

	}

?>