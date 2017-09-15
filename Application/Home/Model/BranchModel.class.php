<?php
namespace Home\Model;
use Think\Model;

class BranchModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(	
		array('name','checkStringLength_unit','分支机构不能为空，并且长度必须在 1-100 之间',1,'callback'), 
		array('name','checkUnique_unit','分支机构重复',1,'callback'),  		
	);
	// 自动完成
   protected $_auto = array ( 
        array('branch_id','getRand_string',1,'callback'),  // 新增的时候把branch_id字段写入一个数字随机数 唯一识别码
        array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
    );
	
   protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }	
   
   protected function checkUnique_unit(){   //判断唯一性	
       return checkVarUnique('branch','name')  ;    
   } 
     
   protected function checkStringLength_unit(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('name','1','100');    
   }  
   
   protected function  getRand_string(){   // 得到20位的随机数字
       return get_rand_string(6,1);
   }     
   
}

        

