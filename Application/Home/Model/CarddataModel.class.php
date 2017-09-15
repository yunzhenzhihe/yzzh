<?php
namespace Home\Model;
use Think\Model;

class CarddataModel extends Model {
	// 自动验证设置
  protected $_validate	 =	 array(
        array('number','checkStringLength_number','卡号不能为空，并且长度必须在 1-50 之间',0,'callback'), 
		array('number','checkUnique_name','会员卡号重复',0,'callback'),  

    //    array('goods_price','/^[(\-|\+)\d|\.]+$/','单价必须是有效的数字',1,'regex'),
        array('memo','checkStringLength_desc','备注字段的长度必须在 0-500 之间',1,'callback'), 		
						
	);
	// 自动完成  state
  protected $_auto = array ( 
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	//   array('state','正常'),  // 新增的时候把state字段设置为 正常  状态
	   array('guid','getGuid',1,'callback'),  // 新增的时候把goods_id字段写入一个数字随机数 唯一识别码
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间
	   array('creat_name','getUsername',1,'callback'),  // 建立人
	   array('last_change_time','getDateTime',3,'callback'),  // 最后修改时间
	   array('last_change_name','getUsername',3,'callback'),  // 最后修改人  	   	  	   
    ); 
	
		

  protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
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
   
   protected function checkUnique_name(){   //判断卡号唯一性	
       return checkVarUnique('carddata','number')  ;    
   } 
   

   protected function checkStringLength_number(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('number','1','150');    
   }  
   	
   protected function checkStringLength_desc(){   //判断字符串的长度是否在一个范围内     
       return checkStringLength('goods_desc','0','1500');      
   }  	
	
   
}

        

                           