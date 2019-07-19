<html> 
<head> 
	    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
   <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<style type="text/css">
		body{
			background-color: aliceblue;
		}
	</style>
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
</head> 

<body> 

<br>
<br>

	
<form method="get">
<div>
<table class="table table-striped jambo_table">
	<thead>
	<tr class="headings">
		<th>
			<input type="checkbox" onchange="cambiaGrupo(this)" class="icheckbox_flat-green">
		</th>
		<th class="column-title">Invoice </th>
		<th class="column-title">Invoice Date </th>
		<th class="column-title">Order </th>
		<th class="column-title">Bill to Name </th>
		<th class="column-title">Status </th>
		<th class="column-title">Amount </th>
		<th class="column-title no-link last">
			<span class="nobr">Action</span>
		</th>
    </tr>
	</thead>
	<tbody>
    	<tr class="even pointer">
        	<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
            <td class=" ">121000040</td>
            <td class=" ">May 23, 2014 11:47:56 PM </td>
            <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i></td>
            <td class=" ">John Blank L</td>
            <td class=" ">Paid</td>
            <td class="a-right a-right ">$7.45</td>
            <td class=" last"><a href="#">View</a></td>
		</tr>
		<tr class="odd pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000039</td>
			<td class=" ">May 23, 2014 11:30:12 PM</td>
			<td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
			</td>
			<td class=" ">John Blank L</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$741.20</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		<tr class="even pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000038</td>
			<td class=" ">May 24, 2014 10:55:33 PM</td>
			<td class=" ">121000203 <i class="success fa fa-long-arrow-up"></i>
			</td>
			<td class=" ">Mike Smith</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$432.26</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		<tr class="odd pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000037</td>
			<td class=" ">May 24, 2014 10:52:44 PM</td>
			<td class=" ">121000204</td>
			<td class=" ">Mike Smith</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$333.21</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		<tr class="even pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000040</td>
			<td class=" ">May 24, 2014 11:47:56 PM </td>
			<td class=" ">121000210</td>
			<td class=" ">John Blank L</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$7.45</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		<tr class="odd pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000039</td>
			<td class=" ">May 26, 2014 11:30:12 PM</td>
			<td class=" ">121000208 <i class="error fa fa-long-arrow-down"></i>
			</td>
			<td class=" ">John Blank L</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$741.20</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		</tbody>
	</table>
</div>
<br>
<br>
<br>
<br>
	<div>
<table class="table table-striped jambo_table">
	<thead>
	<tr class="headings">
		<th>
			<input type="checkbox" onchange="cambiaGrupo(this)" class="icheckbox_flat-green">
		</th>
		<th class="column-title">Invoice </th>
		<th class="column-title">Invoice Date </th>
		<th class="column-title">Order </th>
		<th class="column-title">Bill to Name </th>
		<th class="column-title">Status </th>
		<th class="column-title">Amount </th>
		<th class="column-title no-link last">
			<span class="nobr">Action</span>
		</th>
    </tr>
	</thead>
	<tbody>
    	<tr class="even pointer">
        	<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
            <td class=" ">121000040</td>
            <td class=" ">May 23, 2014 11:47:56 PM </td>
            <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i></td>
            <td class=" ">John Blank L</td>
            <td class=" ">Paid</td>
            <td class="a-right a-right ">$7.45</td>
            <td class=" last"><a href="#">View</a></td>
		</tr>
		<tr class="odd pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000039</td>
			<td class=" ">May 23, 2014 11:30:12 PM</td>
			<td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
			</td>
			<td class=" ">John Blank L</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$741.20</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		<tr class="even pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000038</td>
			<td class=" ">May 24, 2014 10:55:33 PM</td>
			<td class=" ">121000203 <i class="success fa fa-long-arrow-up"></i>
			</td>
			<td class=" ">Mike Smith</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$432.26</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		<tr class="odd pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000037</td>
			<td class=" ">May 24, 2014 10:52:44 PM</td>
			<td class=" ">121000204</td>
			<td class=" ">Mike Smith</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$333.21</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		<tr class="even pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000040</td>
			<td class=" ">May 24, 2014 11:47:56 PM </td>
			<td class=" ">121000210</td>
			<td class=" ">John Blank L</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$7.45</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		<tr class="odd pointer">
			<td class="a-center ">
            	<input type="checkbox" class="icheckbox_flat-green" name="servicio[]">
			</td>
			<td class=" ">121000039</td>
			<td class=" ">May 26, 2014 11:30:12 PM</td>
			<td class=" ">121000208 <i class="error fa fa-long-arrow-down"></i>
			</td>
			<td class=" ">John Blank L</td>
			<td class=" ">Paid</td>
			<td class="a-right a-right ">$741.20</td>
			<td class=" last"><a href="#">View</a>
			</td>
		</tr>
		</tbody>
	</table>
</div>
<br>
<br>
<br>
<br>
	<input type="submit" value="enviar">
	</form>	

	
	
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

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
</body> 
</html>  