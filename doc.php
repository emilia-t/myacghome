<?php
function check_number($str){if(preg_match('/^[1-9][0-9]*$/',$str)){return true;}else{return false;}}
isset($_GET['id']) ? (check_number($_GET['id']) ? $id=$_GET['id'] : exit(false)) : exit(false);
?>
<!doctype html>
<!--文章页面-->
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>善用环境变量</title>
    <link rel="stylesheet" type="text/css" href="css/code_style.css"><!--代码高亮样式-->
    <link rel="stylesheet" type="text/css" href="css/link-style-1.css"><!--通用的链接CSS样式-->
    <link rel="stylesheet" type="text/css" href="css/interface-pc-1.css"><!--通用的PC-界面样式-->
    <script src="http://cdn.bootcss.com/highlight.js/10.4.1/highlight.min.js"></script>
    <script src="js/vue.js"></script>
    <script src="js/config.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <style>
        .contents_left_pa{width: 72%;min-width: 630px;height: auto;display: inherit;justify-content: center;}
        .contents_left{width: 95%;min-width: 630px;height: auto;display: inherit;justify-content: center;flex-wrap: wrap;flex-direction: row;align-items: center;background: white;border-radius: 5px;box-shadow: 1px 1px 10px #e1e1e1;transition: 0.3s}
        .contents_left:last-child{margin: 0 0 40px 0}
        .contents_left:hover{box-shadow: 1px 1px 10px #828282;}
        .contents_left_a{width: 95%;height: auto}
        .contents_left_b{width: 95%;}
        /*文章样式*/
        .doc_title{margin: 8px 0;width:95%;font-size: 32px;font-weight: bold;text-shadow: 1px 1px 10px #d7d7d7;letter-spacing: 1px}
        .doc_time{font-size: 12px;text-align: center;}
        .doc_text{width: 95%;font-size: 16px;line-height: 24px;text-shadow: 1px 1px 10px #d7d7d7;letter-spacing: 1px;margin: 10px 0}
        .doc_img{width: 100%;margin: 16px 0}
        .contents_left img{width: 100%;max-height:1080px;border-radius: 5px;box-shadow: 1px 1px 10px #e1e1e1;transition: 0.3s}
        .doc_img img:hover{box-shadow: 1px 1px 10px #828282;}
        .doc_code{width: 95%;border-radius: 5px}
        .small_p {font-size: 14px;}
        /*动画*/
        @keyframes hit_button_type_1 {
            0%{background: rgba(255,255,255,1)}
            50%{background: rgb(220, 220, 220)}
            100%{background: rgba(255,255,255,1)}
        }
    </style>
</head>
<body>
<!--背景-->
<div id="background"></div>
<!--顶部菜单区-->
<div id="menu">
    <div class="head_div">
        <img alt="头像" src="http://q.qlogo.cn/g?b=qq&nk=1658548955&s=640&mType=friendlist" class="head_picture">
    </div>
    <div class="head_p">
        <div onclick="copy_p(this.childNodes[2])">
            <a style="color: #2d2d2d;text-decoration:none;" onclick="javascript:void(0)" title="点击复制">邮箱 : </a><a onclick="copy_p(this)" href="mailto:1658548955@qq.com" title="打开邮箱">1658548955@qq.com</a>
        </div>
        <div onclick="copy_p(this.childNodes[2])">
            <a style="color: #2d2d2d;text-decoration:none;" onclick="javascript:void(0)" title="点击复制">Bilibili : </a><a onclick="copy_p(this)" href="https://space.bilibili.com/93751335" title="跳转B站" target="_blank">临冉</a>
        </div>
    </div>
    <div id="menu_list">
        <img src="img/icons/log.png" class="log_img">
        <div class="block_out" onclick="button_animation(this);window.location.href='http://'+ServerNetworkAddress">
            <div class="block_in">
                全部文章
            </div>
        </div>
        <div class="block_out" onclick="button_animation(this);window.location.href='http://'+ServerNetworkAddress+'/tag.php'">
            <div class="block_in">
                标签分类
            </div>
        </div>
        <div class="block_out" onclick="button_animation(this);window.location.href='http://'+ServerNetworkAddress+'/about.html'">
            <div class="block_in">
                关于自己
            </div>
        </div>
        <div class="block_out">
            <div class="block_in">
                <input title="搜索文章" type="text" class="input_search" placeholder=" 请输入关键字">
            </div>
        </div>
        <img alt="图标" src="img/icons/sousuo.gif" class="search_icon">
    </div>
</div>
<!--左侧文章内容区--卡片--显示标题、标签-->
<div id="contents">
    <!--    第二层内包装-->
    <div class="contents_pa">
        <!--第三层左侧包装-->
        <div class="contents_left_pa" id="note_content">
            <div class="contents_left">
                <!--标题-->
                <div class="contents_left_a">
                    <div class="small_p" v-html="note_da[0].doc_tag"></div>
                    <div class="doc_title" v-html="note_da[0].doc_title"></div>
                    <div class="doc_time" v-html="note_da[0].insert_time"></div>
                </div>
                <!--内容-->
                <div class="contents_left_b"  v-html="note_da[0].doc_data">

                </div>
            </div>
        </div>
        <!--第三层右侧包装-->
        <div class="contents_right">
            <div id="message">
                <!--博客信息区域，显示博客文章数量，点赞数量，头像，印象图片，hr，格言-->
                <div class="message_box">
                    <img alt="印象图片" src="img/other/love_manga_1.jpg" class="message_manga">
                    <!--头像和博客数据-->
                    <div class="message_head_data">
                        <img alt="头像" src="http://q.qlogo.cn/g?b=qq&nk=1658548955&s=640&mType=friendlist" class="head_picture_2">
                        <!--博客数据-->
                        <div class="message_data">
                            <div id="doc_number">文章 : 50</div>
                            <div></div>
                            <div id="doc_like_num">点赞 : 128</div>
                        </div>
                    </div>
                    <div class="motto">
                        <b class="message_name">临冉 · SophieTwilight</b>
                        <i class="message_name">我们的征途，是星辰大海！</i>
                    </div>
                </div>
            </div>
            <div class="node_title">
                推荐文章
            </div>
            <div class="new_doc">
                <div class="new_doc_pac">
                    <div><a>善用环境变量，快速启动应用软件</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="command" style="opacity:0;width:1px;height:1px;outline: none;border:none;margin:0;padding:0;" type="text">
<script>
    var added_hover_menu=true;
    var menu_list=document.getElementById('menu_list');
    var contents=document.getElementById('contents');
    var message=document.getElementById('message');
    var node_title=document.querySelector('.node_title');
    var new_doc=document.querySelector('.new_doc');
    var command=document.querySelector('#command');
    <?php echo 'var doc_id_d='.$id.';'?>
    /*拷贝信息*/
    function copy_p(el) {
        command.value=el.innerText;
        command.select();
        document.execCommand('copy');
        alert('复制成功');
    }
    /*监听页面滚动*/
    window.onscroll=function () {
        let position=contents.getClientRects();
        if(position[0].top<10){
            if(added_hover_menu){hover_menu();}
        }
        if(position[0].top<10){
            hover_right();
        }else {
            undo_hover_right()
        }
    };
    /*设置动画*/
    function add_frames_hover_menu(top) {
        let style1=document.createElement('style');
        style1.innerHTML='@keyframes hover_menu {from{top:'+top+'}to{top:0}}';
        document.head.appendChild(style1);
    }
    /*悬浮菜单*/
    function hover_menu() {
        let top_first_value=menu_list.offsetHeight;
        if(added_hover_menu){add_frames_hover_menu(top_first_value);added_hover_menu=false}
        menu_list.style.position='fixed';
        menu_list.style.top='-'+top_first_value+'px';
        menu_list.style.animation='hover_menu 1s forwards';
        document.querySelector('.head_picture').style.marginTop='55px'
    }
    /*悬浮右侧*/
    function hover_right() {
        let menu_list_height=56;
        let margin=40;
        message.style.position='fixed';
        message.style.top=menu_list_height+'px';
        node_title.style.position='fixed';
        node_title.style.top=message.offsetHeight+menu_list_height+'px';
        new_doc.style.position='fixed';
        new_doc.style.top=node_title.offsetHeight+message.offsetHeight+menu_list_height+margin+'px';
    }
    /*不悬浮右侧*/
    function undo_hover_right() {
        message.removeAttribute('style');
        node_title.removeAttribute('style');
        new_doc.removeAttribute('style');
    }
    /*点击按钮发生的动画*/
    function button_animation(el) {
        el.style.animation='hit_button_type_1 0.25s';
        setTimeout(function () {
            el.removeAttribute("style");
        },250)
    }
    /*创建vue*/
    var new_app=new Vue({
        el:'#note_content',
        data:{
            note_da:[]
        }
    });
    /*获取数据*/
    function get_content_data() {
        let new_ajax=new XMLHttpRequest();
        new_ajax.open('POST','http://'+ServerNetworkAddress+'/php/public/function_mysql_select_note_data.php');
        new_ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        new_ajax.send('id='+doc_id_d+'&select_for_descir=false&select_for_cover=false');
        new_ajax.onreadystatechange=function(){
            if(new_ajax.readyState===4 && new_ajax.status===200){
                console.log(new_ajax.responseText);
                let datas=new_ajax.responseText;
                new_app.note_da=eval(datas);
            }
        }
    }
    get_content_data();
</script>
</body>
</html>
