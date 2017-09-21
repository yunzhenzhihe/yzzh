<?php
namespace Admin\Model;
use Think\Model;

class CustomerModel extends Model {

	// 自动验证设置
  protected $_validate	 =	 array(
     //   array('number','checkUnique_number','没有该卡号,请先在会员卡管理里面做开卡处理,然后再做绑定',0,'callback'),    		
	);
	// 自动完成
  protected $_auto = array ( 
       array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 分支机构id  $_SESSION['branch_id'];
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间
	   array('creat_name','getUsername',1,'callback'),  // 建立人
	   array('last_change_time','getDateTime',3,'callback'),  // 最后修改时间
	   array('last_change_name','getUsername',3,'callback'),  // 最后修改人  
    //   array('number','checkUnique_number','没有该卡号,请先在会员卡管理里面做开卡处理,然后再做绑定',0,'callback'), 	   
    );
	
	//自动排除字段 在写操作的时候  以下字段不允许修改
 // protected $readonlyField = array('branch_id', 'company_id', 'creat_time', 'creat_name', 'guid' );	
  	
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

   protected function checkUnique_number(){   //判断卡号是否存在   
       if ( !empty( $_POST['number'] ) ) {
       return !checkVarUniqueNoId('carddata','number')  ;    }  else {  return true ; }
   }  
     
}

        

                           