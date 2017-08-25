<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {
    public function show(){
            if(IS_AJAX)
            {
                $count = M('article')->count();//var_dump($count);
                $pages = $this->getPages($count);

                $currentIndex = I('get.currentIndex',1);
                $pageSize = I('get.pageSize',C('PAGE_SIZE'));

                $data = M('article')->join('blog_category on blog_article.category_id=blog_category.category_id')->page($currentIndex.','.$pageSize)->select();
                $this->ajaxReturn(['data'=>$data,'pages'=>$pages,'pageSize'=>$pageSize]);
            }
            
            $this->display('Article/show');
        }
    public function add(){
        $list = M('lable')->select();
        $data = M('category')->select();
        $cate = M('category')->select();
        $this->assign('list',$list);
        //var_dump($list);die;
        $this->assign('data',$data);
        $this->assign('cate',$cate);
        $this->display('Article/add');
        
    }
    public function insert(){
        $data = I('post.');

        $data['article_create_time'] = date("Y-m-d H:i:s", time());
        
        $res = M('article')->add($data);
        if($res){
            $label = I('post.label_id');
            $labelarticle = array();
            // var_dump($label);die;
            foreach($label as $ke => $val){
                $labelarticle[] = array(
                            'label_id' => $val,
                            'article_id' => $res,
                    );
            }
            $labelresult = M('article_lable')->addAll($labelarticle);
            
            if($labelarticle){
                admin_log('添加博文:'.$data['article_title']);
                $this->success('博文添加成功',U('Article/show'));
            }else{
                $this->success('博文添加成功',U('Article/show'));
            }
        }

    }

    public function update(){
        $id = I('get.id');
        $data = M('article as b')->where(['article_id'=>$id])->find();
        $cate = M('category')->select();
        $this->assign('data',$data);
        $this->assign('cate',$cate);
        $this->display('Article/update');
    }

    public function save(){
        $data = I('post.');
        $res = M('article')->where(['article_id'=>$data['id']])->save($data);
        if($res){
            admin_log('修改博文:'.$data['article_title']);
            $this->success('博文修改成功',U('Article/show'));
        }else{
            $this->success('博文修改失败',U('Article/show'));
        }
    }
    public function delete(){
        $id=I('get.id');
        $res = M('article')->where(['article_id'=>$id])->delete();
        // echo M('admin')->_sql();die;
        if($res){
            admin_log('删除了一篇博文');
            $this->success('博文删除成功',U('Article/show'));
        }else{
            $this->success('博文删除成功',U('Article/show'));
        }
    }



    protected function getPages($count)
    {
        $pageSize = C('PAGE_SIZE');
        return ceil($count/$pageSize);
    }

}