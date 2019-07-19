<?php
if(!isset($_SESSION))
{
		session_start();
}
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		location.href="../login/index.php?url=<?php echo $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>";
	</script>
<?php
		exit;
}
include '_qry/db_connect_local.php';

https://firma.hotelrioserrano.cl/mars/

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>.: EBOX PLATFORM :. </title>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  	<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  </head>
	<body class="nav-md">
		<div class="container body">
    	<div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title">
				  			<p style="text-align:center;">
									<img src="images/logo_marss.png" />
				  			</p>
				 			</a>
            </div>
            <div class="clearfix"></div>
						<?php
					  include 'menu_sidebar.php';
						include 'menu_footer.php';
						?>
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
              	<h3>Informes</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

										<div style="padding-top:56.25%;background-color: white;">
										  <iframe src="https://firma.hotelrioserrano.cl/mars/" frameborder="0" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
										</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
				include 'footer.php';
        ?>
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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
		<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
   	<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
		<!-- Custom Theme Scripts -->
   	<script src="../build/js/custom.min.js"></script>
		<script>

		$('#informes').DataTable( {
		"bordered": true,
		"ordering": false,
		"responsive": false,
		 initComplete: function () {
				 this.api().columns().every( function () {
						 var column = this;
						 var select = $('<select><option value=""></option></select>')
								 .appendTo( $(column.header()).empty() )
								 .on( 'change', function () {
										 var val = $.fn.dataTable.util.escapeRegex(
												 $(this).val()
										 );

										 column
												 .search( val ? '^'+val+'$' : '', true, false )
												 .draw();
								 } );

						 column.data().unique().sort().each( function ( d, j ) {
								 //select.append( '<option value="'+d+'">'+d+'</option>' )
								 select.append( "<option value='"+d+"'>"+d+"</option>" )
						 } );
				 } );
		 }
		} );


		$('iframe').load(function(){$(this).height($(this).contents().outerHeight());});
		</script>
	</body>
</html>
