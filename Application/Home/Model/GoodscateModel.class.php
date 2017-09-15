<?php
namespace Home\Model;
use Think\Model;

class GoodscateModel extends Model {

//    protected $insertFields = array('name','price');
    protected $updateFields = array('cate');
	// 自动验证设置
    protected $_validate	 =	 array(
//        array('cate','checkStringLength_name','名称不能为空，并且长度必须在 1-100 之间',1,'callback'),
//		array('cate','checkUnique_name','名称重复',1,'callback'),
    );
	// 自动完成
    protected $_auto = array (
       array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 分支机构id  $_SESSION['branch_id'];
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
        array('path','getPath',1,'callback'),
    );
	
    protected function  getCompany_id(){   // 得到company_id session值
        return $_SESSION['company_id'];
   }
    protected function  getBranch_id(){   // 得到branch_id session值 分支机构id
       return $_SESSION['branch_id'];	   
   }
   
   protected function checkUnique_name(){   //判断名称唯一性	
       return checkVarUnique('goods','name')  ;    
   } 

   protected function checkStringLength_name(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('name','1','300');    
   }  
   
   protected function checkStringLength_unit(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('unit','1','300');    
   } 

   protected function checkStringLength_type(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('type_id','1','300');    
   }    

   protected function getPath(){
       if($_POST['pid']==0){
           return $_POST['path'];
       }else {
           $path = $_POST['path'] . $_POST['pid'] . ",";
           return $path;
       }
   }
}

        

                           