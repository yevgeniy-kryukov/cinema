<?php
	namespace Cinema;

	require_once("model/FilmCategory.php");
	
	$result = FilmCategory::categoryName();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Untitled Document</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>

<body bgcolor="#FFFFFF">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td><img src="img/php_cinema_logo.gif" width="273" height="70" vspace="0" hspace="0">
	</td>
	<td align="right">
		<form name="Search" action="search_results.php" target="Main" method="post">
			<b>Find</b>
			<select name="CategoryList" size="1">
				<option value="*" selected>Any Category</option>
				<?php for($ii = 0; $ii < pg_num_rows($result); $ii++): 
						$row = pg_fetch_array($result, $ii);
				?>
					<option value="<?php echo $row["id"]; ?>"><?php echo $row["categoryname"]; ?></option>
				<?php endfor ?>
			</select>
			<b>movies rated</b>
			<select name="RatingList" size="1">
				<option value="*" selected>Any Rating</option>
				<option>G</option>
				<option>PG</option>
				<option>PG-13</option>
				<option>R</option>
			</select>
			<input type="submit" name="Submit" value="Go!">
		</form>
	</td>
	</tr>
</table>
<hr>
</body>
</html>
