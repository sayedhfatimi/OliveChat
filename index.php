<?php
	session_start();
	if(isset($_GET['logout'])){header("Location: logout.php");}
	function loginform(){
		echo'	<div id="loginform">
				<form action="index.php" method="post">
					<p style="margin-bottom: 3px;">Please enter your name:</p>
					<label for="name">Name:</label><input type="text" name="name" id="name" />
					<input type="submit" name="enter" id="enter" value="Enter" class="enter" />
				</form>
				</div>
		';}
	if(isset($_POST['enter'])){
		if($_POST['name'] != ""){
			$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
			$fp = fopen("clog.html",'a');
			fwrite($fp,"<div class='infomsg'>".$_SESSION['name']." has joined the chat session.</div>");
			fclose($fp);}else{echo '<span class="error">Please type in a name</span>';}}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>OliveChat</title>
<link href="css/mainStylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#303030" background="images/mainbg.png">
<? if(!isset($_SESSION['name'])){loginform();}else{ ?>
<div id="headercontainer">
    <div id="notification"></div>
    <div id="header">OliveChat</div>
    <div id="menu">
        <p class="welcome">Welcome, <b><? echo $_SESSION['name']; ?></b></p>
        <button class="navbarbtn"><div>Button</div></button>
        <button class="navbarbtn"><div>AnotherButton</div></button>
        <button id="exit" class="navbarbtn"><div>LeaveChat</div></button>
        <div style="clear:both"></div>
    </div>
    <div id="headerseperator"></div>
</div>	
<div id="content">
	<?
        if(file_exists("clog.html") && filesize("clog.html") > 0){
            $handle = fopen("clog.html","r");
            $contents = fread($handle, filesize("clog.html"));
            fclose($handle);
            echo $contents;}
	?>
</div>
<div id="msgform">
    <form name="message" action="">
        <input name="postmsgtxt" type="text" id="postmsgtxt" placeholder="Enter your message here..." value="" maxlength="200" />
        <input id="postsubmit" name="postsubmit" type="submit" class="postsubmit" value="send" />
    </form>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#postsubmit").click(function(){
		var postmsgtxt = $("#postmsgtxt").val();
		$.post("post.php",{postmsgtxt:postmsgtxt});				
		$("#postmsgtxt").attr("value","");
		return false;});
	function loadclog(){$.ajax({url:"clog.html",cache:false,success:function(html){$("#content").html(html);},});}
	setInterval(loadclog,1000);
	function logout(){window.location = 'index.php?logout=true';}
	$("#exit").click(function(){logout();});
	$("#headerseperator").click(function(){$("#notification").slideToggle("slow");});});
</script>
<? } ?>
</body>
</html>