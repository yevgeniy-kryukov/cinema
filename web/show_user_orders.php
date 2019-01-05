<?php
require_once "../autoloader.php";

use cinema\model\TicketOrder;
use cinema\util\{DataBase, Main};

$userID = Main::sessionGet("userID");
$userEmail = Main::sessionGet("userEmail");

$resultShowUserOrders = TicketOrder::showUserOrders($userID);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cinema Show User Orders</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cinema">
    <meta name="author" content="Yevgeniy Kryukov">
    <link rel="icon" href="img/cinema.ico">

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h3>Show user orders <?php echo $userEmail; ?></h3>
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Order date</th>
				<th scope="col">Total order amount</th>
				<th scope="col">Order completed</th>
				<th scope="col">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
			for($ii = 0; $ii < count($resultShowUserOrders); $ii++): 
				$rowShowUserOrders = $resultShowUserOrders[$ii];
			?>
			<tr>
				<td scope="row"><?php echo $ii + 1; ?></td>
				<td><?php echo $rowShowUserOrders["order_date"]; ?></td>
				<td><?php echo $rowShowUserOrders["total"]; ?></td>
				<td><?php echo $rowShowUserOrders["complete"]; ?></td>
				<td align="center">
					<a class="btn btn-primary" href="order.php?orderID=<?php echo $rowShowUserOrders["id"]; ?>" role="button">Go to order</a>
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