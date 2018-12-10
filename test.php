<?php
require_once("Film.php");
$result = Film::top_category(1);
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<TITLE>Тест X</TITLE>
<script language="JavaScript">
</script>
<style type="text/css">
</style>
</HEAD>
<BODY>
<br>
<form name="form" id="form" style="display:inline;margin-top:0px;margin-bottom:0px;">
<table>
<?php for($ii = 0; $ii < pg_num_rows($result); $ii++): 
        $row = pg_fetch_array($result, $ii);
?>
    <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["description"]; ?></td>
        <td><?php echo $row["length"]; ?></td>
        <td><?php echo $row["rating"]; ?></td>
        <td><?php echo $row["title"]; ?></td>
        <td><?php echo $row["categoryname"]; ?></td>
    </tr>
<?php endfor; ?>
</table>
</BODY>
</HTML>