﻿<?php 
require_once '../common/constant.php';
require_once '../common/verify_permission.php';
require_once '../model/Line.class.php';
require_once '../model/BandSub.class.php';

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

$_line = new Line();
$datacount = 0;
$line_list = array();
if($key == ''){
	$datacount = $_line->getCount();
	$line_list = $_line->getListByPage($start, $limit);
}else{
	$_line->nam = $key;
	$datacount = $_line->getCountByNam();
	$line_list = $_line->getListByPageAndNam($start, $limit);
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
    </head>
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
              <p><a href="javascript:$('#myModal1').modal('show');" style=" float:right;" class="btn btn-primary">添加新车系</a>
           名称: <input  class="form-control" style="width:320px; display:inline-block;" name="key" placeholder="输入检索内容..." type="text" value="<?php echo $key;?>"> 
            <a class="btn btn-default" href="javascript:document.getElementById('search_form').submit();">搜索</a></p>
            </form>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" id="ul_zy">
              <tr>
            <th width="14%" align="center">名称</th>
            <th width="14%" align="center">子品牌</th>
            <th width="30%" align="center" class="border_ri_no"></th>
          </tr>
              <?php 
    
          	foreach ($line_list as $_line_){
          		echo '<tr class="bottbords">
				            <td align="center">'.$_line_->nam.'</td>
							<td align="center">'.$_line_->band_sub->name.'</td>
				            <td align="center" class="border_ri_no"><a href="#" class="a_css" onClick="edit('.$_line_->id.');">编辑</a>&nbsp;&nbsp;<a href="../pages/line_del.php?id='.$_line_->id.'" class="a_css">删除</a></td>
				          </tr>';
          	}
          ?>
              <form action='' method='post' id='_page'>
            <input type='hidden' name='page' id='_page_v' value='1'/>
            <input type='hidden' name='key' id='_page_key' value='<?php echo $key;?>'/>
          </form>
             
            </table>
             <?php 
 			require_once '../common/page.php';
 		?>
      </div>
        </div>
  </div>
    </div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加新车系</h4>
      </div>
          <form action="line_insert.php" method="post" id="ad_insert" enctype='multipart/form-data'>
        <div class="modal-body" style="overflow:hidden;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="modal-table">
            <tr>
                  <td align="left" width="100">子品牌</td>
                  <td><select name="band_sub_id"class="form-control" style="max-width:400px; overflow:hidden;">
                      <?php 
                            $_band_sub = new BandSub();
                            $band_sub_list = $_band_sub->getList();
                            foreach ($band_sub_list as $_band_sub_){
                                echo '<option value="'.$_band_sub_->id.'">'.$_band_sub_->name.'</option>';
                            }
                        ?>
                    </select></td>
                </tr>
            <tr>
                  <td align="left">名称</td>
                  <td><input type="text" name="nam" class="form-control"></td>
                </tr>
          </table>
            </div>
        <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="submit" class="btn btn-primary">保存</button>
            </div>
      </form>
        </div>
  </div>
    </div>
<div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">编辑</h4>
      </div>
          <div class="modal-body">
        <iframe id="frm" src="" frameborder="no" scrolling="no" style="width:100%; height:100px; overflow:hidden;"></iframe>
      </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" onClick="tj()">保存</button>
      </div>
        </div>
  </div>
    </div>
<?php include 'footer.php'?>
<script>
	function tj(){
		$("#frm").contents().find("#ad_update").submit();	
	}
	function edit(id){
		var h = "line_edit.php?id=" + id;
		$("#frm").attr("src",h);
		$("#myModa2").modal('show');
		//showEditDiv();
	}
    
    </script>
</body>

    </body>
</html>