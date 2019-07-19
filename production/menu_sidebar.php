<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>General</h3>

		<ul class="nav side-menu">
			<li><a href="dashboard_workflow.php"><i class="fa fa-desktop"></i> Workflow </a></li>
<?php
if($_SESSION['type']=='CL'){?>
		</ul>
	</div>
</div>
<?php
}
else{?>
	<li><a href="dashboard_comercial.php"><i class="fa fa-pencil-square-o"></i> Comercial</a></li>
	<li>
		<a><i class="fa fa-pencil-square-o"></i> Operaciones <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
			<li><a href="operaciones_calendario.php">Agendamiento</a></li>
			<li><a href="operaciones_ingreso_formulario.php">Ingreso formularios</a></li>
		</ul>
	</li>
	<li>
		<a><i class="fa fa-pencil-square-o"></i> Laboratorio <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
			<li><a>Sala<span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="laboratorio_sala_suelos.php">Suelos</a></li>
					<li><a href="laboratorio_sala_hormigon.php">Hormigón</a></li>
					<li><a href="laboratorio_sala_elementos.php">Elementos</a></li>
					<li><a href="laboratorio_sala_asfalto.php">Asfalto</a></li>
					<!-- <li><a href="laboratorio_sala_dosificacion.php">Dosificación</a></li>-->
					<li><a href="laboratorio_sala_aridos.php">Aridos</a></li>
					<li><a href="laboratorio_sala_aguas.php">Aguas</a></li>
				</ul>
			</li>
			<li><a href="laboratorio_oficina_tecnica.php">Oficina T&eacute;cnica</a></li>
			<li><a>Informes<span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="laboratorio_informes.php">Ver informes</a></li>
					<li><a href="laboratorio_informes_firmar.php">Firmar informes</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li>
		<a><i class="fa fa-pencil-square-o"></i> Finanzas <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
			<li><a href="finanzas_prefacturacion.php">Pre Facturaci&oacute;n</a></li>
			<li><a href="finanzas_facturacion.php">Facturación</a></li>
		</ul>
	</li>

	<li>
		<a><i class="fa fa-pencil-square-o"></i> Configuraci&oacute;n <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
			<li><a href="mant_clientes.php">Clientes</a></li>
			<li><a href="mant_usuarios.php">Usuarios</a></li>
			<li><a href="mant_notificaciones.php">Notificaciones</a></li>
			<li><a href="mant_laboratoristas.php">Laboratoristas</a></li>
			<li><a href="mant_servicios.php">Ensayos</a></li>
			<li><a href="mant_normas.php">Normas</a></li>
			<li><a href="mant_correlativos.php">Correlativos</a></li>
			<li><a href="#">Documentaci&oacute;n</a></li>
		</ul>
	</li>
</ul>
</div>
</div>
<?php
}
?>
