<?php 
require_once "../autoloader.php";

use cinema\model\Show;
use cinema\util\{DataBase, Main};

$showID = Main::requestGet("showID");

$link = DataBase::dbConnect();

$resultInfoShow = Show::infoShow($showID, $link);

pg_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add to order</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cinema">
    <meta name="author" content="Yevgeniy Kryukov">
    <link rel="icon" href="img/cinema.ico">
	<script language="JavaScript">
    function addShow()
    {
        var body = "";
        var footer = "";
        var jobj = { fn : 'addShow', showID : <?php echo $showID; ?>, 
                     adultTickets : document.getElementById("adultTickets").value, 
                     childTickets : document.getElementById("childTickets").value };
        var res = serv('ticket_to_order_fn_ajax.php', jobj);
        if(res > 0) {
            body = "Ticket added to order successfully.";
            footer = '<a class="btn btn-primary" href="order.php" role="button">Complete order</a>' +
                        '<a class="btn btn-primary" href="index.php" role="button">Back to movie selection</a>';
        } else { 
            if (res == -100) {
                body = "You have already added this show to your order. The number of tickets can be changed in the order.";
                footer = '<a class="btn btn-primary" href="order.php" role="button">Complete order</a>' +
                        '<a class="btn btn-primary" href="index.php" role="button">Back to movie selection</a>';
            } else {
                body = "It was not possible to add a ticket to the order. Error #" + res;
                footer = '<button type="button" class="btn btn-primary" data-dismiss="modal">Try again</button>';
            }
        }
        $('#dialogModal .modal-body').html(body);
        $('#dialogModal .modal-footer').html(footer);
        $('#dialogModal').modal();
        return false;
    }
	</script>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <h3>
        For the <?php echo $resultInfoShow["starttime_disp"]; ?> 
        showing of <?php echo $resultInfoShow["filmtitle"]; ?> at <?php echo $resultInfoShow["theatername"]; ?>
    </h3><br>

	<form name="tickets">
        <div class="form-group col-12">
            <label for="adultTickets">Adult Tickets</label>
            <select class="form-control" name="adultTickets" id="adultTickets">
            <?php for($k = 0; $k <= 9; $k++): ?>
                <option <?php echo $k == 2 ? "selected" : ""; ?>><?php echo $k; ?></option>
            <?php endfor ?>
            </select>
        </div>
        <div class="form-group col-12">
            <label for="childTickets">Child Tickets</label>
            <select class="form-control" name="childTickets" id="childTickets">
            <?php for($k = 0; $k <= 9; $k++): ?>
                <option <?php echo $k == 0 ? "selected" : ""; ?>><?php echo $k; ?></option>
            <?php endfor ?>
            </select>
        </div>
        <button type="button" class="btn btn-primary" onClick="addShow()">Add to order</button>

        <!-- Modal dialog -->
        <div class="modal fade" id="dialogModal" tabindex="-1" role="dialog" aria-labelledby="dialogModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dialogModal">Result of addition to order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
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