<?php
namespace Admin\Model;
use Think\Model;

class OrdersaledetailsModel extends Model {
	
 //  protected $insertFields = array('account','password','nickname','email');  //添加操作 可以处理的字段
 //  protected $updateFields = array('nickname','email');	

	// 自动验证设置
  protected $_validate	 =	 array(
     //   array('number','checkUnique_number','没有该卡号,请先在会员卡管理里面做开卡处理,然后再做绑定',0,'callback'),   
    // array('number','checkUnique_number','没有该卡号,请先在会员卡管理里面做开卡处理,然后再做绑定',0,'callback'),	
     //   array('goods_name','checkStringLength_msg','通知长度必须在 1-150 之间',1,'callback'), 			


	
	);
	// 自动完成
  protected $_auto = array ( 
       array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 公司id $_SESSION['company_id'])
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间
	   array('creat_name','getUsername',1,'callback'),  // 建立人
	   array('last_change_time','getDateTime',3,'callback'),  // 最后修改时间
	   array('last_change_name','getUsername',3,'callback'),  // 最后修改人  
    //   array('number','checkUnique_number','没有该卡号,请先在会员卡管理里面做开卡处理,然后再做绑定',0,'callback'), 	   
    );
	
  protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }
   
   protected function  getBranch_id(){   // 得到branch_id session值 分支机构id
       return $_SESSION['branch_id'];
   }     
   
   function getDateTime() {
       return date('Y-m-d H:i:s');
   }     

   protected function  getUsername(){   // 得到guid
       return $_SESSION['username'];
   } 

   protected function checkStringLength_msg(){   //判断字符串的长度是否在一个范围内     
       return checkStringLength('goods_name','1','450');      
   }     

   protected function checkUnique_number($data){   //判断卡号是否存在 
  // $this->data['xxx']
  
  
   //    $map = $this->data;
       if ( !empty(  $data['number']  ) ) {
       return true ;  }  else {  return false ; }
   }  
    
}

        

                           