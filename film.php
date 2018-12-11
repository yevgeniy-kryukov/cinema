<html>
<head>
<title>Cache Server Page - form (Samples)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language=JavaScript>
<!--
function update(id) {
	#server(..formLoad(id))#;
	return true;
}
// -->
</script>
</head>

<body bgcolor="#FFFFFF">
<table width=100% border=0>
	<tr>
	<td colspan=2 bgcolor=#D0D0FF>
		<font face="Verdana,Arial,Helvetica,sans-serif" color=#000088 size=+2>
		<center>Cinema.Film</center>
		</font>
	</td>
	</tr>
</table>
<!-- use CSP:OBJECT tag to create a reference to an instance of the class -->
<csp:object name="objForm" classname="Cinema.Film" objid=#($get(%request.Data("OBJID",1)))#>
<!-- use CSP:SEARCH tag to create a javascript function to invoke a search page -->
<csp:search name="form_search" classname="Cinema.Film" where="Title" options=predicates,sortbox>
<form name="form" cspbind="objForm" onSubmit='return form_validate();'>
	<center>
	<table cellpadding=3>
		<tr>
		<td><b>
			<div align=right>*Title:</div>
		</b> </td>
		<td>
			<input type=text name=Title cspbind="Title" size=50 csprequired>
		</td>
		</tr>
		<tr>
		<td> <b>
			<div align=right>Description:</div>
		</b> </td>
		<td>
			<input type=text name=Description cspbind="Description" size=80>
		</td>
		</tr>
		<tr>
		<td> <b>
			<div align=right>Playing Now:</div>
		</b> </td>
		<td>
			<input type=checkbox name=PlayingNow cspbind="PlayingNow">
		</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td>
			<input type=button name=btnClear value=Clear onClick='form_new();'>
			<input type=button name=btnSave value=Save onClick='form_save();'>
			<input type=button name=btnSearch value=Search onClick='form_search();'>
		</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td> <font face="Verdana,Arial,Helvetica,sans-serif" color=#000088 size=2>
			(* Denotes required fields)
		</font></td>
		</tr>
	</table>
	</center>
</form>
</body>
</html>
