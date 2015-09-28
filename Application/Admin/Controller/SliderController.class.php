<?php

namespace Admin\Controller;

class SliderController extends AdminController {

    public function index(){
    	$pic=M('Slider')->select();
    	$this->assign('pic',$pic);
        $this->display();
    }
    public function save(){
		if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/jpeg"))||($_FILES["file"]["type"] == "image/png")&& ($_FILES["file"]["size"] < 200000)){
		  	if ($_FILES["file"]["error"] > 0){
		    	echo "Error: " . $_FILES["file"]["error"] . "<br />";
		    }else{
		    	// echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		    	// echo "Type: " . $_FILES["file"]["type"] . "<br />";
		    	// echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		    	// echo "Stored in: " . $_FILES["file"]["tmp_name"];
		    	$filename= $_FILES["file"]["tmp_name"];	
		    	$destination=C('PICTURE_UPLOAD.rootPath').$_FILES['file']['name'];
		    	if(!move_uploaded_file($filename,$destination)){
		    		echo '文件上传失败';
		    		exit;
		    	}
		    	if(M('Slider')->add(array('path'=>$destination,'name'=>$_FILES['file']['name']))){
		    		$this->success('保存成功');
		    		exit;
		    	};
		    	$this->error('保存失败');
		    	
		    }
		}else{
			echo '文件类型错误或者文件太大';
		}
	}
	public function del(){
		$id=I('id');
		if(M('Slider')->where('id='.$id)->delete()){
			$this->success();
			exit;
		}
		$this->error();
	}
}