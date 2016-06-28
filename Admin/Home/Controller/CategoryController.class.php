<?php
namespace Home\Controller;
use Think\Controller\RestController;
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST,GET');
header('Access-Control-Allow-Credentials:true'); 
header("Content-Type: application/json;charset=utf-8");
/**
* 类目管理控制器
*/
class CategoryController extends RestController
{
    protected $allowMethod    = array('get','post','put','delete');
    protected $defaultType      = 'json';
	/**
     * 添加子类目
    */
	public function addSub(){
        $id=I('post.id');
        $app_code=I('post.app_code');
        $cn_name=I('post.cn_name');
        $en_name=I('post.en_name');
        $remark=I('post.remark');
        $data=array();
        if($id!=null){
            if($app_code!=null){
                if($cn_name!=null){
                    if($en_name!=null){
                        $res=\Think\Category::AddSub($id,$app_code,$cn_name,$en_name,$remark);
                        if($res==1){
                            $data['status']=100;
                        }else{
                            $data['status']=101;
                        }
                    }else{
                        $data['status']=105;
                    }
                }else{
                        $data['status']=104;
                } 
            }else{
                $data['status']=103;
            }     
        }else{
            $data['status']=102;
        }
        
		$this->response($data,'json');
	}

	/**
     * 添加顶级节点
     */
    public function add(){
        $app_code=I('post.app_code');
        $cn_name=I('post.cn_name');
        $en_name=I('post.en_name');
        $remark=I('post.remark');
        $data=array();
        if($cn_name!=null){
            if($en_name!=null){
                $res=\Think\Category::Add($app_code,$cn_name,$en_name,$remark);
                if($res==1){
                    $data['status']=100;
                }elseif($res==2){
                    $data['status']=113;
                }else{
                    $data['status']=101;
                }
            }else{
                $data['status']=104;
            }
        }else{
                $data['status']=105;
        }  
		$this->response($data,'json');
	}

	/**
     * 删除类目
     */
    public function  Delete(){
        $id=I('post.id');
        $app_code=I('post.app_code');
    	$res=\Think\Category::Delete($id,$app_code);
        $data=array();
    	if($res==1){
			$data['status']=100;
		}else{
			$data['status']=101;
		}
		$this->response($data,'json');
    }
    
    /**
     * 修改类目名称
     */
    public function updaName(){
    	$id=I('post.id');
        $cn_name=I('post.cn_name');
        $en_name=I('post.en_name');
        $data=array();
        if(id!=null){
            if($cn_name!=null){
                if($en_name!=null){
                    $res=\Think\Category::UpdaName($id,$cn_name,$en_name);
                    if($res==1){
                        $data['status']=100;
                    }else{
                        $data['status']=101;
                    }
                }else{
                    $data['status']=105;
                }
            }else{
                    $data['status']=104;
            }  
        }else{
            $data['status']=102;
        }
		$this->response($data,'json');
    }
    
    /**
     * 查询顶级类目
     */
    public function getAncestors(){
        //$app_code=I('get.app_code');
        $data=array();
        $res=\Think\Category::GetAncestors();
        if($res){
          $data['status']=100;
          $data['value']=$res;
        }else{
          $data['value']=101;
        }
        $this->response($data,'json');
    }

    /**
     * 查询某类目的下一级类目
     */
    public function getChildren(){
        $data=array();
        $id=I('post.id');
        $app_code=I('post.app_code');
        $res=\Think\Category::GetSub($id,$app_code);
        if($res){
           $data['status']=100;
           $data['value']=$res;
        }else{
           $data['status']=101;
        }
        $this->response($data,'json');
    }

     /**
     * 模块内移动类目
     */
    public function move(){
        $data=\Think\Category::GetAncestors();
        if($data==1){
        $data['status']=100;
        }else{
        $data['status']=101;
        }
        $this->response($data,'json');
    }

    public function getAll(){
        $data=array();
        $id=I('post.id');
        $app_code=I('post.app_code');
        $res=\Think\Category::GetAll($id,$app_code);
        if($res){
        $data['status']=100;
        $data['value']=$res;
        }else{
        $data['status']=101;
        }
        $this->response($data,'json');
    }

}