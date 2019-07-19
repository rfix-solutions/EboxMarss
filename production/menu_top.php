<?php
if($_SESSION['type']=='LM'){
	$QRY = "
	SELECT nombre_usuario AS USUARIO, UsuarioAvatar AS AVATAR FROM TBL_Usuario WHERE id_usuario = '".$_SESSION['id_user']."'
	";
}
else{
	$QRY = "
	SELECT ClienteUsuarios_Nombre AS USUARIO, 'user.png' AS AVATAR FROM TBL_ClienteUsuarios WHERE ClienteUsuarios_Id = '".$_SESSION['id_user']."'
	";
}

$QRY_USER = mysqli_query($link, $QRY) or die ("Error en SQL User:" . mysqli_error());;
while($ROW = mysqli_fetch_assoc($QRY_USER)){
	$USERNAME = ucwords($ROW['USUARIO']);
	$USERAVATAR = $ROW['AVATAR'];
}

?>

<div class="top_nav">
	<div class="nav_menu">
  	<nav>
    	<div class="nav toggle">
      	<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
      	<li class="">
        	<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="images/profile/<?php echo $USERAVATAR;?>" alt="avatar" /><?php echo $USERNAME;?>
            <span class=" fa fa-angle-down"></span>
					</a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
						<?php
						if($_SESSION['type']=='LM'){?>
							<li><a href="perfil.php?id=<?php echo $_SESSION['id_user'];?>&O=1"> Perfil</a></li>
						<?php
						}
						?>
            <li><a href="_qry/sesion.php"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
