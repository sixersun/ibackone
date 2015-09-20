<?php

namespace Admin\Controller;

class DaliController extends AdminController {

    public function index(){
    	$id     =   I('path.2');
    	if($id==1){
    		$this->display('create');
    		exit;
    	}
        /* 查询条件初始化 */
        $map = array();
        $map  = array('status' => 1);
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $list=M('City')->order('id desc')->select();
        $this->assign('list',$list);
        $this->meta_title = '代理商管理';
        $this->display();
    }
    public function create(){
        /* 查询条件初始化 */
        $map = array();
        $map  = array('status' => 1);
        if(isset($_GET['group'])){
            $map['group']   =   I('group',0);
        }
        if(isset($_GET['name'])){
            $map['name']    =   array('like', '%'.(string)I('name').'%');
        }

        $list = $this->lists('Config', $map,'sort,id');
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->meta_title='新建代理商';
    	$this->display();
    }
    public function add(){
    	if(!I('post.area')) $this->error('请选择地区');
    	if(!I('post.company')) $this->error('请填写公司名称');
    	$data=array(
    		'province'=>I('post.province'),
    		'city' => I('post.city'),
    		'area'=>I('post.area'),
    		'company'=>I('post.company')
    		);
    	if(M('City')->add($data)){
    		$this->success();
    	}else{
    		$this->error();
    	}

    }
}