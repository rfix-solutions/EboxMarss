<?php
include '../production/_qry/db_connect_local.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>.: EBOX PLATFORM - LOGIN :. </title>
<!-- For-Mobile-Apps -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="EBOX" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //For-Mobile-Apps -->
<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>
<body>
<div class="container">
	
<!-- <h1>EBOX Platform</h1>-->
	
	<div class="signin">
		<div style="text-align: center;">
			<img src="images/logo_cliente.png" alt="logo">
		</div>
     	<form method="get" action="../production/_qry/check_user.php">
			<input type="hidden" name="dir" value="<?php echo $_GET['url'];?>">
	      	<input name="user" type="text" class="user" />
	      	<input name="password" type="password" class="pass" />
	      	
          	<input type="submit" value="Iniciar Sesion" />
	 	</form>
	</div>
	<div style="text-align: center;">
		<img src="images/logo-ebox-small.png" alt="logo">
	</div>
</div>
<div class="footer">
     <p>&copy; <?php echo date('Y'); ?> EBOX PLATFORM. Derechos reservados | Desarrollado por 
				<a href="https://www.sdgingenieria.cl">SDG Ingeniería</a>
		 <?php echo $url_sitio;?>
	</p>
</div>
</body>
</html>