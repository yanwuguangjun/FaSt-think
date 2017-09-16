<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/mnt/hgfs/html/getamaster/application/index/view/article/show_article.html";i:1503983700;s:67:"/mnt/hgfs/html/getamaster/application/index/view/common/header.html";i:1503983700;s:74:"/mnt/hgfs/html/getamaster/application/index/view/common/morosely_face.html";i:1503983700;}*/ ?>
<html wp-site wp-site-is-master-page>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://plugins.krajee.com/assets/6facb0ab/css/fileinput.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.8/js/fileinput.min.js"></script>
    <script type="text/javascript" src="http://plugins.krajee.com/assets/6facb0ab/js/locales/zh.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.0/sweetalert2.min.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/plugins/char_counter.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/plugins/emoticons.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.0/sweetalert2.min.css"/>
    <link href="http://www.getamaster.com/public/static/index/css/paper-dashboard.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><img height="20" alt="Brand"
                                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAAA81BMVEX///9VPnxWPXxWPXxWPXxWPXxWPXxWPXz///9hSYT6+vuFc6BXPn37+vz8+/z9/f2LeqWMe6aOfqiTg6uXiK5bQ4BZQX9iS4VdRYFdRYJfSINuWI5vWY9xXJF0YJR3Y5Z4ZZd5ZZd6Z5h9apq0qcW1qsW1q8a6sMqpnLyrn76tocCvpMGwpMJoUoprVYxeRoJjS4abjLGilLemmbrDutDFvdLPx9nX0eDa1OLb1uPd1+Td2OXe2eXh3Ofj3+nk4Orl4evp5u7u7PLv7fPx7/T08vb08/f19Pf29Pj39vn6+fuEcZ9YP35aQn/8/P1ZQH5fR4PINAOdAAAAB3RSTlMAIWWOw/P002ipnAAAAPhJREFUeF6NldWOhEAUBRvtRsfdfd3d3e3/v2ZPmGSWZNPDqScqqaSBSy4CGJbtSi2ubRkiwXRkBo6ZdJIApeEwoWMIS1JYwuZCW7hc6ApJkgrr+T/eW1V9uKXS5I5GXAjW2VAV9KFfSfgJpk+w4yXhwoqwl5AIGwp4RPgdK3XNHD2ETYiwe6nUa18f5jYSxle4vulw7/EtoCdzvqkPv3bn7M0eYbc7xFPXzqCrRCgH0Hsm/IjgTSb04W0i7EGjz+xw+wR6oZ1MnJ9TWrtToEx+4QfcZJ5X6tnhw+nhvqebdVhZUJX/oFcKvaTotUcvUnY188ue/n38AunzPPE8yg7bAAAAAElFTkSuQmCC"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
            <ul id="header" class="nav navbar-left navbar-nav">
                <li>
                    <a href="<?php echo url('index/index/index'); ?>">首页</a>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        领养<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="">
                            <a href="<?php echo url('index/adopt/adopt_list'); ?>">领养</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="">
                            <a href="<?php echo url('index/index/lost_list'); ?>">丢失</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="<?php echo url('index/index/ordinary'); ?>">文章</a>
                </li>
                <li class="">
                    <a href="<?php echo url('index/index/activity_list'); ?>">活动</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(session('moroselyId')): ?>

                    <div class="navbar-header">


                        <li role="presentation" class="dropdown">
                            <a class="navbar-brand dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                               aria-expanded="false">
                                <img class="img-circle" style="height: 30px;width: 30px;" alt="Brand" src="<?php if(session('moroselyPic')): ?>__MOROSELY_THUMB_PIC__<?php echo session('moroselyPic'); endif; ?>">
                            </a>
                            <ul class="dropdown-menu">
                                <li class="">
                                    <a href="<?php echo url('index/morosely/show_personalData'); ?>">个人资料</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li class="">
                                    <a href="<?php echo url('index/morosely/my_adopt'); ?>">我的领养</a>
                                </li>
                                <li class="">
                                    <a href="<?php echo url('index/morosely/modify_true_name'); ?>">实名认证</a>
                                </li>
                                <li class="">
                                    <a href="<?php echo url('index/ublog/add_article'); ?>">发布文章</a>
                                </li>
                                <li class="">
                                    <a href="<?php echo url('index/activity/promotional_activity'); ?>">发起活动</a>
                                </li>
                                <li class="">
                                    <a href="<?php echo url('index/morosely/quite'); ?>">退出登录</a>
                                </li>

                            </ul>
                        </li>
                    </div>
                    <?php else: ?>
                    <li>
                        <a href="<?php echo url('index/login/morosely_login'); ?>">登陆</a>
                    </li>
                    <li>
                        <a href="<?php echo url('index/login/morosely_register'); ?>">注册</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<script>
    $(function () {
        var url = location.pathname;

        var team = {
            lost:'lost_list',
            article:'ordinary',
            add_lost:'add_lost',
            adopt:'adopt_list',
            add_adopt:'add_adopt',
            activity:'index/index/activity_list',
            promotional_activity:'promotional_activity',
            blog:'blog_list',
            index:'index/index/index'
        };
        function getCode() {
            for (x in team){
                if (team[x]== url.match(team[x])){
                    return team[x];
                }
            }
        };

        switch (getCode()){
            case team.index:
                $('#header>li').eq(0).addClass('active');
                break;

            case team.adopt:
                $('#header>li').eq(1).addClass('active');
                break;
            case team.add_adopt:
                $('#header>li').eq(1).addClass('active');
                break;
            case team.lost:
                $('#header>li').eq(1).addClass('active');
                break;
            case team.add_lost:
                $('#header>li').eq(1).addClass('active');
                break;
            case team.blog:
                $('#header>li').eq(2).addClass('active');
                break;
            case team.article:
                $('#header>li').eq(2).addClass('active');
                break;
            case team.activity:
                $('#header>li').eq(3).addClass('active');
                break;
            case team.promotional_activity:
                $('#header>li').eq(3).addClass('active');
                break;
            default:
//                $('#header>li').eq(0).addClass('active');
                break;
        }
    })

