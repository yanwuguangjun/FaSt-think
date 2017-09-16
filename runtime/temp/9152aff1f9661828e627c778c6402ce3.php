<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\Wnmp\html\getamaster/application/index\view\login\login.html";i:1500989996;}*/ ?>
<html>
<head>
    <meta name="description" content="铲屎官登录">
    <title>登录</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="www.getamaster.com/public/static/index/js/material.min.js"></script>-->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
    <!-- validate中文插件-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link href="http://www.getamaster.com/public/static/index/css/demo.css" rel="stylesheet" type="text/css">
    <link href="http://www.getamaster.com/public/static/index/css/material-kit.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.0/sweetalert2.min.css"/>
</head>
<body style="background-image: url('https://ununsplash.imgix.net/photo-1421098518790-5a14be02b243?w=1024&q=50&fm=jpg&s=24665881d66f79925810c2deb7e486b9'); background-size: cover; background-position: top center;">
<div class="section">
    <div class="header header-filter">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    <h3 class="panel-title" draggable="true">铲屎官登陆</h3>
                </div>
                <div class="card card-signup">

                    <form class="form" id="form" method="post" action="<?php echo url('index/Login/morosely_login'); ?>">

                        <div class="content">
                            <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">邮&nbsp;&nbsp;&nbsp;&nbsp;箱</i>
										</span>
                                <div class="form-group is-empty"><input type="text" id="email" name="email"
                                                                        class="form-control"
                                                                        placeholder="邮箱..."><span
                                        class="material-input"></span></div>
                            </div>
                            <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">密&nbsp;&nbsp;&nbsp;&nbsp;码</i>
										</span>
                                <div class="form-group is-empty"><input id="password" type="password" name="password"
                                                                        class="form-control"
                                                                        placeholder="密码..."><span
                                        class="material-input"></span></div>
                            </div>
                            <div class="input-group">
                            	<span class="input-group-addon">
			<i class="material-icons">验证码</i>
										</span>
                                <div class="col-xs-5 form-group" style="margin-bottom: 10px;margin-left: -15px;">
                                    <input class="form-control" id="captcha" name="captcha" placeholder="验证码..."
                                           type="text">
                                </div>
                                <div class="col-xs-4" style="height: 40px;">
                                    <img id="captcha_img" style="cursor: pointer;margin-top: 30px;"
                                         src="<?php echo captcha_src(); ?>"
                                         onclick="this.src='<?php echo captcha_src(); ?>?r'+Math.random()" alt="captcha"
                                         class="pull-right">
                                </div>
                                <div class="col-xs-3" style="height: 40px;">
                                    <a style="text-align: center;line-height: 100px;margin-right: -15px;"
                                       href="javascript:;"
                                       onclick="document.getElementById('captcha_img').src='<?php echo captcha_src(); ?>?r'+Math.random()">换一个</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="footer text-center">
                                <button type="submit" class="btn" style="background-color: #00b38a;">登录</button>
                            </div>
                        </div>
                        <div class="text-right" style="padding:0 20px 20px;">
                            <a href="<?php echo url('index/index/index'); ?>" style="padding:0 10px;" class="pull-right">首页</a><a href="{index/morosely/morosely_register}" class="pull-right">注册</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"
                integrity="sha384-tIwI8+qJdZBtYYCKwRkjxBGQVZS3gGozr3CtI+5JF/oL1JmPEHzCEnIKbDbLTCer"
                crossorigin="anonymous"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.0/sweetalert2.min.js"></script>

        <script>
            $(function () {
                $("#form").validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 6
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        captcha: "required"
                    },
                    messages: {
                        password: {
                            required: "请输入密码",
                            minlength: "密码长度不得小于6"
                        },
                        email: {
                            required: '必须填写邮箱',
                            email: '必须是邮箱'
                        },
                        captcha: "请填写验证码"

                    }
                });
                $('#form').ajaxForm({
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            swal(data.success, '', 'success');
                            self.location="<?php echo url('index/index/index'); ?>";
                        } else {
                            swal(data.error, '', 'error');
                        }
                    }
                });
            });
        </script>
    </div>
</div>


</body>
</html>