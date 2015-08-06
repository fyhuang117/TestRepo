<?php
require_once '../common/constant.php';
require_once '../common/core.php';

if(isset($_GET['s'])){
	?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>分享</title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0, target-densitydpi=device-dpi">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="full-screen" content="yes"/>
    <meta name="screen-orientation" content="portrait"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="360-fullscreen" content="true"/>
</head>

<body style="background:#00abe3;">
<div style="position:absolute; height:540px; margin:auto; top:0; left:0; right:0; bottom:0; text-align:center; color:#FFF; font-weight:bold;">
	<form id="form1" name="form1" action="share_save.php" method="post">
		<img src="images/shareIcon.png" /><br>
<br>
<input type="hidden" name="share_user_id" value="<?php echo $_GET['s'];?>"/>
		<label for="textfield">请输入自己的电话号码<br>
		<input type="text" name="tel" id="tel" style="padding:4px; line-height:2em; font-size:1.5em; font-weight:bold; margin:24px 6px 6px 6px; text-align:center;"></label><br>
		<input type="submit" name="submit" id="submit" value=" 提 交 " style="margin-top:24px; border:none; padding:6px 32px; font-size:1.5em; font-weight:bold; border-radius:24px; background:#ffea00; color:#333;">
	</form>
</div>

</body>
</html>
	<?php 
}
?>


