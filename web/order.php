<?php 
require_once("model/TicketOrder.php");
require_once("model/TicketItem.php");
require_once("model/UtilsMain.php");

$orderid = UtilsMain::sessionGet("Order");
?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Cinema Order</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script language="JavaScript" type="text/JavaScript" src="js/jquery-2.1.4.min.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/myAjax.js"></script>
	<script language="JavaScript">
		function changeQuantity(pitemid, ptickettype, pnewquantity) {
			var res = serv('order_fn_ajax.php', {fn : 'changeQuantity', pitemid : pitemid, ptickettype : ptickettype, pnewquantity : pnewquantity});
			if(res >= 0) parent.Order.document.OrderTickets.TotalCharge.value = res;
			else alert("Error " + res);
		}
	</script>
</head>
<body bgcolor="#FFFFFF">
<?php if ($orderid != ""): ?>
	<img src="img/your_ticket_order.gif" width="248" height="65">
	<br>
	<?php
		$result_ticket_order = TicketOrder::showTicketOrder($orderid);
		$result_ticket_item = TicketItem::showItem($orderid);
		$num = 0;
	?>
	<form name="OrderTickets">
		<?php for($ii = 0; $ii < pg_num_rows($result_ticket_item); $ii++): 
				$row_ticket_item = pg_fetch_array($result_ticket_item, $ii);
			?>
			For the <?php echo $row_ticket_item["starttime_disp"]; ?> 
			showing of <?php echo $row_ticket_item["title"]; ?> at <?php echo $row_ticket_item["theatername"]; ?><br>
			<br>
			&nbsp;&nbsp;
			<select name="AdultTickets" onChange="changeQuantity(<?php echo $row_ticket_item["id"]; ?>, 1, this.selectedIndex)">
			<?php for($k = 0; $k <= 9; $k++): ?>
				<?php if ($row_ticket_item["adulttickets"] == $k): ?>
					<option selected>
				<?php else: ?>
					<option>
				<?php endif ?>
				<?php echo $k; ?></option>
			<?php endfor ?>
			</select>
			Adult Tickets<br>
			<br>
			&nbsp;&nbsp;
			<select name="ChildTickets" onChange="changeQuantity(<?php echo $row_ticket_item["id"]; ?>, 2, this.selectedIndex)">
			<?php for($k = 0; $k <= 9; $k++): ?>
				<?php if ($row_ticket_item["childtickets"] == $k): ?>
					<option selected>
				<?php else: ?>
					<option>
				<?php endif ?>
				<?php echo $k; ?></option>
			<?php endfor ?>
			</select>
			Child Tickets<br>
			<br>
		<?php endfor ?>
		Total Charge:
		<?php
			$TotalCharge = 0;
			if (pg_num_rows($result_ticket_order) > 0){
				$row_ticket_order = pg_fetch_array($result_ticket_order, 0);
				$TotalCharge = $row_ticket_order["total"];
			}
		?>
		<input type="text" name="TotalCharge" size="5" readonly value="<?php echo $TotalCharge; ?>">
	</form>
	If you would like confirmation of your order, please enter your email address
	<form method="post" action="ticket_confirm.php" name="OrderForm">
		<input type="text" name="OrderEmail" size="35"><br>
		<input type="submit" name="completeOrder" value="Complete Order">
	</form>
<?php endif ?>
</body>
</html>
