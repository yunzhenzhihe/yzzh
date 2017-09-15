<?php
namespace Home\Model;
use Think\Model;

class MessageModel extends Model {
	// 自动验证设置
  protected $_validate	 =	 array(
        array('msg','checkStringLength_msg','通知长度必须在 1-150 之间',1,'callback'), 								
	);
	// 自动完成
  protected $_auto = array ( 
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('company_name','getCompany_name',1,'callback'),  // 新增的时候把company_name 字段设置为 公司名称缩写 $_SESSION['company_id'])
	   array('time','getDateTime',1,'callback'),  // 建立时间
    );
	
  protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }

  protected function  getCompany_name(){   // 得到company_name session值
       return $_SESSION['company_name'];
   }   

   protected function checkStringLength_msg(){   //判断字符串的长度是否在一个范围内     
       return checkStringLength('msg','1','450');      
   }  
   
   function getDateTime() {
       return date('Y-m-d H:i:s');
   }  	
   
}

        

                           