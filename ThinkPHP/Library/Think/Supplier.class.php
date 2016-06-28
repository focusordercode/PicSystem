<?php
namespace Think;
/**
 * 供应商类
 */
class Supplier{
	/**
     * 查询所有供应商类
     */
    static function GetAll(){
    	$supplier=M("");
    	$sql=$supplier->select();
    	return($sql);
    }

    /**
     * 模糊搜索供应商类
     */
    static function FuzzySearch($name){
         
    }
}