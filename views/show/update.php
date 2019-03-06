<?php if (is_array($errors)): ?>
    <ul class="text-left my-3">
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<h3 class="text-center my-3">Update show: <?php echo $show['filmtitle']; ?></h3>
<br>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $show["id"]; ?>">
    <table style="width:100%" border="1" cellpadding="3">
        <tr>
            <td style="width:20%">Film</td>
            <td>
                <select name="film" class="form-control">
                    <?php foreach ($listFilms as $film): ?>
                        <?php 
                            if ($film['id'] == $show['filmid']) { 
                                $sel = 'selected';
                            } else {
                                $sel = '';
                            } 
                        ?>
                        <option value="<?php echo $film['id']; ?>" <?php echo $sel; ?> ><?php echo $film['title']; ?></option>
                    <?php endforeach; ?>                
                </select>
            </td>
        </tr>
        <tr>
            <td>Start time</td>
            <td>
                <input type="text" name="starttime" class="form-control" value="<?php echo $show['starttime_disp']; ?>">
            </td>
        </tr>
        <tr>
        <tr>
            <td>Date show</td>
            <td>                
                <input type="text" name="dateshow" class="form-control" value="<?php echo $show['dateshow']; ?>">
            </td>
        </tr>
        <tr>
            <td>Theater hall</td>
            <td>
                <select name="theaterhall" class="form-control">
                    <?php foreach ($listTheaterHalls as $hall): ?>
                        <?php 
                            if ($hall['id'] == $show['hallid']) { 
                                $sel = 'selected';
                            } else {
                                $sel = '';
                            } 
                        ?>
                        <option value="<?php echo $hall['id']; ?>" <?php echo $sel; ?> ><?php echo $hall['theatername'] . ', ' . $hall['hall_name']; ?></option>
                    <?php endforeach; ?>                
                </select>
            </td>
        </tr>
        <tr>
            <td>Adult price</td>
            <td>
                <input type="text" name="adultprice" class="form-control" value="<?php echo $show['adultprice']; ?>">
            </td>
        </tr>
        <tr>
            <td>Child price</td>
            <td>
                <input type="text" name="childprice" class="form-control" value="<?php echo $show['childprice']; ?>">
            </td>
        </tr>
    </table>
    <br>
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
</form>