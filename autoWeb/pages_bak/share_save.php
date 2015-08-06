<?php
require_once '../common/constant.php';
require_once '../common/core.php';
require_once '../model/Share.class.php';
require_once '../model/User.class.php';

$_share_user = new User();
$_share_user->id = id_decode($_POST['share_user_id']);
$_share_user->init();

$tel = $_POST['tel'];

$_new_user = new User();
$_new_user->tel = $tel;
$_new_user->type = 0;
if($_new_user->getCountByTel() == 0){
	
	$_new_user->save();
	
	$_share = new Share();
	$_share->share_user = $_share_user;
	$_share->user = $_new_user;
	$_share->save();
	
}
 

?>

分享成功