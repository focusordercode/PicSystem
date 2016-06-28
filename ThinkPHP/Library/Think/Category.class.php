<?php
namespace Think;
/**
 * 类目管理类
 */
class Category {
	protected $id;
	protected $app_code;
	protected $cn_name;
	protected $en_name;
	protected $left_id;
	protected $right_id;
	protected $remark;
	protected $layer;
	protected $data=array();

    /**
     * 添加子类目
     */
	static function  AddSub($id,$app_code,$cn_name,$en_name,$remark){
		$sql=M()->query("call AddSubNode($id,'".$app_code."','".$cn_name."','".$en_name."','".$remark."')");

		if($sql){
			return 1;
		}else{
			return -1;
		}
	}


	/**
     * 添加顶级节点
     */
	static function  Add($app_code,$cn_name,$en_name,$remark){
		$tree_catetory=M('tree_catetory');
		$sys_app=M();
		$data['app_code']=$app_code;
		$data['cn_name']=$cn_name;
		$data['en_name']=$en_name;
		$data['left_id']=1;
		$data['right_id']=2;
		$data['remark']=$remark;
		$check=$tree_catetory->where("app_code='".$data['app_code']."'")->select();
		if($check){
			return 2;
		}
		$sql=$tree_catetory->data($data)->add();
		if($sql){
			return 1;
		}else{
			return -1;
		}
	}

	/**
     * 删除类目
     */
	static function Delete($id,$app_code){
        $sql=M()->query("call DelNode($id,'".$app_code."')");
        $query=M()->query("select id from tbl_tree_catetory");
        if($query){
           if($sql){
           	   return 1;
           }else{
           	   return -1;
           }
        }else{
        	return 2;
        }
	}

	/**
     * 修改类目名称
     */
	static function UpdaName($id,$cn_name,$en_name){
		$tree_catetory=M('tree_catetory');
		$data['cn_name']=$cn_name;
		$data['en_name']=$en_name;
        $sql=$tree_catetory->where("id = '%d'",array($id))->data($data)->save();
        if($sql!=='flase'){
        	return  1;
        }else{
        	return  -1;
        }
	}

	/**
     * 查询顶级类目
     */
    static function GetAncestors(){
           $sql=M()->query("select id,app_code,cn_name,en_name from treeView where Layer= 1");
           return($sql);      
    }

    /**
     * 查询子类目
     */
    static function GetSub($id,$app_code){
    	   $sql=M()->query("call GetChildrenNodeList($id,'".$app_code."')");
    	   return($sql);
    }

    /**
     * 模块内移动类目
     */
    static function move($moveid,$id){
           $sql=M()->query("call move($moveid,$id)");
           if($sql){
        	   return 1;
            }else{
        	  return -1;
            }
    }
    
    static function GetAll($id,$app_code){
    	   $sql=M()->query("select * from treeview");
    	   return($sql);
    }
}