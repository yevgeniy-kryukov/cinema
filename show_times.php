<?php
	require_once("model/UtilsMain.php");
	require_once("model/Utils.php");
	require_once("model/DataBase.php");
	require_once("model/Film.php");
	require_once("model/Show.php");

	$title_film = "";
	$link = DataBase::db_connect();
	$result_film = Film::InfoFilm(UtilsMain::request_get("FilmID"), $link);
	if (pg_num_rows($result_film) > 0) {
		$row_film = pg_fetch_array($result_film, 0);
		$title_film = $row_film["title"];
	}
?>
<DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script language="JavaScript" type="text/JavaScript" src="js/jquery-2.1.4.min.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/myAjax.js"></script>
	<script language="JavaScript">
		function AddShow(showid){
			var res = serv('show_times_fn_ajax.php', {fn : 'AddShow', showid : showid});
			if(res > 0) {
				parent.Order.location="order.php";
			} else {
				alert("Error " + res);
			}
			return false;
		}
	</script>
	<title>Cinema PHP Show Times</title>
</head>
<body bgcolor="#FFFFFF">
<font color="#0000FF" size="+2"><b>Today's Show Times for <nobr><?php echo $title_film; ?></nobr></b></font>
<table cellpadding="5">
	<tr>
		<td><b>Time</b></td>
		<td><b>Theater</b></td>
		<td align="center">&nbsp;</td>
	</tr>
<?php
	$result_show = Show::ShowTimes(UtilsMain::request_get("FilmID"), $link); 
	for($ii = 0; $ii < pg_num_rows($result_show); $ii++): 
		$row_show = pg_fetch_array($result_show, $ii);
?>
	<tr>
		<td><?php echo $row_show["starttime_disp"]; ?></td>
		<td><?php echo $row_show["theatername"]; ?></td>
		<td align="center">
			<a href="#click" onClick="AddShow(<?php echo $row_show["id"]; ?>)">
			<img src="img/Tickets.gif" width="130" height="39" border="0" alt="Click to order tickets for this show"></a>
		</td>
	</tr>
<?php endfor ?>
</table>
</body>
</html>
<?php pg_close($link); ?>