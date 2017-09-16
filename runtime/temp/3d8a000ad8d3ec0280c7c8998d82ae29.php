<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/mnt/hgfs/html/getamaster/application/index/view/article/ordinary.html";i:1500989996;s:67:"/mnt/hgfs/html/getamaster/application/index/view/common/header.html";i:1500989996;s:67:"/mnt/hgfs/html/getamaster/application/index/view/common/footer.html";i:1500989996;}*/ ?>
<html>
<head>
    <meta name="keywords" content="免费领养  免费领养小狗 免费领养小猫">
    <meta name="description" content="中国第一个小动物公益网站">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          type="text/css">
    <link href="http://www.getamaster.com/public/static/index/css/demo.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#eff3f5">
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

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h4>精彩文章</h4>
            </div>
        </div>
        <div class="row">
            <?php if(is_array($blog) || $blog instanceof \think\Collection): $i = 0; $__LIST__ = $blog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blog): $mod = ($i % 2 );++$i;?>
                <div class="col-md-3 ar-warp">
                    <div class="" style="overflow: hidden;">
                        <a href="<?php echo url('index/index/show_article'); ?>?id=<?php echo $blog['blogId']; ?>">
                            <img  class="auto_resp" src="<?php if($blog['faceImage']): ?>__FACE_THUMB_IMAGE__<?php echo $blog['faceImage']; endif; ?>"
                                 style="max-height: 160px;width: 262px;" class="img-responsive">
                        </a>
                        <h5>
                            <span class="label label-default">New</span><?php echo $blog['title']; ?></h5>
                        <ul class="media-list">
                            <li class="media" style="margin-top: 5px;">
                                <a class="pull-left" href="<?php echo url('index/morosely/search_personalData'); ?>?id=<?php echo $blog['moroselyId']; ?>">
                                    <img class="img-circle media-object img-responsive" src="__MOROSELY_THUMB_PIC__<?php echo $blog['pic']; ?>"
                                         style="height: 25px;width: 25px;"   height="25" width="25"></a>
                                <div class="media-body">
                                    <a href="<?php echo url('index/morosely/search_personalData'); ?>?id=<?php echo $blog['id']; ?>">
                                        <p style="line-height: 25px;font-size: 14px;"><?php echo $blog['username']; ?>

                                            <a href="<?php echo url('index/index/show_article'); ?>?id=<?php echo $blog['id']; ?>" class="btn btn-info btn-xs pull-right"  style="margin-left: 4px;line-height: 25px;margin-top: 4px;"><i class="fa fa-fw fa-thumbs-up"></i><span
                                                    class="badge"><?php echo $blog['love']; ?></span></a>
                                            <a href="<?php echo url('index/index/show_article'); ?>?id=<?php echo $blog['id']; ?>" class="btn btn-info btn-xs pull-right"  style="margin-left: 4px;line-height: 25px;margin-top: 4px;"><i class="fa fa-fw fa-comments"></i><span
                                                    class="badge"><?php echo $blog['see']; ?></span></a>
                                            <!--<a href="<?php echo url('index/index/show_article'); ?>?id=<?php echo $blog['id']; ?>" class="btn btn-info btn-xs pull-right" style="margin-left: 4px;line-height: 25px;margin-top: 4px;"><i class="fa fa-fw s fa-weibo"></i><span-->
                                                    <!--class="badge"><?php echo $blog['comment']; ?></span></a>-->
                                    </p>
                                    </a>

                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 hidden-sm hidden-xs"></div>
            <div class="col-md-4">
                <div class="col-md-12">
                    <ul class="pagination">
                        <?php echo $page; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs"></div>
        </div>
    </div>
</div>
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