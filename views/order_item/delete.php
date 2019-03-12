<?php

use cinema\components\Html;

?>
<h3 class="text-center my-3">Do you really want to delete this item from order?</h3>
<form method="post">
    <div>
        <div>For the <?php echo $itemOrder["starttime_disp"]; ?> showing of <?php echo Html::encode($itemOrder["title"]); ?> 
        at <?php echo Html::encode($itemOrder["theatername"]); ?></div>
        <div class="form-group col-12">
            <div>Adult Tickets <?php echo $itemOrder["adulttickets"]; ?></div>
        </div>
        <div class="form-group col-12">
            <div>Child Tickets <?php echo $itemOrder["childtickets"]; ?></div>
        </div>
    </div>
    <div class="form-group col-12">
        <button type="submit" name="submit" class="btn btn-primary">Yes</button>
        <a class="btn btn-primary" href="/order/view/<?php echo $idOrder; ?>" role="button">No</a>
    </div>
</form>