<?php
namespace Home\Model;
use Think\Model;

class GroupModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(	
		array('cat_name','checkStringLength_name','名称不能为空，并且长度必须在 1-100 之间',1,'callback'), 
		array('cat_name','checkUnique_name','名称重复',1,'callback'),  		
	);
	// 自动完成
   protected $_auto = array ( 
        array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 分支机构id  $_SESSION['branch_id'];
        array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
		array('cat_id','getRand_string',1,'callback'),  // 新增的时候把cat_id字段写入一个数字随机数 唯一识别码
    );
	
   protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }
   
   protected function  getBranch_id(){   // 得到branch_id session值 分支机构id
       return $_SESSION['branch_id'];
   }   
    protected function  getRand_string(){   // 得到20位的随机数字
       return get_rand_string(20,1);
   }  
   

   protected function checkUnique_name(){   //判断名称唯一性	
       return checkVarUnique('group','cat_name')  ;    
   } 
     
   protected function checkStringLength_name(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('cat_name','1','300');    
   }  
   
   
}

        

