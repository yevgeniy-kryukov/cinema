<h3 class="text-center my-3">Do you really want complete this order?</h3>
<br>
<form method="post">
    <?php foreach ($orderItems as $itemOrder): ?>
        <div>
            <div>For the <?php echo $itemOrder["starttime_disp"]; ?> showing of <?php echo $itemOrder["title"]; ?> at <?php echo $itemOrder["theatername"]; ?></div>
            <div class="form-group col-12">
                <div>Adult Tickets <?php echo $itemOrder["adulttickets"]; ?></div>
            </div>
            <div class="form-group col-12">
                <div>Child Tickets <?php echo $itemOrder["childtickets"]; ?></div>
            </div>
            <hr>
        </div>
    <?php endforeach ?>
    <div class="form-group col-12">
        Total Sum: <?php echo $orderTotalSum; ?>
    </div>
    <div class="form-group col-12">
        <button type="submit" name="submit" class="btn btn-primary">Yes</button>
        <a class="btn btn-primary" href="/order/view/<?php echo $idOrder; ?>" role="button">No</a>
    </div>
</form>