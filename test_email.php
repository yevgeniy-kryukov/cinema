<?php
require_once("model/Utils.php");
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<TITLE>Отправка email</TITLE>
<script language="JavaScript">
</script>
<style type="text/css">
</style>
</HEAD>

<BODY>
    <?php
        echo Utils::SendEmail();
    ?>
</BODY>
</HTML>