</script>


<div class="container">
    <div class="section">
        <div class="row">
            <div class="col-md-9">
                <div class="row article_warp">
                    <h2><?php echo $blog['title']; ?></h2>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo url('index/index/index'); ?>">首页</a>
                        </li>
                        <li>
                            <a href="#">最新</a>
                        </li>
                        <li class="active"><?php echo $blog['title']; ?></li>
                    </ul>
                    <div class="embed-responsive embed-responsive-16by9">
                        <div class="fr-element fr-view" dir="ltr" aria-disabled="false"
                             style="min-height: 400px;" spellcheck="true">
                            <?php echo $blog['content']; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <a href="javascript:void(0)" id="like" onclick="like(<?php echo $blog['id']; ?>)" style="color: rgb(138,138,138);">
                                <i class="fa fa-heart fa-3x success" aria-hidden="true"></i>
                            </a>

                        </div>
                        <div class="col-md-4">
                            <h3>Column title</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <h3>Column title</h3>
                        </div>
                        <div class="col-md-4">
                            <h3>Column title</h3>
                        </div>
                        <div class="col-md-4">
                            <h3>Column title</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="margin-bottom:40px;">
                            <form role="form" id="comment">
                                <div class="form-group">
                                    <textarea class="form-control" rows="12" name="content"
                                              style="max-width:910px;max-height:200px;">

                                    </textarea>
                                    <input type="hidden" name="articleId" value="<?php echo $blog['id']; ?>">
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="comment()" class="btn btn-success pull-right">评论
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="section col-md-12 col-sm-12 col-xs-12 pad25" id="comment_list">
                        <?php if(is_array($comments) || $comments instanceof \think\Collection): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 pad25 fr-element fr-view">
                                    <div class="row" style="margin-bottom:20px;">
                                        <div class="col-xs-2 col-md-2 clearfix">
                                            <img class="img-circle" src="__MOROSELY_THUMB_PIC__<?php echo $comment['pic']; ?>" height="60"
                                                 width="60" style="margin-top:20px;margin-left: 30px;"/>
                                        </div>
                                        <div class="col-xs-10">
                                            <a href=""><h5><?php echo $comment['moroselyName']; ?></h5></a>
                                            <p>
                                                <?php if($comment['CTMoroselyName']): ?>
                                                    @<?php echo $comment['CTMoroselyName']; endif; ?>
                                                <?php echo $comment['content']; ?>
                                            </p>
                                            <a class="rep" style="margin-right:20px;"
                                               onclick="reply(<?php echo $comment['moroselyId']; ?>,'<?php echo $comment['moroselyName']; ?>',<?php echo $comment['id']; ?>,<?php echo $comment['articleId']; ?>)"
                                               href="javascript:void(0);">
                                                <span class="glyphicon glyphicon-thumbs-up text-center">回复</span></a>
                                            <a style="margin-right:20px;">
                                                <span class="glyphiconglyphicon-thumbs-up text-center">回复</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <div class="row">
                            <?php echo $page; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!--个人资料小卡片-->
<div class="card card-user">
    <div class="image">
        <img src="https://ununsplash.imgix.net/photo-1421098518790-5a14be02b243?w=1024&amp;q=50&amp;fm=jpg&amp;s=24665881d66f79925810c2deb7e486b9" alt="">
    </div>
    <div class="content">
        <div class="author">
            <img class="avatar border-white" src="__MOROSELY_THUMB_PIC__<?php echo $morosely['pic']; ?>" alt="">
            <h4 class="title"><?php echo $morosely['username']; ?><br>
                <a href="#"><small><?php echo $morosely['company']; ?></small></a>
            </h4>
        </div>
        <p class="description text-center">
            "<?php echo $morosely['maxim']; ?>"
        </p>
    </div>
    <hr>
    <div class="text-center">
        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <h5>12<br><small>Files</small></h5>
            </div>
            <div class="col-md-4">
                <h5>2GB<br><small>Used</small></h5>
            </div>
            <div class="col-md-3">
                <h5>24,6$<br><small>Spent</small></h5>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/js/froala_editor.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/js/languages/zh_cn.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/js/plugins/emoticons.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/js/plugins/char_counter.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<script>
    function floaraEd() {
        $('textarea').froalaEditor({
            toolbarButtons: ['fontFamily', 'emoticons'],
            toolbarButtonsMD: ['fontFamily', 'emoticons'],   //在大屏幕上显示内容
            toolbarButtonsSM: ['fontFamily', 'emoticons'],   //在中等屏幕上显示按钮
            toolbarButtonsXS: ['fontFamily', 'emoticons'],   //在小屏幕上显示按钮
            charCounterCount: true,    //计数器
            charCounterMax: 140,      //最大字数 -1 为不限制 默认不限制
            tooltips: true,
            pluginsEnabled: null,
            language: 'zh_cn',
            heightMin: 120
        });
        $('.fr-wrapper').next().remove();                   //简易破解富文本插件
    }
