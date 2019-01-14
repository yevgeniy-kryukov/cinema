<?php
require_once "../autoloader.php";

use cinema\model\{Film, Show};
use cinema\util\{DataBase, Main};

$link = DataBase::dbConnect();
$filmID = Main::requestGet("filmID");
$titleFilm = "";

$titleFilm = Film::titleFilm($filmID, $link);
$resultShow = Show::showTimes($filmID, $link); 

pg_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cinema Show Times</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cinema">
    <meta name="author" content="Yevgeniy Kryukov">
    <link rel="icon" href="img/cinema.ico">

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h3>Today's Show Times for <?php echo $titleFilm; ?></h3>
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Time</th>
				<th scope="col">Theater</th>
				<th scope="col">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
			for($ii = 0; $ii < count($resultShow); $ii++): 
				$rowShow = $resultShow[$ii];
			?>
			<tr>
				<td scope="row"><?php echo $ii + 1; ?></td>
				<td><?php echo $rowShow["starttime_disp"]; ?></td>
				<td><?php echo $rowShow["theatername"]; ?></td>
				<td align="center">
					<a href="ticket_to_order.php?showID=<?php echo $rowShow["id"]; ?>">
						<img src="img/tickets.gif" width="130" height="39" border="0" alt="Click to book tickets for this show">
					</a>
				</td>
			</tr>
			<?php 
			endfor 
			?>
		</tbody>
	</table>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/myAjax.js"></script>

</body>
</html>