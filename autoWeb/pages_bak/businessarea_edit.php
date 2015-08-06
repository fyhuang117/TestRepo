<?php
require_once '../common/constant.php';
require_once '../common/verify_permission.php';
require_once '../model/BusinessArea.class.php';

$_businessArea = new BusinessArea();
$_businessArea->id = intval($_GET['id']);
$_businessArea->init();


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>易配购后台维护系统</title>
<link href="css/basic.css" rel="stylesheet">
<style>
table{ margin:0 auto; width:90%;}
td{ padding:4px 0;}
</style>
<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="js/js.js"></script>
</head>

<body>
<form action="businessarea_update.php" method="post" id="ad_update" enctype='multipart/form-data'>
<input type="hidden" name="id" value="<?php echo $_businessArea->id;?>"/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabls">
  <tr>
    <td align="left" width="150">名称</td>
    <td><input type="text" name="name" class="form-control" value="<?php echo $_businessArea->name;?>"></td>
  </tr>
  <tr>
    <td align="left" width="150">经度</td>
    <td><input type="text" name="lng" class="form-control" value="<?php echo $_businessArea->lng;?>"></td>
  </tr>
  <tr>
    <td align="left" width="150">纬度</td>
    <td><input type="text" name="lat" class="form-control" value="<?php echo $_businessArea->lat;?>"></td>
  </tr>
  <tr>
    <td align="left" width="150">上级商圈</td>
    <td><select name="parent_id" class="form-control">
    	<option value='0'>无</option>
    	<?php 
    		$select_area_list = $_businessArea->getList();
    		foreach ($select_area_list as $_Area_){
				if($_businessArea->id != $_Area_->id){
					if($_businessArea->parent_id == $_Area_->id){
						echo '<option value="'.$_Area_->id.'" selected>'.$_Area_->name.'</option>';
					}else{
						echo '<option value="'.$_Area_->id.'" >'.$_Area_->name.'</option>';
					}
				}
    		}
    	?>
    </select></td>
  </tr>
  <tr>
    <td align="left" width="150">首字母</td>
    <td><input type="text" name="first_word" class="form-control" value="<?php echo $_businessArea->first_word;?>"></td>
  </tr>
  
</table>
<br>
<br>

</form>
</body>