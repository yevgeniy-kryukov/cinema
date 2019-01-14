<h3 class="text-center my-2">Show user orders <?php echo $emailUser; ?></h3>
<table class="table table-hover">
    <thead>
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
        $ii = 0;
        foreach ($listUserOrder as $itemUserOrder): 
            $ii++;
        ?>
        <tr>
            <td scope="row"><?php echo $ii; ?></td>
            <td><?php echo $itemUserOrder["order_date"]; ?></td>
            <td><?php echo $itemUserOrder["total"]; ?></td>
            <td><?php echo $itemUserOrder["complete"]; ?></td>
            <td align="center">
                <a class="btn btn-primary" href="/order/view/<?php echo $itemUserOrder["id"]; ?>" role="button">Go to order</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>