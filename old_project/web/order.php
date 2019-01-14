<?php 
require_once "../autoloader.php";

use cinema\model\{TicketOrder, TicketItem};
use cinema\util\{DataBase, Main};

$orderID = Main::requestGet("orderID");

$link = DataBase::dbConnect();

$resultTicketOrder = TicketOrder::showTicketOrder($orderID, $link);
$orderTotalSum = $resultTicketOrder["total"];
$orderComplete = $resultTicketOrder["complete"];

$resultTicketItem = TicketItem::showItems($orderID, $link);
$countTicketItem = count($resultTicketItem);

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
			if (res >= 0) $("#orderTotalSum").val(res);
			else alert("Error " + res);
		}
		function removeFromOrder(pitemid) 
		{
			if (!confirm("Do you really want to remove from the order?")) return;
			var res = serv('order_fn_ajax.php', { fn : 'removeItem', pitemid : pitemid });
			if (res >= 0) {
				$("#orderItem" + pitemid).remove();
				$("#orderTotalSum").val(res);
			} else {
				alert("Error " + res);
			}
		}
		function completeOrder(porderid)
		{
			for (var i = 0; i < $("#countTicketItem").val(); i++) {
				if ( ($("#adultTickets" + i).val() == 0) && ($("#childTickets" + i).val() == 0) ) {
					alert("Error: you did not specify the number of tickets.\n" + $("#orderItemTitul" + i).text());
					return;
				}
			}
			if (!confirm("Do you really want complete order?")) return;
			var res = serv('order_fn_ajax.php', { fn : 'completeOrder', porderid : porderid });
			if (res > 0) {
				alert("Your order was processed successfully.");
				window.location = "show_user_orders.php";
			} else {
				alert("Error " + res);
			}			
		}
	</script>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<img src="img/your_ticket_order.gif" width="248" height="65">
	<br>
	<form name="orderTickets">
		<input type="hidden" name="countTicketItem" id="countTicketItem" value="<?php echo $countTicketItem; ?>">
		<?php for($ii = 0; $ii < $countTicketItem; $ii++): 
				$rowTicketItem = $resultTicketItem[$ii];
			?>
			<div id="orderItem<?php echo $ii; ?>">
				<div id="orderItemTitul<?php echo $ii; ?>">For the <?php echo $rowTicketItem["starttime_disp"]; ?> showing of <?php echo $rowTicketItem["title"]; ?> at <?php echo $rowTicketItem["theatername"]; ?></div>
				<div class="form-group col-12">
					<label for="adultTickets<?php echo $ii; ?>">Adult Tickets</label>
					<select name="adultTickets<?php echo $ii; ?>" id="adultTickets<?php echo $ii; ?>" class="form-control" 
						onChange="changeQuantity(<?php echo $rowTicketItem["id"]; ?>, 1, this.selectedIndex)" <?php echo $orderComplete == 't' ? "disabled" : ""; ?>>
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
					<label for="childTickets<?php echo $ii; ?>">Child Tickets</label>
					<select name="childTickets<?php echo $ii; ?>" id="childTickets<?php echo $ii; ?>" class="form-control" 
						onChange="changeQuantity(<?php echo $rowTicketItem["id"]; ?>, 2, this.selectedIndex)" <?php echo $orderComplete == 't' ? "disabled" : ""; ?>>
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
				<button type="button" name="removeFromOrder<?php echo $ii; ?>" id="removeFromOrder<?php echo $ii; ?>" 
					class="btn btn-outline-danger <?php echo $orderComplete == 't' ? " d-none" : ""; ?>" 
					onClick="removeFromOrder(<?php echo $rowTicketItem["id"]; ?>)"> 
					remove from order
				</button>
				<hr>
			</div>
		<?php endfor ?>
		<div class="form-group col-12">
			<label for="orderTotalSum">Total Sum:</label>
			<input type="text" name="orderTotalSum" id="orderTotalSum" class="form-control" size="5" readonly value="<?php echo $orderTotalSum; ?>">
		</div>
		<div class="form-group col-12">
		<button type="button" name="btnCompleteOrder" id="btnCompleteOrder" class="btn btn-success <?php echo $orderComplete == 't' ? " d-none" : ""; ?>" 
			onClick="completeOrder(<?php echo $orderID; ?>)">
			Complete Order
		</button>
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