</script>
<script>
    $(function () {
        floaraEd();   //floara  编辑器
        if ($.cookie('love_' + <?php echo $blog['id']; ?>) ==1){  //设置点赞样式
            $('#like').css('color', '#ff5b62');
        }
    });


    //todo 下面这段代码不兼容ie  你后面想办法把！
    function reply(moroselyId, moroselyName, comment_id, articleId) {
        var obj = document.activeElement;
        var reply_document = '<div class="col-xs-2"></div><div class="col-xs-10 pull-right fr-element fr-view">' +
            '<form role="form" id="reply_form">' +
            '<div class="form-group">' +
            '<textarea class="form-control input-sm" name="content" rows="10" style="max-width:730px;max-height:120px;">' +
            '</textarea>' +
            '<input type="hidden" name="articleId" value=' + articleId + '>' +
            '<input type="hidden" name="CTMoroselyId" value=' + moroselyId + '>' +
            '<input type="hidden" name="CTMoroselyName" value=' + moroselyName + '>' +
            '<input type="hidden" name="commentId" value=' + comment_id + '>' +
            '</div>' + '<div class="form-group">' +
            '<button type="button" onclick="reply_it()" class="btn btn-default pull-right clearfix">回复' +
            '</button>' + '</div>' + '</form></div>';
        var rep = document.createElement('div');
        if (document.getElementById('reply')) {
            document.getElementById('reply').remove();
        }
        rep.id = 'reply';
        rep.className = 'row';
        rep.innerHTML = reply_document;
//        $(this).parent().parent().after(reply_document);
//        alert('demo');

        obj.parentNode.parentNode.after(rep);
        floaraEd();
    }
    function comment() {
        $.post("<?php echo url('index/ublog/add_comment'); ?>",
            $('#comment').serializeArray(),
            function (data, status) {
                if (status == 'success') {
                    create_comment_element(data);
                    document.getElementById('comment').reset();
                }
            }
        );
    }
    function reply_it() {
        $.post("<?php echo url('index/ublog/reply_comment'); ?>",
            $("#reply_form").serializeArray(),
            function (data, status) {
                if (status == 'success') {
                    document.getElementById('reply').remove();
                    create_comment_element(data);
                }
            }
        );
    }
    function create_comment_element(data) {
        if (data.CTMoroselyName) {
            var come_to_morosely_name = '@' + data.CTMoroselyName;
        }else {
            var come_to_morosely_name = "";
        }
        var comment_document = '<div class="row">' +
            '<div class="col-md-12 col-sm-12 col-xs-12 pad25 fr-element fr-view">' +
            '<div class="row" style = "margin-bottom:20px;" >' +
            '<div class="col-xs-2 col-md-2 clearfix"><img class="img-circle" src="__MOROSELY_THUMB_PIC__' + data.moroselyPic +
            '" height="100" width="100" style="margin-top:5px;"/>' +
            '</div>' +
            '<div class="col-xs-10">' +
            '<a href=""><h4>' + data.moroselyName +
            '</h4></a>' +
            '<p>' + come_to_morosely_name + data.content + '</p>' +
            '<a style="margin-right:20px;" onclick ="reply(' +
            data.moroselyId + ',' + "'" +
            data.moroselyName + "'" + ',' +
            data.id + ',' +
            data.articleId +
            ')" href="javascript:void(0);">' +
            '<span class="glyphicon glyphicon-thumbs-up text-center">回复</span></a>' +
            '<a style="margin-right:20px;">' +
            '<span class="glyphiconglyphicon-thumbs-up text-center" >回复</span></a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
        $("#comment_list").prepend(comment_document);
        swal('评论成功!', '', 'success');
    }

    function like(id) {
        if ($.cookie('love_' + id) != 1) {
            $.post(
                "<?php echo url('index/ublog/like'); ?>",
                {id: id},
                function (data, status) {
                    if (data.msg == '点赞成功！') {
                        $('#like').css('color', '#ff5b62');
                        $.cookie('love_' + id, 1, {expires: 365});
                        swal('赞的好！!', '', 'success');
                    }
                }
            );
        } else {
            swal('你已经赞过了哦!', '', 'error');
        }

    }
</script>
</body>
</html>