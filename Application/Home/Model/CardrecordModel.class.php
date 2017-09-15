<?php
namespace Home\Model;
use Think\Model;

class CardrecordModel extends Model {
	// 自动验证设置
  protected $_validate	 =	 array(
	  array('memo','checkStringLength_desc','备注字段的长度必须在 0-500 之间',1,'callback'), 								
	);
	
	// 自动完成
  protected $_auto = array ( 
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间
	   array('creat_name','getUsername',1,'callback'),  // 建立人  	  	   
    ); 
	
		

  protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }	
 
   
   function getDateTime() {
       return date('Y-m-d H:i:s');
   }     

   protected function  getUsername(){   // 得到guid
       return $_SESSION['username'];
   } 
   
   protected function checkStringLength_desc(){   //判断字符串的长度是否在一个范围内     
       return checkStringLength('goods_desc','0','1500');      
   }   

	
   
}

        

                           