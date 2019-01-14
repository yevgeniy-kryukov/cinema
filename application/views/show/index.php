<h3 class="text-center my-2">Today's Show Times for <?php echo $titleFilm; ?></h3>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Time</th>
            <th scope="col">Theater</th>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ii = 0;
        foreach ($listShow as $itemShow): 
            $ii++;
        ?>
        <tr>
            <td scope="row"><?php echo $ii; ?></td>
            <td><?php echo $itemShow["starttime_disp"]; ?></td>
            <td><?php echo $itemShow["theatername"]; ?></td>
            <td align="center">
                <a href="/ticket/index/<?php echo $itemShow["id"]; ?>">
                    <img src="/img/tickets.gif" width="130" height="39" border="0" alt="Click to book tickets for this show">
                </a>
            </td>
        </tr>
        <?php 
        endforeach 
        ?>
    </tbody>
</table>
