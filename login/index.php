<?php
include '../production/_qry/db_connect_local.php';
if(isset($_GET['url'])){
	$dir = $_GET['url'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> .: eBox Platform :. </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #ffffff;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="get" action="../production/_qry/check_user.php" class="login100-form validate-form">
					<input type="hidden" name="cot" value="<?php echo $_GET['C']?>">
					<input type="hidden" name="dir" value="<?php echo $dir;?>">
					<span class="login100-form-title p-b-43">
						<img src="images/logo_marss.jpg">
					</span>
					<p>Usuario</p>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="user" value="<?php echo $_GET['U']?>">
					</div>



					<p>Contraseña</p>
					<div class="wrap-input100 validate-input" data-validate="La contraseña es necesaria">
						<input class="input100" type="password" name="password" value="<?php echo $_GET['P']?>">
					</div>



					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Ingresar
						</button>
					</div>

					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							EBOX Platform - Powered By <a href="https://www.tecnotrack.cl">Tecnotrack</a>
						</span>
					</div>


				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
