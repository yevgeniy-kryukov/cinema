<h3 class="text-center my-2">
    For the <?php echo $infoShow["starttime_disp"]; ?> 
    showing of <?php echo $infoShow["filmtitle"]; ?> at <?php echo $infoShow["theatername"]; ?>
</h3><br>

<form name="tickets" method="post">
    <div class="form-group col-12">
        <label for="adultTickets">Adult Tickets</label>
        <select class="form-control" name="adultTickets" id="adultTickets">
        <?php for ($k = 0; $k <= 9; $k++): ?>
            <option <?php echo $k == $adultTickets ? "selected" : ""; ?>><?php echo $k; ?></option>
        <?php endfor ?>
        </select>
    </div>
    <div class="form-group col-12">
        <label for="childTickets">Child Tickets</label>
        <select class="form-control" name="childTickets" id="childTickets">
        <?php for ($k = 0; $k <= 9; $k++): ?>
            <option <?php echo $k == $childTickets ? "selected" : ""; ?>><?php echo $k; ?></option>
        <?php endfor ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Add to order</button>
    <a class="btn btn-primary" href="/" role="button">Back to movie selection</a>
    <?php if ($ticketsStatus == "SuccessAdded"): ?>
        <div class="alert alert-success" role="alert">
            Ticket added to order successfully.
        </div>
        <a class="btn btn-primary" href="/order/view/<?php echo $idOrder;?>" role="button">Complete order</a>
    <?php elseif ($ticketsStatus == "AlreadyAdded"): ?>
        <div class="alert alert-warning" role="alert">
            You have already added this show to your order.
        </div>
    <?php elseif ($ticketsStatus == "TicketsZero"): ?>
        <div class="alert alert-warning" role="alert">
            Not specified number of tickets
        </div>
    <?php elseif ($ticketsStatus == "UnknownError"): ?>
        <div class="alert alert-danger" role="alert">
            Unknown Error
        </div>
    <?php endif ?>
</form>