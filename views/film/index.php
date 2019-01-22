<h3 class="text-center my-2">List of films</h3>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Playing now</th>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ii = 0;
        foreach ($listFilms as $itemFilm): 
            $ii++;
        ?>
        <tr>
            <td scope="row"><?php echo $ii; ?></td>
            <td><?php echo $itemFilm["title"]; ?></td>
            <td><?php echo $itemFilm["categoryname"]; ?></td>
            <td><?php echo $itemFilm["playingnow_yn"]; ?></td>
            <td align="center">
                <a href="/film/view/<?php echo $itemFilm["id"]; ?>">View</a>
            </td>
        </tr>
        <?php 
        endforeach 
        ?>
    </tbody>
</table>
