<?php

namespace Admin\Controller;

class FangweiController extends AdminController {

    public function index(){
    	$id     =   I('path.2');
    	if($id==1){
    		$this->fwlist();
    		exit;
    	}
        $this->display();
    }
    public function fwlist(){
        $list=M('Fangwei')->order('id desc')->select();
        $this->assign('list',$list);
        $this->display('list');
    }
    public function add(){
    	$data=array(
            'fid'=>I('post.fid'),
    		);
    	if(M('Fangwei')->add($data)){
    		$this->success();
    	}else{
    		$this->error();
    	}

    }
}