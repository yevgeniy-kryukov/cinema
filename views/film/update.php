<?php

use cinema\components\Utils;

?>
<?php if (is_array($errors)): ?>
    <ul class="text-left my-3">
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<h3 class="text-center my-3">Update film: <?php echo $film['title']; ?></h3>
<br>
<form method="post" enctype="multipart/form-data">
    <table style="width:100%" border="1" cellpadding="3">
        <tr>
            <td style="width:20%">Title</td>
            <td><input type="text" name="title" class="form-control" value="<?php echo Utils::HtmlEncode($film['title']); ?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td>
                <input type="text" name="description" class="form-control" value="<?php echo Utils::HtmlEncode($film['description']); ?>">
            </td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select name="category" class="form-control">
                    <?php foreach ($listCategories as $category): ?>
                        <?php 
                            if ($category['id'] == $film['category']) { 
                                $sel = "selected";
                            } else {
                                $sel = "";
                            } 
                        ?>
                        <option value="<?php echo $category["id"]; ?>" <?php echo $sel; ?> ><?php echo $category["categoryname"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Length</td>
            <td>
                <input type="text" name="length" class="form-control" value="<?php echo $film['length']; ?>">
            </td>
        </tr>
        <tr>
            <td>Rating</td>
            <td>
                <select name="rating" class="form-control">
                    <option <?php echo $film["rating"] == "G" ? "selected" : ""; ?>>G</option>
                    <option <?php echo $film["rating"] == "PG" ? "selected" : ""; ?>>PG</option>
                    <option <?php echo $film["rating"] == "PG-13" ? "selected" : ""; ?>>PG-13</option>
                    <option <?php echo $film["rating"] == "R" ? "selected" : ""; ?>>R</option>                        
                </select>
            </td>
        </tr>
        <tr>
            <td>Poster</td>
            <td>
                <input type="file" name="poster" placeholder="" value="">
            </td>
        </tr>
        <tr>
            <td>Playing now</td>
            <td>
                <div class="form-check">
                    <input type="checkbox" name="playingnow" class="form-check-input position-static" <?php echo $film['playingnow_yn'] == 'yes' ? 'checked' : ''; ?>>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
    <a class="btn btn-primary" href="/film" role="button">Back to list</a>
</form>