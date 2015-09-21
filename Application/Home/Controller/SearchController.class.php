<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 用户端省市区查询
 */
class SearchController extends HomeController {

	//系统首页
    public function index(){    
        $this->display();
    }
    public function search(){
        $area=I('post.area');
        if(!$area) $this->ajax(-1,null,null);
        if(!$company=M('City')->field('company')->where('area=\''.$area.'\'')->find()){
            $this->_ajax(-1,'该地区不存在代理商',null);
        }
        $this->_ajax(1,null,$company['company']);
    }
    public function fangwei(){
        $this->display();
    }
    public function fangwei_search(){
        $id=I('post.id');
        if(!$id) $this->_ajax(-1,'请提交数据',null);
        if(!is_int($id)) $this->_ajax(-1,'请填写正确格式的防伪码',null);
        if($id=M('Fangwei')->where('fid='.$id)->find()) $this->_ajax(1,'正品',null);
        $this->_ajax(-1,'假冒',null);
    }
    private function _ajax($status=null,$msg=null,$data=null){
        $arr['status'] = $status;
        $arr['data'] = $data;
        $arr['msg'] = $msg;
        echo $this->_json($arr);
        exit;
    }
    private function _json($arr){
        if(is_array($arr)) return json_encode($arr);
    }

}