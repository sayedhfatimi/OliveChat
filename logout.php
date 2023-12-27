<?php
	session_start();
	$fp = fopen("clog.html",'a');
	fwrite($fp,"<div class='infomsg'>".$_SESSION['name']." has left the chat session.</div>");
	fclose($fp);
	session_destroy();
	header("Location: index.php");
?>