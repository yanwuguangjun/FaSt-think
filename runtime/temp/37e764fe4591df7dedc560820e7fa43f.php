<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/mnt/hgfs/html/FaSt-think/application/index/view/index/socket_test.html";i:1503123420;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .left {
            width: 200px;
            float: left;
        }

        .right {
            width: 200px;
            float: left;
        }
    </style>
</head>
<body>
<div class="left">
    <div><input style="margin: 0 auto;" type="text" id="message" name="message"
                value="你好！"></div>
    <div><input type="text" id="ip" name="ip" value="192.168.133.136"></div>
    <div><input type="text" id="port" name="port" value="9501"></div>
    <div><img src="" id="error"></div>
    <div><p id="log"></p></div>
    <div>
        <button onclick="connect()">连接</button>
        <button onclick="send()">发送</button>
        <button onclick="close_socket()">关闭</button>
    </div>
</div>
<div class="right">
    <form id="login" method="post" action="<?php echo url('index/index/swoole_login'); ?>">
        <div><input type="text" name="username" id="username" value="username"></div>
        <div><input type="text" name="password" id="password" value="password"></div>
        <div>
            <button onclick="login()">登陆</button>
        </div>
    </form>
</div>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"
        integrity="sha384-tIwI8+qJdZBtYYCKwRkjxBGQVZS3gGozr3CtI+5JF/oL1JmPEHzCEnIKbDbLTCer"
        crossorigin="anonymous"></script>
<script>

    var ws = null;

    function connect() {
        var port = document.getElementById('port').value;
        ip = document.getElementById('ip').value;
        string_ws = 'ws://';
        value = "?token="+$.cookie('web_socket_token');
        url = string_ws + ip + ':' + port+value;
        ws = new WebSocket(url);
        ws.onopen = function () {
            console.log("连接成功");
        };
        ws.onmessage = function (data) {
            socket_log(data);
            console.log("收到服务端的消息：" + data.data);
        };
    }


    function close_socket() {
        if (ws != null) {
            ws.close();
            socket_Dlog('已关闭');
        }
    }

    function send() {
        var message = document.getElementById('message').value;
        if (ws != null) {
            ws.send(message);
        }
    }

    function socket_Dlog(data) {
        document.getElementById('log').innerHTML = data;
    }

    function socket_log(data) {
        var ele = document.createElement("P");
        t = document.createTextNode(data.data);
        document.getElementById('log').appendChild(t);

//        this.append('<div>'+data.data+'</div>');
//        document.getElementById('log').innerHTML = Math.ceil(Math.random() * 10) + ':' + data.data;
    }

    function login() {
        $('#login').ajaxForm({
            dataType: 'json',
            success: function (data) {
                socket_Dlog('demo');
                if (data.success) {
                    //设置cookies
//                    $.cookie('web_socket_token',data.token,{expires: 1});
                    socket_Dlog(data.success+$.cookie('web_socket_token'));
                } else if (data.error) {
                    socket_Dlog(data.error);
                }
            }
        });
        $('#form').submit();
    }

//    for (var i = 0;i<100000;i++){
//        ws = new WebSocket("ws://yongli.ronmei.net:8283");
//        ws.onopen = function() {
//            ws.send('tom');
//        };
//        ws.onmessage = function(e) {
//        };
//    }

</script>
</html>