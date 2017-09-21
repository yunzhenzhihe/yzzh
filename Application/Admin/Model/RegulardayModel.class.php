<?php
namespace Admin\Model;
use Think\Model;

class RegulardayModel extends Model {

	// 自动验证设置
  protected $_validate	 =	 array(
		array('regular_name','checkStringLength_regularname','提醒项目不能为空',1,'callback'), 
	);
	// 自动完成
  protected $_auto = array ( 
       array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 公司id $_SESSION['company_id'])
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间
	   array('creat_name','getUsername',1,'callback'),  // 建立人  
    );
	//自动排除字段 在写操作的时候  以下字段不允许修改
  protected $readonlyField = array('branch_id', 'company_id', 'creat_time', 'creat_name', 'customer_guid', 'guid' );	
  
  protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }
   
   protected function  getBranch_id(){   // 得到branch_id session值 分支机构id
       return $_SESSION['branch_id'];
   }     
   
   function getDateTime() {
       return date('Y-m-d H:i:s');
   }     

   protected function  getUsername(){   // 建立人
       return $_SESSION['username'];
   } 
   
  protected function checkStringLength_regularname(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('regular_name','1','100');    
  }    
}

        

                           