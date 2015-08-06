<?php
require_once '../common/constant.php';
require_once '../common/verify_permission.php';
require_once '../model/Coupon.class.php';


$_coupon = new Coupon();
$_coupon->name = $_POST['name'];
$_coupon->price = intval($_POST['price']);
$_coupon->need_min = intval($_POST['need_min']);
$_coupon->get_type = intval($_POST['get_type']);
$_coupon->get_date = $_POST['get_date'];
$_coupon->get_count = intval($_POST['get_count']);
$_coupon->begin_date = $_POST['begin_date'];
$_coupon->end_date = $_POST['end_date'];
$_coupon->save();

?>
<meta charset="utf-8"/>
<script>
alert("保存成功");
document.location.href = "../pages/coupon.php";
</script>