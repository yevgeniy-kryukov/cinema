<?php

use cinema\components\Html;

?>
<h3 class="text-center my-2">List of theaters</h3>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Adult price</th>
            <th scope="col">Child price</th>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ii = 0;
        foreach ($listTheaters as $itemTheatr): 
            $ii++;
        ?>
        <tr>
            <td scope="row"><?php echo $ii; ?></td>
            <td><?php echo Html::encode($itemTheatr["theatername"]); ?></td>
            <td><?php echo $itemTheatr["adultprice"]; ?></td>
            <td><?php echo $itemTheatr["childprice"]; ?></td>
            <td align="center">
                <a href="/theater/view/<?php echo $itemTheatr["id"]; ?>">View</a>
            </td>
        </tr>
        <?php 
        endforeach 
        ?>
    </tbody>
</table>
