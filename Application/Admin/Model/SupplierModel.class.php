<?php
namespace Admin\Model;
use Think\Model;

class SupplierModel extends Model {  //供应商表
	// 自动验证设置
	protected $_validate	 =	 array(	
		array('company','checkStringLength_company','公司名称不能为空，并且长度必须在 1-255 之间',1,'callback'),
		array('company','checkUnique_company','公司名称重复',1,'callback'),  	
		//array('name_count','checkStringLength_namecount','统计姓名不能为空，并且长度必须在 1-100 之间',1,'callback'), 
		//array('name','checkUnique_unit','销售人员重复',1,'callback'),  		
	);
	// 自动完成
   protected $_auto = array ( 
        array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 分支机构id  $_SESSION['branch_id'];
        array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
		array('guid','getGuid',1,'callback'),  // 新增的时候 唯一识别码
	    array('creat_time','getDateTime',1,'callback'),  // 建立时间
	    array('creat_name','getUsername',1,'callback'),  // 建立人		
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
   
   function getDateTime() {
       return date('Y-m-d H:i:s');
   }     

   protected function  getUsername(){   // 得到guid
       return $_SESSION['username'];
   }    
   
    protected function checkStringLength_company(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('company','1','100');    
   }  
   
   protected function checkUnique_company(){   //判断唯一性	
       return checkVarUnique('supplier','company')  ;    
   } 
   
}

        

