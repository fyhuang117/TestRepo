<?php
require_once '../common/constant.php';
require_once '../common/verify_permission.php';
require_once '../model/User.class.php';

$_user = new User();
$_user->id = intval($_GET['id']);
$_user->init();

$_user->refuse();
?>
<meta charset="utf-8"/>
<script>
alert("拒绝成功");
<?php 
		if($_user->type == 0){
			echo 'parent.document.location.href = "../pages/buy.php";';
		}else{
			echo 'parent.document.location.href = "../pages/sell.php";';
		}
?>
</script>