<h3 class="text-center my-3"><?php echo $show['filmtitle']; ?></h3>
<br>
<a class="btn btn-primary" href="/show/update/<?php echo $show['id']; ?>" role="button">Update</a>
<a class="btn btn-primary" href="/show" role="button">Back to list</a>
<!-- <a class="btn btn-danger" href="/show/delete/<?php echo $show['id']; ?>" role="button">Delete</a> -->
<br><br>
<table style="width:100%" border="1" cellpadding="3">
    <tr>
        <td style="width:20%">Film</td>
        <td><?php echo $show['filmtitle']; ?></td>
    </tr>
    <tr>
        <td>Start time</td>
        <td><?php echo $show['starttime_disp']; ?></td>
    </tr>
    <tr>
        <td>Date show</td>
        <td><?php echo $show['dateshow']; ?></td>
    </tr>
    <tr>
        <td>Theater hall</td>
        <td><?php echo $show['theatername'] . ', ' . $show['hall_name']; ?></td>
    </tr>
    <tr>
        <td>Adult price</td>
        <td><?php echo $show['adultprice']; ?></td>
    </tr>
    <tr>
        <td>Child price</td>
        <td><?php echo $show['childprice']; ?></td>
    </tr>
</table>