<!DOCTYPE html>
<html>
<head>
	<!--ALTERAR TITULO-->
	<title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">


</head>

<body>

	<section class="main-feed">
		<?php 
			include('includes/sidebar.php'); 
		?>
		<div class="feed">
			<div class="feed-wraper">
			<div class="feed-form">
				<form method="post">
					<textarea required="" name="post_content" placeholder="No que você está pensando?"></textarea>
					<input type="hidden" name="post_feed">
					<input type="submit" name="acao" value="Postar!">
				</form>
			</div><!--feed-form-->

		<?php
			$retrievePosts = \DankiCode\Models\HomeModel::retrieveFriendsPosts();

			foreach ($retrievePosts as $key => $value) {
			

		?>
			
		<div class="feed-single-post">
				<div class="feed-single-post-author">
					<div class="img-single-post-author">
						<?php
							if(!isset($value['me']) && $value['img'] == ''){
						?>
						<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<?php }else if(!isset($value['me'])){ ?>
						<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value['img'] ?>" />
					<?php } ?>

					<?php
						if(isset($value['me']) && $_SESSION['img'] == ''){
						?>
						<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<?php }else if(isset($value['me'])){ ?>
						<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img'] ?>" />
					<?php } ?>

					</div>
					<div class="feed-single-post-author-info">
						<?php if(isset($value['me'])){ ?>
							<h3><?php echo $_SESSION['nome']; ?> (eu)</h3>
						<?php }else{ ?>

							<h3><?php echo $value['usuario'] ?></h3>

						<?php } ?>
						<p><?php echo date('d/m/Y H:i:s',strtotime($value['data'])) ?></p>
					</div>
				</div>
				<div class="feed-single-post-content">
					<?php echo $value['conteudo'] ?>
				</div>
			</div>

		<?php } ?>

			


		</div>

			<div class="friends-request-feed">
				<h4>Solicitações de amizade</h4>

				<?php

					foreach(\DankiCode\Models\UsuariosModel::listarAmizadesPendentes() as $key=>$value){
					$usuarioInfo = \DankiCode\Models\UsuariosModel::getUsuarioById($value['enviou']);
				?>
				<div class="friend-request-single">
					<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<div class="friend-request-single-info">
						<h3><?php echo $usuarioInfo['nome'] ?></h3>
						<p><a href="<?php echo INCLUDE_PATH ?>?aceitarAmizade=<?php echo $usuarioInfo['id'] ?>">Aceitar</a> | <a href="<?php echo INCLUDE_PATH ?>?recusarAmizade=<?php echo $usuarioInfo['id'] ?>">Recusar</a></p>
					</div>
				</div>

				<?php } ?>
			</div>
		</div><!--feed-->
	</section>


</body>


</html>