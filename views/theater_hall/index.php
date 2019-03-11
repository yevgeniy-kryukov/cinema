<?php

use cinema\components\Utils;

?>
<h3 class="text-center my-2">List of theater halls</h3>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Theater</th>
            <th scope="col">Hall</th>
            <th scope="col">Seats number</th>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ii = 0;
        foreach ($listTheaterHalls as $itemHall): 
            $ii++;
        ?>
        <tr>
            <td scope="row"><?php echo $ii; ?></td>
            <td><?php echo Utils::HtmlEncode($itemHall["theatername"]); ?></td>
            <td><?php echo Utils::HtmlEncode($itemHall["hall_name"]); ?></td>
            <td><?php echo $itemHall["seats_number"]; ?></td>
            <td align="center">
                <a href="/hall/view/<?php echo $itemHall["id"]; ?>">View</a>
            </td>
        </tr>
        <?php 
        endforeach 
        ?>
    </tbody>
</table>
