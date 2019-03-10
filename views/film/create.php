<?php if (is_array($errors)): ?>
    <ul class="text-left my-3">
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<h3 class="text-center my-3">Create film</h3>
<br>
<form method="post" enctype="multipart/form-data">
    <table style="width:100%" border="1" cellpadding="3">
        <tr>
            <td style="width:20%">Title</td>
            <td><input type="text" name="title" class="form-control" value=""></td>
        </tr>
        <tr>
            <td>Description</td>
            <td>
                <input type="text" name="description" class="form-control" value="">
            </td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select name="category" class="form-control">
                    <?php foreach ($listCategories as $category): ?>
                        <option value="<?php echo $category["id"]; ?>"><?php echo $category["categoryname"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Length</td>
            <td>
                <input type="text" name="length" class="form-control" value="">
            </td>
        </tr>
        <tr>
            <td>Rating</td>
            <td>
                <select name="rating" class="form-control">
                    <option>G</option>
                    <option>PG</option>
                    <option>PG-13</option>
                    <option>R</option>                        
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
                    <input type="checkbox" name="playingnow" class="form-check-input position-static">
                </div>
            </td>
        </tr>
    </table>
    <br>
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
    <a class="btn btn-primary" href="/film" role="button">Back to list</a>
</form>