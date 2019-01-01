<?php 
require_once "../autoloader.php";

use cinema\model\{TicketOrder, TicketItem};
use cinema\util\{DataBase, Main};

$orderID = Main::sessionGet("orderID");

$link = DataBase::dbConnect();

$resultTicketOrder = TicketOrder::showTicketOrder($orderID, $link);
$totalCharge = $resultTicketOrder["total"];

$resultTicketItem = TicketItem::showItems($orderID, $link);

pg_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cinema Order</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cinema">
    <meta name="author" content="Yevgeniy Kryukov">
    <link rel="icon" href="img/cinema.ico">
	<script language="JavaScript">
		function changeQuantity(pitemid, ptickettype, pnewquantity) 
		{
			var res = serv('order_fn_ajax.php', { fn : 'changeQuantity', pitemid : pitemid, ptickettype : ptickettype, pnewquantity : pnewquantity });
			if (res >= 0) document.orderTickets.totalCharge.value = res;
			else alert("Error " + res);
		}
		function removeFromOrder(pitemid) 
		{
			if (!confirm("Do you really want to remove from the order?")) return;
			var res = serv('order_fn_ajax.php', { fn : 'removeItem', pitemid : pitemid });
			if (res >= 0) $( "#orderItem" + pitemid ).remove();
			else alert("Error " + res);
		}
	</script>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<img src="img/your_ticket_order.gif" width="248" height="65">
	<br>
	<form name="orderTickets">
		<?php for($ii = 0; $ii < count($resultTicketItem); $ii++): 
				$rowTicketItem = $resultTicketItem[$ii];
			?>
			<div id="orderItem<?php echo $rowTicketItem["id"]; ?>">
				For the <?php echo $rowTicketItem["starttime_disp"]; ?> 
				showing of <?php echo $rowTicketItem["title"]; ?> at <?php echo $rowTicketItem["theatername"]; ?><br>
				<div class="form-group col-12">
					<label for="adultTickets">Adult Tickets</label>
					<select name="adultTickets" id="adultTickets" class="form-control" onChange="changeQuantity(<?php echo $rowTicketItem["id"]; ?>, 1, this.selectedIndex)">
					<?php for($k = 0; $k <= 9; $k++): ?>
						<?php if ($rowTicketItem["adulttickets"] == $k): ?>
							<option selected>
						<?php else: ?>
							<option>
						<?php endif ?>
						<?php echo $k; ?></option>
					<?php endfor ?>
					</select>
				</div>
				<div class="form-group col-12">
					<label for="childTickets">Child Tickets</label>
					<select name="childTickets" id="childTickets" class="form-control" onChange="changeQuantity(<?php echo $rowTicketItem["id"]; ?>, 2, this.selectedIndex)">
					<?php for($k = 0; $k <= 9; $k++): ?>
						<?php if ($rowTicketItem["childtickets"] == $k): ?>
							<option selected>
						<?php else: ?>
							<option>
						<?php endif ?>
						<?php echo $k; ?></option>
					<?php endfor ?>
					</select>
				</div>
				<button type="button" name="removeFromOrder<?php echo $rowTicketItem["id"]; ?>" id="removeFromOrder<?php echo $rowTicketItem["id"]; ?>" class="btn btn-outline-danger" 
					onClick="removeFromOrder(<?php echo $rowTicketItem["id"]; ?>)">remove from order</button>
				<hr>
			</div>
		<?php endfor ?>
		<div class="form-group col-12">
			<label for="totalCharge">Total Charge:</label>
			<input type="text" name="totalCharge" id="totalCharge" class="form-control" size="5" readonly value="<?php echo $totalCharge; ?>">
		</div>
	</form>
	If you would like confirmation of your order, please enter your email address
	<form method="post" action="ticket_confirm.php" name="orderForm">
		<div class="form-group col-12">
			<input type="text" name="orderEmail" id="orderEmail" class="form-control" size="35"><br>
			<button type="submit" name="completeOrder" id="completeOrder" class="btn btn-success" onClick="addShow()">Complete Order</button>
			<a class="btn btn-primary" href="index.php" role="button">Back to movie selection</a>
		</div>
	</form>

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