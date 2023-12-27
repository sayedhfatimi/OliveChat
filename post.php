<?php
session_start();
if(isset($_SESSION['name'])){
	$postmsgtxt = $_POST['postmsgtxt'];
	$fp = fopen("clog.html",'a');
	fwrite($fp, "	<div class='postcontainer'>
					<div class='postmsg'>".stripslashes(htmlspecialchars($postmsgtxt))."</div>
					<div class='postusr'>by ".$_SESSION['name']." on ".date("g:i A")."</div>
					</div>
				");
	fclose($fp);}
?>