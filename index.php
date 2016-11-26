<?php
session_start();
require_once ('inc2/funkcje.php');
//logout
if ($_GET[a]=='logout'){
	session_destroy();
	session_start();
}
if ($_SESSION[user]) unset ($_SESSION[user]); //usuniecie sesji SP ITX
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ITX Manifesting Portal</title>
		<link rel="icon" href="img/icon2.ico" type="image/x-icon" />
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/dataTables.bootstrap.css" rel="stylesheet"> <!-- tylko dla sortowania tabel-->
		<?php
		if (!$_SESSION[user_man]) echo '<link href="css/r09.css" rel="stylesheet">';
		?>
		<link rel="stylesheet" href="css/jquery-ui.css">		
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/js.js"></script>
		<script src="js/jquery-ui.js"></script>		
		<script src="js/datepicker-pl.js"></script>
		<script src="js/jquery.dataTables.min.js"></script> <!-- tylko dla sortowania tabel-->
		<script src="js/dataTables.bootstrap.js"></script> <!-- tylko dla sortowania tabel-->		
		<script> <!-- tylko do sortowanych tabel -->
				$(document).ready(function() {
			  $('#sort_table').dataTable();
			});
		</script>		
		<script>
		  $( function() {
			//$("#barcode_input").val('');  
			$( "#button_archiwum" ).click(function() {
				//alert ('KLIKNIęcie');
			  $("#data_od").prop('disabled', false);
			  $("#data_do").prop('disabled', false);
			});		
			$( ".button_raport_form" ).click(function() {
				//alert ('KLIKNIęcie');
			  $("#data_od").prop('disabled', false);
			  $("#data_do").prop('disabled', false);
			});					
		  var dateFormat = "yy-mm-dd",
			  from = $( "#data_od" )
				.datepicker({
				  defaultDate: "-12m",
				  changeMonth: true,
				  numberOfMonths: 1,
				  showWeek: true,
				  maxDate: "+0D",
				  showOn: "button",
				  buttonImage: "img/calendar.gif",
				  buttonImageOnly: true,
				  buttonText: "Wybierz datę",
				  dateFormat: dateFormat
				})
				.on( "change", function() {
				  to.datepicker( "option", "minDate", getDate( this ) );
				}),
			  to = $( "#data_do" ).datepicker({
				defaultDate: "+0d",
				changeMonth: true,
				numberOfMonths: 1,
				showWeek: true,
				maxDate: "+0D",
				showOn: "button",
				buttonImage: "img/calendar.gif",
				buttonImageOnly: true,
				buttonText: "Wybierz datę",
				dateFormat: dateFormat
			  })
			  .on( "change", function() {
				from.datepicker( "option", "maxDate", getDate( this ) );
			  });
		 
			function getDate( element ) {
			  var date;
			  try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			  } catch( error ) {
				date = null;
			  }
		 
			  return date;
			}
		  } );
		  </script>			

	</head>	
	<body>
	<?php 
			if ($_POST['zaloguj']!=''){ //próba logowania
				$res=SQ("SELECT * FROM `user` WHERE `login`='{$_POST[login]}' AND `password`='{$_POST[pass]}' ",0);
				if (mysqli_num_rows($res)>0){
					$row = $res -> fetch_assoc();
					$_SESSION[user_man]=$row;
					$_SESSION['notice']=array('text'=>'Logowanie prawidłowe','typ'=>'success');					
				}else{
					$_SESSION['notice']=array('text'=>'Logowanie nieprawidłowe','typ'=>'danger');					
				}
			}
			require 'inc2/navibar.php'; // NAWIGACJA //?>
		<div class="container">
			<div class="row">
				<label for="nav-switch" class="visuallyhidden">Menu podręczne</label>
				<input type="checkbox" id="nav-switch" class="nav-switch visible-xs-block">
				<div class="col-xs-12"><!-- ŚRODEK -->
				<?php
					if ($_SESSION[notice]) require ('inc2/notice_bar.php');
					require ('inc2/srodek.php');
				?>
				</div>
			</div>
			<div class="row footer"> <!-- FOOTER -->
				<?php require 'inc2/footer.php';?>
			</div>
		</div>
	</body>
</html>
<?php
if ($_SESSION[user_man][login]=='mkolak2') {
	tab($_SESSION,'SESSION');
	tab($_POST,'POST');
	tab($_GET,'GET');
}
?>
