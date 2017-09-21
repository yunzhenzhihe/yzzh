<?php
namespace Admin\Model;
use Think\Model;

class NoticeModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(	
		array('title','checkStringLength_title','标题不能为空，并且长度必须在 1-500 之间',1,'callback'), 
		array('memo','checkStringLength_memo','内容不能为空，并且长度必须在 1-500 之间',1,'callback'), 	
	);
	// 自动完成
   protected $_auto = array ( 
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间
	   array('creat_name','getUsername',1,'callback'),  // 建立人
    );
	
   function getDateTime() {
       return date('Y-m-d H:i:s');
   }     

   protected function  getUsername(){   // 得到guid
       return $_SESSION['username'];
   }	
   
   protected function checkStringLength_title(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('title','1','500');    
   }  
   
   protected function checkStringLength_memo(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('memo','1','500');    
   }    
   
}

        

