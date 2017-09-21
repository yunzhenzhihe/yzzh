<?php
namespace Admin\Model;
use Think\Model;

class OrdersalesprocessModel extends Model {
	
 //  protected $insertFields = array('account','password','nickname','email');  //添加操作 可以处理的字段
 //  protected $updateFields = array('nickname','email');	

	// 自动验证设置
  protected $_validate	 =	 array(	
	);
	// 自动完成
  protected $_auto = array ( 
       array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 公司id $_SESSION['company_id'])
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间
	   array('creat_name','getUsername',1,'callback'),  // 建立人   
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

   protected function  getUsername(){   // 得到Username
       return $_SESSION['username'];
   } 
}

        

                           