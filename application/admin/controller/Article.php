<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\Article as ArticleModel;

class Article extends Controller
{
    public $warning = '非法操作：FBI warning!';

    public function add()
    {
        if (request()->isPost()) {
            $date = input();
            if (input('state') == 'on') {
                $date['state'] = 1;
            }
            $date['time'] = time();
            $validate = validate('Article');
            $check = $validate->scene('add')->check($date);
            if (!$check) {
                echo '<script>alert("' . $this->error($validate->getError()) . '")</script>';
            } else {
                $img = request()->file('pic');
                if ($img) {
                    $info = $img->rule('date')->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'admin' . DS . 'article');
                    if ($info) {
                        //getSaveName   内置方法无代码提示个人发现 牛逼！
                        $date['pic'] = 'public' . DS . 'uploads' . DS . 'admin' . DS . 'article' . DS . $info->getSaveName();
                    } else {
                        echo $info->getError();
                    }
                }
                $create = ArticleModel::create($date);
                if ($create) {
                    $this->success('插入成功');
                } else {
                    $this->error('插入成功');
                }
            }
        } else {
            $select = db('cate')->paginate();
            $this->assign('cate', $select);
            return $this->fetch('add');
        }
    }


    public function article_list()
    {


//        $list = db('article')->alias('a')->join('ym_cate c','a.cateid = c.id')->field('*')->paginate(5);           //  好像是模型方法好用些    关联不好用。。。。。

        $select = db('cate')->paginate();
        $this->assign('cate', $select);

        $list = ArticleModel::paginate(5);         //感觉关联那玩意真不好用////。。。
        $this->assign('list', $list);

        return $this->fetch('article_list');
    }

    public function del()
    {
        $id = input('id');
        $delete = db('article')->delete($id);
        if ($delete) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
        return $this->article_list();
    }

    public function art_update()
    {
        if (request()->isPost()) {
            $date = input();
            if (input('state')=='on') {          // 无法找到键名//////
                $date['state'] = 1;
            }else{
                $date['state'] = 0;
            }
            $date['time'] = time();
            $validate = validate('Article');
            $check = $validate->scene('add')->check($date);
            if (!$check) {
                echo '<script>alert("' . $this->error($validate->getError()) . '")</script>';
            } else {
                $img = request()->file('pic');
                if ($img) {
                    $info = $img->rule('date')->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'admin' . DS . 'article');
                    if ($info) {
                        //getSaveName   内置方法无代码提示个人发现 牛逼！
                        $date['pic'] = 'public' . DS . 'uploads' . DS . 'admin' . DS . 'article' . DS . $info->getSaveName();
                    } else {
                        echo $info->getError();
                    }
                }
                $create = ArticleModel::where('id',$date['id'])->update($date);
                if ($create) {
                    $this->success('修改成功');
                } else {
                    $this->error('修改成功');
                }
            }


        } else {
            $id = input('id');
            $find = ArticleModel::findOrFail($id);
            if ($find) {
                $this->assign('article', $find);
                $cateid = $find['cateid'];



                $defcate = db('cate')->find($cateid);
                $this->assign('defcate', $defcate);

                //获取模块列表
                $select = db('cate')->paginate();   //此处不应该用分页 但是也通过分页来实现了其实可以用select
                $this->assign('cate', $select);
                return $this->fetch('art_update');
            } else {
                $this->error('');
            }
        }


    }


//
//    以下为模块操作因为懒所以没有使用模型操作
//

    public function add_artmod()                //增加模块
    {
        if (request()->isPost()) {
            $date = input();
            $validate = validate('Article');
            if (!$validate->scene('add_artmod')->check($date)) {
                echo '<script>alert("' . $validate->getError() . '")</script>';
            } else {
                $insert = db('cate')->insert($date);
                if ($insert) {
                    $this->success('添加成功！');
                } else {
                    $this->error('添加失败');
                }
            }
        }
        return $this->fetch('add_artmod');
    }

    public function artmod_update()              //更新模块
    {

        if (request()->isPost()) {
            $date = [
                'id' => input('id'),
                'catename' => input('catename'),
                'keywords' => input('keywords'),
                'description' => input('description'),
            ];
            $validate = validate('Article');
            if (!$validate->scene('artmod_update')->check($date)) {
                echo '<script>alert("' . $validate->getError() . '")</script>';
            } else {
                $find = Db::table('ym_cate')->where('id', $date['id'])->find();
                if ($find) {
                    if ($find == $date) {
                        $this->success('更新数据成功,数据未发生改变', 'admin/article/artmod_lst');
                    } else {
                        $insert = Db::table('ym_cate')->where('id', $date['id'])->update($date);
                        if ($insert) {
                            $this->success('更新数据成功', 'admin/article/artmod_lst');
                        } else {
                            $this->error('更新失败', 'admin/article/artmod_lst');
                        }
                    }
                } else {
                    $this->error($this->warning . '非法id', 'admin/article/artmod_lst');
                }
            }

        } else {
            $id = input('id');
            if ($id != null) {
                $find = Db::table('ym_cate')->find($id);
                if ($find) {
                    $this->assign('artmod', $find);
                    return $this->fetch('artmod_update');
                } else {
                    $this->error($this->warning);
                }
            } else {
                $this->error($this->warning, 'admin/article/artmod_lst');
            }
        }

    }

    public function del_artmod()                     //删除模块
    {
        $id = input('id');
        $delete = db('cate')->delete($id);
        if ($delete) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败', 'admin/article/artmod_lst');
        }
    }

    public function artmod_lst()                   //模块列表
    {
        $list = Db::table('ym_cate')->paginate(5);
//        $list=db('cate')->field('id,catename,keywords,description')->paginate(5);   //备用方法
        if ($list) {
            $this->assign('list', $list);

            return $this->fetch('artmod_lst');
        } else {
            $this->error('获取列表失败或列表为空');
        }
    }
}