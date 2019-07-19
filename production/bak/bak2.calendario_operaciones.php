<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} 
else 
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		history.back();
	</script>	
<?php
		exit;
}
include '_qry/db_connect_local.php';

$sql_laboratoristas = mysqli_query($link, "
	SELECT id_laboratorista as ID_LAB, nombre_laboratorista as NOMBRE_LAB
	FROM tbl_laboratorista
	ORDER BY ID_LAB
");

$sql_total_laboratoristas = mysqli_query($link, "SELECT MAX(id_laboratorista) as MAYOR FROM tbl_laboratorista")or die('Consulta laboratorista fallida: '.mysql_error());;

while($result = mysqli_fetch_assoc($sql_total_laboratoristas)){ $total_laboratoristas = $result['MAYOR']; }


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
	<!-- Nuevo Calendario -->
	<link href="../calendario/scheduler.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
    <link href="../vendors/fullcalendar2/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendors/fullcalendar2/dist/fullcalendar.print.css" rel="stylesheet" media="print">

	<!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	  <script type="text/javascript">
	  	function cambiaGrupo(chk) {
			var padreDIV=chk;
			while( padreDIV.nodeType==1 && padreDIV.tagName.toUpperCase()!="DIV" )
				padreDIV=padreDIV.parentNode;
			//ahora que padreDIV es el DIV, cogeremos todos sus checkboxes
			var padreDIVinputs=padreDIV.getElementsByTagName("input");
			for(var i=0; i<padreDIVinputs.length; i++) {
				if( padreDIVinputs[i].getAttribute("type")=="checkbox" )
					padreDIVinputs[i].checked = chk.checked;
			}
		}



</script>
	  <style type="text/css">
	  #calendar {
    	width: 100%;
    	margin: 50px auto;
		  font-size: 11px;
  	}

	  </style>
	  
	
  </head>

  <body class="nav-md footer_fixed">
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
                <h3>Calendario Operaciones</h3>
              </div>
            </div>
			  

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
					<a style="width:150px; text-align: center;" href="Javascript:history.back()" class="btn  btn-xs color bg-green	">Volver</a> 
					<div class="col-md-12 col-sm-12 col-xs-12" id='calendar'></div>
	<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title2" name="title2">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                  </div>
                </div>

              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php
		include 'footer.php';
        ?>
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
	<script src="../vendors/moment/min/moment.min.js"></script>    
	
	
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
	<!-- bootstrap-daterangepicker -->
    
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
			
	<!-- FullCalendar -->
    <script src="../vendors/fullcalendar2/dist/fullcalendar.js"></script>
	<script src="../calendario/scheduler.min.js"></script>
	<script src="../calendario/locale-all.js"></script>
	
	<script>
    
    $('#myDatepicker').datetimepicker({
        format: 'hh:mm A'
    });

	
	function  init_calendar() {		
		$(function() { // document ready
			var initialLocaleCode = 'es';

			
			$('#calendar').fullCalendar({
				schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
				locale: initialLocaleCode,
				defaultView: 'agendaDay',
				defaultDate: '<?php echo date('Y-m-d')?>',
				navLinks: true, // can click day/week names to navigate views
				businessHours: false, // display business hours
				editable: true,
				selectable: true,
				selectHelper: true,
				
				eventLimit: true, // allow "more" link when too many events
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'agendaDay,agendaTwoDay,listDay,month'
				},
				views: {
					agendaDay: {
						buttonText: 'Dia' 
					},
					agendaTwoDay: {
						type: 'agenda',
						duration: { days: 2 },
						groupByResource: true,
						buttonText: '2 Dias' 
					},
					listDay: { 
						buttonText: 'Lista' 
					},
				},

				//resourceLabelText: 'Laboratoristas',
				
				resources: [
					<?php 
					while($result = mysqli_fetch_assoc($sql_laboratoristas)){
						if($result['ID_LAB']<$total_laboratoristas){ $coma = ","; } else { $coma =""; }
						
						echo "{ id: '".$result['ID_LAB']."', title: '".$result['NOMBRE_LAB']."', eventColor: 'green' }".$coma."";
						
					}					
					?>
				],
				events: [
					{ id: '1', resourceId: '<?php echo $total_laboratoristas-5 ?>', start: '2018-04-06', end: '2018-04-08', title: 'event 1' },
					{ id: '2', resourceId: '<?php echo $total_laboratoristas-11; ?>', start: '2018-05-28T09:00:00', end: '2018-05-28T11:00:00', title: 'event 2' },
					{ id: '3', resourceId: '<?php echo $total_laboratoristas-8; ?>', start: '2018-05-28T12:00:00', end: '2018-05-28T13:00:00', title: 'event 3' },
					{ id: '4', resourceId: '<?php echo $total_laboratoristas-4; ?>', start: '2018-05-28T14:30:00', end: '2018-05-28T17:30:00', title: 'event 4' },
					{ id: '5', resourceId: '<?php echo $total_laboratoristas-1; ?>', start: '2018-05-28T18:00:00', end: '2018-05-28T1900:00', title: 'event 5' }
				],
				select: function(start, end, event, view, resource) {
					var f_inicio = start.format('DD/MM/YYYY');
					var h_inicio = start.format('hh:mm');
					var inicio = f_inicio+' a las '+h_inicio;
					
					var f_fin = end.format('DD/MM/YYYY');
					var h_fin = end.format('hh:mm');
					var fin = f_fin+' a las '+h_fin;
					
					var var_inicio = f_inicio+' '+h_inicio;
					var var_fin = f_fin+' '+h_fin;
					
					var lab_id = resource.id;
					
					
					var lab_nombre = resource.title;
					if(confirm('Desea agendar visita en el bloque:\n\nInicio: '+inicio+'\nFin: '+fin+'\nLaboratorista: '+lab_nombre))
						location.href='form_agendamiento.php?ini='+var_inicio+'&fin='+var_fin+'&lab='+lab_id;
					return null;
			  	}

			});

		});
	}

	/*
	
	function  init_calendar() {
					
				if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
				console.log('init_calendar');
					
				var date = new Date(),
					d = date.getDate(),
					m = date.getMonth(),
					y = date.getFullYear(),
					started,
					categoryClass;

				var calendar = $('#calendar').fullCalendar({
				  header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listMonth'
				  },
				  selectable: true,
				  selectHelper: true,
				  select: function(start, end, allDay) {
					$('#fc_create').click();

					started = start;
					ended = end;

					$(".antosubmit").on("click", function() {
					  var title = $("#title").val();
					  if (end) {
						ended = end;
					  }

					  categoryClass = $("#event_type").val();

					  if (title) {
						calendar.fullCalendar('renderEvent', {
							title: title,
							start: started,
							end: end,
							allDay: allDay
						  },
						  true // make the event "stick"
						);
					  }

					  $('#title').val('');

					  calendar.fullCalendar('unselect');

					  $('.antoclose').click();

					  return false;
					});
				  },
				  eventClick: function(calEvent, jsEvent, view) {
					$('#fc_edit').click();
					$('#title2').val(calEvent.title);

					categoryClass = $("#event_type").val();

					$(".antosubmit2").on("click", function() {
					  calEvent.title = $("#title2").val();

					  calendar.fullCalendar('updateEvent', calEvent);
					  $('.antoclose2').click();
					});

					calendar.fullCalendar('unselect');
				  },
				  editable: true,
				  events: [{
					title: 'Hola',
					start: new Date(y, m, 1)
				  }, {
					title: 'Long Event',
					start: new Date(y, m, d - 5),
					end: new Date(y, m, d - 2)
				  }, {
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				  }, {
					title: 'Lunch',
					start: new Date(y, m, d + 14, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				  }, {
					title: 'Birthday Party',
					start: new Date(y, m, d + 1, 19, 0),
					end: new Date(y, m, d + 1, 22, 30),
					allDay: false
				  }, {
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				  }]
				});
				
			};
	*/
</script>

  </body>
</html>
