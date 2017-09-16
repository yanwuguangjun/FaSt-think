<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"/mnt/hgfs/html/getamaster/application/index/view/morosely/search_personalData.html";i:1503983700;s:67:"/mnt/hgfs/html/getamaster/application/index/view/common/header.html";i:1503983700;s:67:"/mnt/hgfs/html/getamaster/application/index/view/common/footer.html";i:1503983700;}*/ ?>
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


    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.0/sweetalert2.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet" type="text/css"/>


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
                <div class="row article_warp card">
                    <div>
                        <div class="header">
                            <h4 class="title">个人资料</h4>
                        </div>
                        <div class="content" style="margin-top:30px;padding-left: 60px;min-height: 600px;">
                            <div class="row clearfix">
                                <div class="col-lg-2">
                                    <a href="<?php echo url('index/morosely/modify_personal_image'); ?>" title="点击修改头像">
                                        <img src="__MOROSELY_THUMB_PIC__<?php if($morosely->pic) echo $morosely->pic; ?>"
                                             style="width: 100px;" alt="">
                                    </a>
                                </div>
                                <div class="col-lg-offset-6" style="padding-left: 15px;margin-top: 10px;">
                                    <p>姓名：<?php echo $morosely['trueName']; ?><a href="<?php echo url('index/morosely/modify_true_name'); ?>">
                                        <?php if(!$morosely_self): if(!$trueNameCheck): ?>该用户尚未实名认证<?php endif; else: if(!$trueNameCheck): ?>
                                                <a href="">信息未完善，点击完善实名信息。</a>
                                            <?php endif; endif; ?>
                                    </a></p>
                                    <p>昵称：<?php echo $morosely['username']; ?></p>
                                    <p>年龄：<?php echo $morosely['birthday']; ?></p>
                                </div>
                            </div>
                            <div class="row" style="margin-top:30px;">
                                <div class="col-lg-6">
                                    <p>邮箱：<?php echo $morosely['address']; ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <p>城市：<?php echo $morosely['city']; ?></p>
                                </div>
                            </div>
                            <div class="row" style="margin-top:30px;">
                                <div class="col-lg-12">
                                    <p>公司：<?php echo $morosely['company']; ?></p>
                                </div>
                            </div>
                            <div class="row" style="margin-top:30px;">
                                <div class="col-lg-12">
                                    <p>格言：<?php echo $morosely['maxim']; ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <include file="common/moro sely_face"/>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"
        integrity="sha384-tIwI8+qJdZBtYYCKwRkjxBGQVZS3gGozr3CtI+5JF/oL1JmPEHzCEnIKbDbLTCer"
        crossorigin="anonymous"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.0/sweetalert2.min.js"></script>
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
    function go_modify_img() {
        self.location = "<?php echo url('index/morosely/modify_personal_image'); ?>";
    }
    function put() {
        $('form').ajaxForm({
            dataType: 'json',
            success: function (data) {
                if (data.id) {
                    swal('保存照片成功!', '', 'success');
                }
            }
        });
        $('form').submit();
    }
</script>
<footer class="section section-success section-black">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 txt-white1">
                <h1>Footer header</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisici elit,
                    <br>sed eiusmod tempor incidunt ut labore et dolore magna aliqua.
                    <br>Ut enim ad minim veniam, quis nostrud</p>
            </div>
            <div class="col-sm-6">
                <p class="text-info text-right">
                    <br>
                    <br>
                </p>
                <div class="row">
                    <div class="col-md-12 hidden-lg hidden-md hidden-sm text-left">
                        <a href="#"><i class="fa fa-3x fa-fw fa-instagram text-inverse"></i></a>
                        <a href="#"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a>
                        <a href="#"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a>
                        <a href="#"><i class="fa fa-3x fa-fw fa-github text-inverse"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 hidden-xs text-right">
                        <a href="#"><i class="fa fa-3x fa-fw fa-instagram text-inverse"></i></a>
                        <a href="#"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a>
                        <a href="#"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a>
                        <a href="#"><i class="fa fa-3x fa-fw fa-github text-inverse"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
