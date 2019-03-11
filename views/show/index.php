<?php

use cinema\components\Utils;

?>
<h3 class="text-center my-2">List of shows</h3>
<a class="btn btn-primary" href="/show/create" role="button">Create</a>
<br><br>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Date show</th>
            <th scope="col">Start time</th>
            <th scope="col">Theater</th>
            <th scope="col">Hall</th>
            <th scope="col">Film</th>
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
            <td><?php echo Utils::HtmlEncode($itemShow["film_title"]); ?></td>
            <td align="center">
                <a href="/show/view/<?php echo $itemShow["id"]; ?>">View</a>
                <a href="/show/update/<?php echo $itemShow["id"]; ?>">Update</a>
            </td>
        </tr>
        <?php 
        endforeach 
        ?>
    </tbody>
</table>
