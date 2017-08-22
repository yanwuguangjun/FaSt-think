<?php

namespace app\index\controller;

use app\index\model\MoroselyOne;
use think\Config;
use think\Controller;
use think\Request;
use think\Db;
use think;
use think\Cache;
use app\index\model\Charity;
use app\index\model\CharityUser;
use app\index\model\Morosely;
use app\index\model\Blog;
use app\index\model\Comment;
use app\index\model\SociallyUsefulActivity;
use app\index\model\WaitAdopt;
use app\index\controller\Adopt;
use app\index\Model\ActivityComment;
use Phpml\Classification\KNearestNeighbors;
use Predis\Client;
use think\Cookie;

class Index extends Common
{
    use \traits\controller\Jump;              /*引入jump*/


    public function _initialize()
    {
        //session 判断；
    }


    //php-ml test
    public function index_test()
    {
        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];
        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);
        echo $classifier->predict([3, 2]);
    }


    public function swoole_test()
    {
        return $this->fetch('index/socket_test');
    }

    public function swoole_login()
    {
        if (!request()->isPost()) {
            return json(['error' => '请求错误']);
        }
        $connect = new Client(Config::get('redis'));
        $data = input();
        function su($connect, $data)
        {

            $token = $data['username'] . '__' . date('YmdHis', time()) . uniqid();

            Cookie::set('web_socket_token', $token, 3600);

            if ($connect instanceof Client) {
                $connect->hset($data['username'], 'token', $token);
                $connect->set($token, null);
//                $connect->set('online'.$connect->hget($data['username'],'username'),true);
            }


            return json(['success' => '登陆成功！']);
        }

        return $data['password'] == $connect->hget($data['username'], 'password') ? su($connect, $data) : json(['error' => '用户名或密码错误！']);
    }




    //首页
    public function index()
    {
        //banner
        $banner = Blog::where('status', 2)->limit(4)->order('id desc')->select();
        //活动banner
        $activity_banner = SociallyUsefulActivity::where('status', 1)->limit(1)
            ->field('id,faceImage,title')
            ->order('id')->select();
        $this->assign('activity_banner', $activity_banner);

        //文章列表

        $blog = Blog::where('a.status', '1')
            ->alias('a')
            ->join('user_morosely b', 'a.moroselyId = b.id')
            ->field('a.id as blogId,a.title,a.love,a.see,a.comment,b.pic,b.username,b.id,a.faceImage,a.moroselyId')
            ->order('a.id desc')
            ->paginate(12);
        //萌宠养成 type = 1
        $new_bring_up = Blog::where('a.status =0 or a.status = 1 or a.status = 2 or a.status = 10 and a.type = 1')
            ->field('a.id,b.pic,a.faceImage,a.moroselyId,a.title,a.description,a.love,a.see,b.username,a.comment')
            ->alias('a')->join('user_morosely b', 'a.moroselyId = b.id')
            ->limit(4)->order('a.id desc')->select();

        //下方小的媒体 养成经验 TODO  萌宠美妆 type = 2
//        $new_beauty = Blog::where('a.status =0 or a.status = 1 or a.status = 2 or a.status = 10 and a.type = 2')
//            ->field('a.id,b.pic,a.faceImage,a.moroselyId,a.title,a.description,a.love,a.see,b.username,a.comment')
//            ->alias('a')->join('user_morosely b', 'a.moroselyId = b.id')
//            ->limit(2)->order('a.id desc')->select();

        //最新活动
        $new_activity = SociallyUsefulActivity::where('status = 1')
            ->field('id,faceImage,title')
            ->limit(2)->order('id desc')->select();
        //最新领养
        $new_adopt = WaitAdopt::where('status = 10')
            ->field('id,images,title')
            ->limit(2)->order('id desc')->select();
        $new_adopt = $this->getNO_1_image($new_adopt, 'images', '&');
        $page = $blog->render();
//        $this->assign('new_beauty', $new_beauty);
        $this->assign('new_bring_up', $new_bring_up);
        $this->assign('new_adopt', $new_adopt);
        $this->assign('new_activity', $new_activity);
        $this->assign('page', $page);
        $this->assign('blog', $blog);
        $this->assign('banner', $banner);
//        var_dump($blog);
        return $this->fetch('index/index');

    }

    public function apicurl()
    {
        $app_code = '57392055574c4ad3a58e60892b4de478';
        $host = "http://stock.market.alicloudapi.com";
        $path = "/timeline";
        $method = "GET";
        $appcode = $app_code;
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "code=601857&day=1";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
//        var_dump(curl_exec($curl));
        $data = curl_exec($curl);
//        $data = json_encode($data);
        $data = json_decode($data, true);

        var_dump($data['showapi_res_body']['dataList'][0]['minuteList']);
//        var_dump($data);

//        echo is_string($data);

//        return $data['message'] == 'success' ? $data['result'] : 'error';

    }


    function demo_index()
    {

        return $this->fetch('index/demo');
    }


    function server()
    {
        $server = new swoole_websocket_server("0.0.0.0", 9501);

        $server->on('open', function (swoole_websocket_server $server, $request) {
            echo "server: handshake success with fd{$request->fd}\n";
            swoole_timer_tick(1000, function () use ($server, $request) {
                $server->push($request->fd, '你好！' . $request->fd);
            });
        });

        $server->on('message', function (swoole_websocket_server $server, $frame) {
            echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
            $server->push($frame->fd, "this is server");
        });

        $server->on('close', function ($ser, $fd) {
            echo "client {$fd} closed\n";
        });

        $server->start();
    }

    function api_demo()
    {
//        $url1 = 'http://Bond.liangyee.com/bus-api/Bond/BondInfo/GetMarketData?userKey=7D78A5D41F0D46E78D79A40BA96001C6&symbol=010107';
        $host = 'http://Bond.liangyee.com';
//        $path = '/bus-api/Bond/BondInfo/GetMarketData/GetSymbol';
//        $parm_key = 'userKey=';
//        $user_key = '7D78A5D41F0D46E78D79A40BA96001C6';
//        $parm_symbol = 'symbol=';
//        $ob_id = '018002';
        $method = 'GET';
        $headers = array();
        $url = 'http://Bond.liangyee.com/bus-api/Bond/BondInfo/GetSymbol?userKey=7D78A5D41F0D46E78D79A40BA96001C6';


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));


    }


    //普通文章
    public function ordinary()
    {
        $blog = db('blog')->where('a.status = 0 or a.status = 1 or a.status = 2 or a.status = 10')
            ->alias('a')
            ->join('user_morosely b', 'a.moroselyId = b.id')
            ->field('a.id as blogId,a.title,a.love,a.see,a.comment,b.pic,b.username,b.id,a.faceImage,a.moroselyId')
            ->order('a.id desc')
            ->paginate(20);
        $page = $blog->render();
        $this->assign('blog', $blog);
        $this->assign('page', $page);
        return $this->fetch('article/ordinary');
    }


    public function show_article()
    {
        $id = input('id');
        $pageNum = input('page');
        $pageNum ? $pageNum : $pageNum = '1';
        Blog::where('id', $id)->setInc('see');      //浏览次数加1
        $blog = Blog::get($id);
        $comments = Comment::where('articleId', $id)
            ->alias('a')->join('user_morosely b', 'a.moroselyId = b.id')
            ->cache($pageNum, 0, 'comment_' . $id)
            ->order('time desc')->paginate(5, false, ['query' => ['id' => $id]]);     //编辑分页的url
        $morosely = $blog->morosely()
            ->alias('a')->join('user_morosely_one b', 'a.id = b.moroselyId')
//            ->cache('morosely_' . $blog->moroselyId)
            ->find($blog->moroselyId);  //获取用户头像用户名
//        $moroselyOne = $blog->moroselyOne()->cache('moroselyOne_' . $blog->moroselyId)->find($blog->moroselyId);  //用户信息
        $page = $comments->render();                   //分页
        if ($blog) {
            $this->assign('morosely', $morosely);
//            $this->assign('moroselyOne', $moroselyOne);
            $this->assign('page', $page);
            $this->assign('comments', $comments);
            $this->assign('blog', $blog);
        } else {
            $this->error('哎呀，不小心丢了个网页呢！');
        }
        return $this->fetch('article/show_article');
    }


    //todo 发线了个bug  在评论表中不需要保存用户用户名只需要id就够了


    //活动页面
    public function show_activity()
    {
        $activity = new Activity();
        return $activity->show_activity();
    }

    //活动页面列表
    public function activity_list()
    {
        $activity = new Activity();
        return $activity->activity_list();
    }

    //活动点赞
    public function like_activity()
    {
        $activity = new Activity();
        return $activity->like_activity();
    }

    //待领养宠物列表页
    public function adopt_list()
    {
        $adopt_list = new Adopt();
        return $adopt_list->adopt_list();
    }

    //待领养宠物页
    public function show_adopt()
    {
        $adopt = new Adopt();
        return $adopt->show_adopt();
    }

    //丢失列表
    public function lost_list()
    {
        $lost = new Lost();
        return $lost->lost_list();
    }


    public function training()
    {
        if (request()->isGet()) return 'error' . '<script> self.location="{:url(' . 'index/index/index' . ')}"</script>'; //判断请求类型
        $sql = "SELECT * FROM tests ORDER BY RAND() LIMIT 2";
        $rand = Db::query($sql);
        $this->assign('answers', $rand);
        return $this->fetch('training');
    }


    // 退出登录
    public function quite()
    {
        $session = session(null);

        if (empty($session)) {
            $this->success('登出成功！', 'index/index/index');
        }
    }


}
