<?php 
require_once '../common/constant.php';
require_once '../common/verify_permission.php';
require_once '../model/Out.class.php';

$page = 1;

if(isset($_POST['page'])){
	$page = intval($_POST['page']);
}

$start = ($page - 1) * PAGE_COUNT;
$limit = PAGE_COUNT;

$key = '';
if(isset($_POST['key'])){
	$key = $_POST['key'];
}

$_out = new Out();
$datacount = 0;
$out_list = array();
if($key == ''){
	$datacount = $_out->getCount();
	$out_list = $_out->getListByPage($start, $limit);
}else{
	$_out->bank_no = $key;
	$datacount = $_out->getCountByKey();
	$out_list = $_out->getListByPageAndKey($start, $limit);
}

?>
<!DOCTYPE html>
<html lang="utf-8">
    <head>
    <?php include 'head.php'?>
    <style>
.modal-table td {
	padding: 6px 12px;
}
</style>
<link rel="stylesheet" type="text/css" href="css/date.css"/>

    </head>
    <body>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
    <div class="navbar-header"> <a class="navbar-brand" href="#">易配购后台维护系统</a> </div>
  </div>
    </nav>
<div class="container-fluid">
      <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
          <?php include 'menu.php'?>
        </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> <br>
          <div class="table-responsive">
          <form action="" method="post" id="search_form">
            <p>卡号: <input  class="form-control" style="width:320px; display:inline-block;" name="key" placeholder="输入检索内容..." type="text" value="<?php echo $key;?>">
           
              <a class="btn btn-default" href="javascript:document.getElementById('search_form').submit();">搜索</a></p>
             </form>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" id="ul_zy">
              <tr>
            <th align="center">用户</th>
            <th align="center">银行名称</th>
            <th align="center">开户行所在地</th>
            <th align="center">卡号</th>
            <th align="center">开户名称</th>
            <th align="center">额度</th>
            <th align="center">申请时间</th>
            <th align="center">状态</th>
            <th width="6%" align="center"></th>
          </tr>
          <?php 
          	foreach ($out_list as $_out_){
          		echo '<tr>
			            <td align="center">'.$_out_->user->nam.'</td>
			            <td align="center">'.$_out_->bank_name.'</td>
			            <td align="center">'.$_out_->bank_address.'</td>
			            <td align="center">'.$_out_->bank_no.'</td>
			            <td align="center">'.$_out_->bank_user.'</td>
						<td align="center">'.$_out_->price.'</td>
						<td align="center">'.$_out_->request_time.'</td>
						<td align="center">';
          		if($_out_->status == 1){
          			echo '已提现';
          		}else{
          			echo '未处理';
          		}
				echo '</td>
			            <td align="center">';
				if($_out_->status == 0){
					echo '<a href="../pages/out_success.php?out_id='.$_out_->id.'">提现成功</a>';
				}
			    echo '</td>
			          </tr>';
          	}
          ?>
              <form action='' method='post' id='_page'>
            <input type='hidden' name='page' id='_page_v' value='1'/>
            <input type='hidden' name='key' id='_page_key' value='<?php echo $key;?>'/>
          </form>
            </table>
            <!--<a href="javascript:void(0);" class="btn btn-primary">提现成功</a>-->
        <?php 
 			require_once '../common/page.php';
 		?>
      </div>
        </div>
  </div>
    </div>


<!--<div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">编辑</h4>
                  </div>
                  <div class="modal-body">
                    <iframe id="frm" src="" frameborder="no" scrolling="no" style="width:100%; height:320px; overflow:hidden;"></iframe>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onClick="tj()">保存</button>
                  </div>
                </div>
              </div>
            </div>-->
<?php include 'footer.php'?>
<script>

	function tj(){
		$("#frm").contents().find("#ad_update").submit();	
	}
	function edit(id){
		var h = "parttype_edit.php?id=" + id;
		$("#frm").attr("src",h);
		$("#myModa2").modal('show');
		//showEditDiv();
	}

    </script>
</body>
</html>