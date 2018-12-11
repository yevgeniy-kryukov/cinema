<html>
<head>
<title>Cach&eacute; Cinema Sample Data</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<p><img src="php_cinema_logo.gif" width="273" height="70"> </p>
<csp:if condition='$get(%request.Data("Action",1))="L"'>
	<script language="cache" runat="server">
		set classes = $get(%request.Data("Classes",1))
		set namespace = $get(%request.Data("NameSpace",1))
		if ('$ZU(90,10,namespace)) {
			write "Namespace " _ namespace _ "is not valid",!
		} else {
			set oldns = $ZU(5)
			do $ZU(5,namespace)
			set result = $$Load^|"Samples"|CinemaData(classes)
			do $ZU(5,oldns)
			if (result = 1) {
				write "Data loaded successfully",!
			} elseif (result = -1) {
				write "No data loaded. Make sure that the classes have been defined and compiled.",!
			} Elseif (result = -2) {
				write "No data loaded. Make sure that all properties have been defined.",!
			} else {
				write "An error occured while loading data.",!
			}
		}
	</script>
<csp:else>
	<form method="post" action='LoadData.csp?Action=L' name="LoadDataForm">
		<p>This page loads sample data for the Cach&eacute; Cinema application. Simply:</p>
		<table border="0" align="center" width="95%">
		<tr valign="top">
		<td width="20" align="right">1</td>
		<td>Select which class(es) to load. The class definitions must already be
			created and compiled.</td>
		<td>
			<select name="Classes" size="1">
				<option value="1" selected>Film class</option>
				<option value="2">Film &amp; FilmCategory classes</option>
				<option value="3">Film, FilmCategory, Theater, &amp; Show classes </option>
			</select>
		</td>
		</tr>
		<tr valign="top">
		<td width="20" align="right">2</td>
		<td>Select a namespace to load them into. The tutorial assumes &quot;User&quot;.</td>
		<td>
			<select name="NameSpace" size="1">
			<script language="cache" runat="server">
				kill nslist
				For i=1:1:$zu(90,0) {
					set nslist($zu(90,2,0,i))=""
				}
				set nsname=$order(nslist(""))
				while (nsname '= "") {
					if (nsname = "USER") {
						write "<option selected>" _ nsname _ "</option>",!
					} elseif ($e(nsname,1) '= "%") {
						write "<option>" _ nsname _ "</option>",!
					}
					set nsname=$order(nslist(nsname))
				}
			</script>
			</select>
		</td>
		</tr>
		<tr valign="top">
		<td width="20" align="right">3</td>
		<td>Click on the Go button.</td>
		<td>
			<input type="submit" name="GoButton" value="Go">
		</td>
		</tr>
		</table>
	</form>
</csp:if>
</body>
</html>
