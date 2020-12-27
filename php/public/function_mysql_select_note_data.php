<?php
if(isset($_POST['select_for_title'])){
    if($_POST['select_for_title']==='false'){
        $doc_sel_tit='';
    }else{
        $doc_sel_tit=',doc_title';
    }
}else{$doc_sel_tit=',doc_title';}
if(isset($_POST['select_for_type'])){
    if($_POST['select_for_type']==='false'){
        $doc_sel_typ='';
    }else{
        $doc_sel_typ=',doc_tag';
    }
}else{$doc_sel_typ=',doc_tag';}
if(isset($_POST['select_for_descir'])){
    if($_POST['select_for_descir']==='false'){
        $doc_sel_desc='';
    }else{
        $doc_sel_desc=',doc_descri';
    }
}else{$doc_sel_desc=',doc_descri';}
if(isset($_POST['select_for_cover'])){
    if($_POST['select_for_cover']==='false'){
        $doc_sel_cov='';
    }else{
        $doc_sel_cov=',doc_img';
    }
}else{$doc_sel_cov=',doc_img';}
if(isset($_POST['select_for_content'])){
    if($_POST['select_for_content']==='false'){
        $doc_sel_con='';
    }else{
        $doc_sel_con=',doc_data';
    }
}else{$doc_sel_con=',doc_data';}
//判断是否为数字
function check_number($str){
    if(preg_match('/^[1-9][0-9]*$/',$str)){
        return true;
    }else{return false;}
}
if(isset($_POST['id'])){
    if(check_number($_POST['id'])){
        $id='doc_id='.$_POST['id'];
    }else{
        exit(false);
    }
}else{
    $id='1=1';
}
require_once('10004.php');
//构造sql
@$sql_c_1="SELECT doc_id,insert_time {$doc_sel_tit} {$doc_sel_typ} {$doc_sel_desc} {$doc_sel_cov} {$doc_sel_con} FROM document_data WHERE {$id} ORDER BY insert_time DESC";

@$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);//连接数据库
if (!$link) {die('error');}//连接失败则退出
@$sql_c=mysqli_query($link,$sql_c_1);
if(mysqli_affected_rows($link)<=0){die(null);}//查询不到结果则退出
$data=mysqli_fetch_all($sql_c,MYSQLI_ASSOC);//从结果集中取得所有行保存为关联数组
mysqli_close($link);//关闭连接
echo json_encode($data);//返回json