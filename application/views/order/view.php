<h3 class="text-center my-3"><img src="/img/your_ticket_order.gif" width="248" height="65"></h3>
<br>
<form method="post">
    <?php foreach ($listItemOrder as $itemOrder): ?>
        <div>
            <div>
                For the <?php echo $itemOrder["starttime_disp"]; ?> showing of <?php echo $itemOrder["title"]; ?> 
                at <?php echo $itemOrder["theatername"]; ?>
            </div>
            <div class="form-group col-12">
                <div>Adult Tickets <?php echo $itemOrder["adulttickets"]; ?></div>
            </div>
            <div class="form-group col-12">
                <div>Child Tickets <?php echo $itemOrder["childtickets"]; ?></div>
            </div>
            <a href="/order/deleteItem/<?php echo $idOrder; ?>/<?php echo $itemOrder["id"]; ?>" 
            class="btn btn-outline-danger <?php echo $orderComplete == 't' ? " d-none" : ""; ?>" role="button"> 
                delete from order
            </a>
            <hr>
        </div>
    <?php endforeach ?>
    <div class="form-group col-12">
        Total Sum: <?php echo $orderTotalSum; ?>
    </div>
    <div class="form-group col-12">
        <a class="btn btn-success <?php echo $orderComplete == 't' ? " d-none" : ""; ?>" 
        href="/order/complete/<?php echo $idOrder; ?>" role="button">Complete order</a>
        <a class="btn btn-primary" href="/order" role="button">Back to order list</a>
        <a class="btn btn-primary" href="/" role="button">Back to movie selection</a>
    </div>
</form>