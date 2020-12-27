<!doctype html>
<!--标签页-->
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的电子笔记</title>
    <link rel="stylesheet" type="text/css" href="css/link-style-1.css"><!--通用的链接CSS样式-->
    <link rel="stylesheet" type="text/css" href="css/interface-pc-1.css"><!--通用的PC-界面样式-->
    <script src="js/vue.js"></script>
    <script src="js/config.js"></script>
    <style>
        /*细节调整*/
        /*左侧内容*/
        .contents_left{width: 100%;min-width: 630px;height: auto;display: inherit;justify-content: right;flex-wrap: wrap;flex-direction: row;}
        .card_box{width: calc(100% - 40px);height: 127px;display: flex;justify-content: center;margin: 20px;background: rgba(255,255,255,1);border-radius: 5px;box-shadow: 1px 1px 10px #e1e1e1;transition: 0.3s}
        .card_box:hover{box-shadow: 1px 1px 10px #aaaaaa;}
        .card_i{width: 200px;height: 128px;display: inherit;justify-content: center;flex-direction: column;align-items: center;}
        .card_img{width: 95%;height: 110px;border-radius:5px;object-fit: cover;}
        .card_des{width: calc(100% - 200px);height: 128px;display: flex;justify-content: center;align-items: center;}
        .card_des_pack{width: 97%;height: 110px;background: rgba(255,255,255,1);overflow-y:hidden;overflow-x: hidden;}
        .small_p{font-size: 14px;}
        .small_margin_p{margin: 6px 0;}
        .card_time{margin: 0;font-size: 13px;}
        /*动画*/
        @keyframes hit_button_type_1 {
            0%{background: rgba(255,255,255,1)}
            50%{background: rgb(220, 220, 220)}
            100%{background: rgba(255,255,255,1)}
        }
        /*tag_列表*/
        .tag_list{width: 50%}
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
        <div class="contents_left" id="note_card">
            <!--单一标签组-->
            <div class="tag_list" v-for="list in note_da">
                <!--标签名-->
                <div class="tag_head">
                    {{list.tag}}
                </div>
                <div class="tag_body" v-for="da in list.data">
                    <a  :href="'http://'+ServerNetworkAddress+'/doc.php?id='+da.doc_id" target="_blank" style="color: black;text-decoration: none;width: 50%">
                        <div class="card_box" :id="da.doc_id">
<!--                     图像区域-->
                            <div class="card_i">
                                <img alt="图标" :src="da.doc_img" class="card_img">
                            </div>
<!--                     描述区域-->
                            <div class="card_des">
                                <div class="card_des_pack">
<!--                    标签-->
                                    <div class="small_p">{{da.doc_tag}}</div>
                                    <b>{{da.doc_title}}</b>
                                    <p class="small_p small_margin_p">{{da.doc_descri}}</p>
                                    <p class="card_time">发表于{{da.insert_time}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="command" style="opacity:0;width:1px;height:1px;outline: none;border:none;margin:0;padding:0;" type="text">
<!--自适应-->
<script>
    var added_hover_menu=true;
    var menu_list=document.getElementById('menu_list');
    var contents=document.getElementById('contents');
    var message=document.getElementById('message');
    var node_title=document.querySelector('.node_title');
    var new_doc=document.querySelector('.new_doc');
    var command=document.querySelector('#command');
    /*vue*/
    var new_app=new Vue({
        el:'#note_card',
        data:{
            note_da:[]
        }
    });
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
    /*跳转至文章*/
    function skip(doc_id) {
        window.open('http://'+ServerNetworkAddress+'/doc.php?id='+doc_id);
    }
    /*点击按钮发生的动画*/
    function button_animation(el) {
        el.style.animation='hit_button_type_1 0.25s';
        setTimeout(function () {
            el.removeAttribute("style");
        },250)
    }
    /*获取数据*/
    function get_card_data() {
        let new_ajax=new XMLHttpRequest();
        new_ajax.open('POST','http://'+ServerNetworkAddress+'/php/public/function_mysql_select_note_data.php');
        new_ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        new_ajax.send('select_for_content=false');
        new_ajax.onreadystatechange=function(){
            if(new_ajax.readyState===4 && new_ajax.status===200){
                let datas=eval(new_ajax.responseText);
                new_app.note_da=extract_tag(datas);
            }
        }
    }
    get_card_data();
    /*将数据分类*/
    function extract_tag(data) {
        let leng=data.length;
        let tag_list=[];
        let obj=[];
        for(let k=0;k<leng;k++){
            let this_tag=data[k].doc_tag.split(',');
            let this_leng=this_tag.length;
            for(let x=0;x<this_leng;x++){
                if(!tag_list.includes(this_tag[x])){
                    tag_list.push(this_tag[x]);
                    obj.push({tag:''+this_tag[x],data:[]});
                }
                let obj_leng=obj.length;
                for(let y=0;y<obj_leng;y++){
                    if(obj[y].tag===this_tag[x]){
                        obj[y].data.push(data[k]);
                    }
                }
            }
        }
        return obj;
    }
</script>
</body>
</html>
