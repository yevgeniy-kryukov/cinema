<?php
	namespace Cinema;
	
	require_once("model/UtilsMain.php");
	require_once("model/Film.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Untitled Document</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body>
<font color="#0000FF" size="+2"><b>Search Results</b></font>
<table>
<?php
	$result = Film::ListFilms(UtilsMain::requestPost("CategoryList"), UtilsMain::requestPost("RatingList"));
	for ($ii = 0; $ii < pg_num_rows($result); $ii++):
		$row = pg_fetch_array($result, $ii);
?>
	<tr>
		<td>
			<font size="+1"><b><?php echo $row["title"]; ?></b></font><br>
			<?php echo $row["description"]; ?><br>
			<nobr><b>Genre</b> <?php echo $row["categoryname"]; ?></nobr> <nobr><b>Length</b>
			<?php echo $row["length"]; ?> minutes</nobr> <nobr><b>Rating</b>
			<?php echo $row["rating"]; ?></nobr><br><br>
		</td>
		<td><a href='show_times.php?FilmID=<?php echo $row["id"]; ?>'><img src="img/show_times.gif" width="130" height="39" border="0" alt="Click to see show times for this film"></a></td>
	</tr>
<?php endfor ?>
</table>
</body>
</html>
