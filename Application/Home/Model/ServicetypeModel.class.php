<?php
namespace Home\Model;
use Think\Model;

class ServicetypeModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(	
		array('name','checkStringLength_name','售后类型不能为空，并且长度必须在 1-100 之间',1,'callback'), 
		array('name','checkUnique_name','售后类型重复',1,'callback'),  		
	);
	// 自动完成
   protected $_auto = array ( 
        array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 分支机构id  $_SESSION['branch_id'];
        array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
    );
	
   protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }
   
   protected function  getBranch_id(){   // 得到branch_id session值 分支机构id
       return $_SESSION['branch_id'];
   }     
   
   protected function checkUnique_name(){   //判断唯一性	
       return checkVarUnique('servicetype','name')  ;    
   } 
     
   protected function checkStringLength_name(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('name','1','100');    
   }  
   
   
}

        

