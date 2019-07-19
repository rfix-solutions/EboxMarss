<?php 

include '_qry/db_connect_local.php';// necesario? pienso que si...

$id_cotizacion = $_GET['id'];

$empresa_solicitante = $_GET['empresa_solicitante'];
$fecha_aceptacion = $_GET['fecha_aceptacion']; /*date("Y-m-d H:i:s");*/
$nombre_solicitante = $_GET['nombre_solicitante'];
$email_solicitante = $_GET['email_solicitante'];
$empresa_constructora = $_GET['empresa_constructora'];
$nombre_obra = $_GET['nombre_obra'];
$codigo_obra = $_GET['codigo_obra'];
$direccion_obra = $_GET['direccion_obra'];
$comuna_obra = $_GET['comuna_obra'];
$fono_obra = $_GET['fono_obra'];
$encargado_terreno = $_GET['encargado_terreno'];
$email_encargado = $_GET['email_encargado'];
$telefono_encargado = $_GET['telefono_encargado'];
$entidad_fiscal = $_GET['entidad_fiscal'];
$empresa_encargada = $_GET['empresa_encargada'];
$profecional_acargo = $_GET['profecional_acargo'];
$razon_social = $_GET['razon_social'];
$rut_empresa_factura = $_GET['rut_empresa_factura'];
$giro_empresa = $_GET['giro_empresa '];
$direccion_factura =$_GET['direccion_factura'];
$nombre_ciudad = $_GET['nombre_ciudad'];
$periodo_facturacion = $_GET['periodo_facturacion'];
$forma_pago = $_GET['forma_pago'];
$telefono_facturacion =$_GET['telefono_facturacion'];
$email_facturacion =$_GET['email_facturacion'];
$nombre_aceptante =$_GET['nombre_aceptante'];
$id_cotizacion_insert = $id_cotizacion;


$insert_tbl_form_acep = mysqli_query ($link,"
INSERT INTO `tbl_form_aceptacion`(`empresa_solicitante`, `fecha_aceptacion`,`nombre_solicitante`, `email_solicitante`,
            `empresa_constructora`, `nombre_obra`, `codigo_obra`, `direccion_obra`, `comuna_obra`,`fono_obra`, `encargado_terreno`,
            `email_encargado`, `telefono_encargado`, `id_entidad_fiscal`,`empresa_encargada`, `profecional_acargo`,`razon_social`, 
            `rut_empresa_factura`, `giro_empresa`,`direccion_factura`, `nombre_ciudad`, `id_periodo_facturacion`, `id_forma_pago`,
            `telefono_facturacion`, `email_facturacion`, `nombre_aceptante`, `id_cotizacion`)
		  VALUES ('".$empresa_solicitante."','".$fecha_aceptacion."','".$nombre_solicitante."','".$email_solicitante."',
			      '".$empresa_constructora."','".$nombre_obra."','".$codigo_obra."','".$direccion_obra."',
			 	  '".$comuna_obra."','".$fono_obra."','".$fono_obra."','".$encargado_terreno."','".$email_encargado."',
				  '".$telefono_encargado."','".$entidad_fiscal."','".$empresa_encargada."','".$profecional_acargo."',
				  '".$razon_social."','".$rut_empresa_factura."','".$giro_empresa."',
				  '".$direccion_factura."','".$nombre_ciudad."','".$periodo_facturacion."','".$forma_pago."','".$telefono_facturacion."',
				  '".$email_facturacion."','".$nombre_aceptante."','".$id_cotizacion_insert."')")
     or die('Consulta fallida: '.mysql_error());;
     
  
     

$update_tbl_cotizacion = mysqli_query($link,("
UPDATE 'tbl_cotizacion' 
SET 'id_estado_envio' = '3' 
WHERE 'id_cotizacion' = $id_cotizacion "))
    or die('Consulta fallida: '.mysql_error());;
/*<!-- cambia el estado a aceptada -->*/


/*$update_something_else?*/
         
                              
?>