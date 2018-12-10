<?php
	require_once("model/DataBase.php");
	require_once("model/UtilsMain.php");
	require_once("model/FilmCategory.php");
	require_once("model/Film.php");
	$link =  DataBase::db_connect();
?>
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body>
<?php
	$CatName = "";
	$CatID = UtilsMain::request_get_cookie("CacheCinemaLastCategory");
	if ($CatID != "") {
		$result_cat = FilmCategory::CategoryInfo($CatID, $link);
		if (pg_num_rows($result_cat) > 0) {
			$row = pg_fetch_array($result_cat, 0);
			$CatName = $row["categoryname"];
		}
	}
	if ($CatName != "") {
		$Query = "TopCategory";
		$P1 = $CatID;
	} else {
		$Query = "TopFilms";
		$P1 = "";
	}
?>
<font color="#0000FF" size="+2"><b>Today's <?php echo $CatName; ?> Top Picks </b></font>
<table>
<?php 
	if ($Query == "TopCategory") $result = Film::TopCategory($P1, $link);
	else if ($Query == "TopFilms") $result = Film::TopFilms($link);
	for($ii = 0; $ii < pg_num_rows($result); $ii++):
		$row = pg_fetch_array($result, $ii);
?>
	<tr><td>
		<font size="+1"><b><?php echo $row["title"]; ?></b></font><br>
		<?php echo $row["description"]; ?><br>
		<nobr><b>Genre</b> <?php echo $row["categoryname"]; ?> </nobr> <nobr><b>Length</b>
		<?php echo $row["length"]; ?> minutes</nobr> <nobr><b>Rating</b>
		<?php echo $row["rating"]; ?></nobr><br><br>
	</td>
	<td><a href='ShowTimes.php?FilmID=<?php echo $row["id"]; ?>'><img src="img/ShowTimes.gif" width="130" height="39" border="0" alt="Click to see show times for this film"></a></td>
	</tr>
<?php endfor ?>
</table>
</body>
</html>
<?php
	pg_close($link);
?>