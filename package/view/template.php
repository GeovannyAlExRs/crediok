<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY?></title>

	<link rel="icon" type="image/x-icon" href="./package/view/assets/icons/dtk.ico">

    <?php include "./package/view/template/script/link.php"; ?>
</head>
<body>

	<?php 
		$peticionAjax = false;
		require_once "./package/controller/viewController.php";
		$iv = new viewController();
		$view = $iv->getViewController();
		if($view == "login" || $view == "404") {
			require_once "./package/view/template/".$view."-view.php";
		} else { ?> <!-- // ABRE LLAVE (PARA MOSTRAR) -->
		
			<!-- Main container -->
			<main class="full-box main-container">

				<!-- Nav lateral -->
				<?php include "./package/view/template/nav-lateral.php"; ?>

				<!-- Page content -->
				<section class="full-box page-content">
					<?php 
						include "./package/view/template/navbar.php"; 
						include $view;
					?>
				</section>
			</main>
			
		<?php }?> <!-- // CIERRA LLAVE (PARA MOSTRAR) -->
	
	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<?php include "./package/view/template/script/script.php"; ?>
</body>

</html>