<?php

use cinema\components\Utils;

?>
<h3 class="text-center my-2">Show Times for <?php echo $titleFilm; ?></h3>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Date show</th>
            <th scope="col">Start time</th>
            <th scope="col">Theater</th>
            <th scope="col">Hall</th>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ii = 0;
        foreach ($listShows as $itemShow): 
            $ii++;
        ?>
        <tr>
            <td scope="row"><?php echo $ii; ?></td>
            <td><?php echo $itemShow["dateshow"]; ?></td>
            <td><?php echo $itemShow["starttime_disp"]; ?></td>
            <td><?php echo Utils::HtmlEncode($itemShow["theatername"]); ?></td>
            <td><?php echo Utils::HtmlEncode($itemShow["hall_name"]); ?></td>
            <td align="center">
                <a href="/orderItem/index/<?php echo $itemShow["id"]; ?>">
                    <img src="/template/img/tickets.gif" width="130" height="39" border="0" alt="Click to book tickets for this show">
                </a>
            </td>
        </tr>
        <?php 
        endforeach 
        ?>
    </tbody>
</table>
