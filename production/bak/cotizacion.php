<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Tecnotrack ERP</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#l" class="site_title"><p style="text-align:center;">Tecnotrack ERP</p></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
			<?php
			/*
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->
			*/
			?>
            <br />

            <!-- sidebar menu -->
          <?php
		  include 'menu_sidebar.php';
		  ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php
			include 'menu_footer.php';
			?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		<?php
       include 'menu_top.php';
        ?>
		<!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Cotizacion</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar por...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Ir</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cotización N°: </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                                    
                    <br />
                    <form class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rut Cliente</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Escriba....">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Razón Social</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Escriba....">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contacto</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Escriba....">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Escriba....">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fono</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Escriba....">
                        </div>
                      </div>
					  
                      
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <textarea class="form-control" rows="3" placeholder="Escriba..."></textarea>
                        </div>
                      </div>
					  
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Condiciones comerciales</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option>100% al contado</option>
                            <option>50% al inicio y 50% contra entrega</option>
                            <option>pago a 30 días</option>
                            <option>pago a 60 días</option>
                            <option>Condiciones especiales</option>
                          </select>
                        </div>
                      </div>

                    <table class="table table-bordered" >
                      <thead>
                        <tr >
                          <th>#</th>
                          <th>Descripción</th>
                          <th>Cantidad</th>
                          <th>Valor Unit</th>
						  <th>Valor Total</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  for($i=1;$i<=10;$i++){
					  ?>
                        <tr>
							<td style="width:30px;"><?php echo $i;?></td>
							<td style="width:auto;">
								<input type="text" style="width:100%;">
							</td>
							<td style="width:80px;">
								<input type="text" style="width:60px;">
							</td>
							
							<td style="width:100px;">
								<input type="text" style="width:90px;" >
							</td>
							<td style="width:100px; text-align: right; padding: 15px 10px 0px 0px;">
							$ 100.000.000
							</td>
                        </tr>
					<?php
					 }
					 ?>
                    </tbody>
					<tr>
						  <td colspan="4" style="text-align: right; padding: 10px 10px 10px 0px;">
							Total Neto
						  </td>
						  <td style="text-align: right; padding: 10px 10px 10px 0px;">
							$100.000.000
						  </td>
					  </tr>
                    </table>

               


				<div class="form-group">
					<label class="control-label col-md-12 col-sm-3 col-xs-12"></label>
					<div class="col-md-12 col-sm-9 col-xs-12">
						<div class="">
							<label>
								<input type="checkbox" class="js-switch" /> He leido y validado todos los datos ingresados
							</label>
						</div>
					</div>
				</div>
				<div class="ln_solid"></div>
				<div class="form-group" style="text-align: center;">
					<button type="button" class="btn btn-primary">Cancel</button>
					<button type="reset" class="btn btn-primary">Reset</button>
					<button type="submit" class="btn btn-success">Submit</button>
					
				</div>
                   </form>
                  












                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
