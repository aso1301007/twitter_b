<?php
session_start();

$t_id=$_SESSION['screen_name'];
$t_name=$_SESSION['name'];
$t_icon=$_SESSION['profile_image_url_https'];

//ログインしていないorセッションが切れた場合------------
	if($t_id==null){
		header("Location: login/login.php");
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/css.css"></link>
</head>
<body>
	<div class="main">
		<div id="home_button">
			<a href="main.php"><img src="img/home_icon.png." alt="home" width="45px" height="45px"></a>
		</div>

		<div id="system_name">
			<img src="img/twi析.png" alt="システム名" width="100px" height="45px"></img>
		</div>

		<div id="user_info">
			<div class="icon">
			<img src="<?php echo $t_icon;?>" alt="user_icon" width="50px" height="50px"	style="border:solid 1px #AAA;"></img>
			</div>

			<div class="info">
				<a>@<?php echo $t_id?></a><br/><a><font size="5em"><?php echo $t_name;?></font></a>
			</div>
		</div>

		<div class="border" style="margin-top:5.5%;"></div>