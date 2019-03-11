<?php

use cinema\models\ModelFilm;

?>
<h3 class="text-center my-3"><?php echo $film['title']; ?></h3>
<br>
<a class="btn btn-primary" href="/film/update/<?php echo $film['id']; ?>" role="button">Update</a>
<a class="btn btn-primary" href="/film" role="button">Back to list</a>
<!-- <a class="btn btn-danger" href="/film/delete/<?php echo $film['id']; ?>" role="button">Delete</a> -->
<br><br>
<table style="width:100%" border="1" cellpadding="3">
    <tr>
        <td style="width:20%">Title</td>
        <td><?php echo $film['title']; ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo $film['description']; ?></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><?php echo $film['categoryname']; ?></td>
    </tr>
    <tr>
        <td>Length</td>
        <td><?php echo $film['length']; ?></td>
    </tr>
    <tr>
        <td>Rating</td>
        <td><?php echo $film['rating']; ?></td>
    </tr>
    <tr>
        <td>Poster</td>
        <td><img src="<?php echo ModelFilm::getImage($film["id"]); ?>"></td>
    </tr>
    <tr>
        <td>Playing now</td>
        <td><?php echo $film['playingnow_yn']; ?></td>
    </tr>
    <tr>
        <td>Tickets sold</td>
        <td><?php echo $film['ticketssold']; ?></td>
    </tr>
</table>