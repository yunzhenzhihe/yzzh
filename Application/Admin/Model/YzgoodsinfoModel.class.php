<?php
namespace Admin\Model;
use Think\Model;

class YzgoodsinfoModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(	
		array('attr','checkStringLength','字段名称不能为空，并且长度必须在 1-100 之间',1,'callback'), 
//		array('attr','checkUnique','字段名称重复',1,'callback'),
	);
	// 自动完成
   protected $_auto = array ( 
        array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
		array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 公司id $_SESSION['company_id'])
		array('guid','getGuid',1,'callback'),  // 新增的时候 唯一识别码
		array('sort','getSort',1,'callback'),  // 新增的时候 排序 当前最大的值
    );
	
   protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }
   
   protected function  getBranch_id(){   // 得到branch_id session值 分支机构id
       return $_SESSION['branch_id'];
   }   
   
  protected function  getGuid(){   // 得到guid
       return get_guid();
   }   
   
  protected function  getSort(){   // 新增的时候 排序 当前最大的值 时间戳
       return time();
   }   
   
   protected function checkUnique(){   //判断唯一性	
       return checkVarUnique('yzgoodsinfo','attr')  ;    
   } 
     
   protected function checkStringLength(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('attr','1','100');    
   }  
   
   
}

        

