<?php
namespace Home\Model;
use Think\Model;

class UserModel extends Model{	
	// 自动验证设置
  protected $_validate	 =	 array(
       // array('memo','checkStringLength_memo','备注的长度不能超过 255 个字',0,'callback'), 
        array('mail','checkUnique_mail','注册邮箱重复(本公司或者是别的公司注册已经使用),请换一个邮箱重试',1,'callback'),  	 
        array('username','checkUnique_username','用户名重复,请换一个重试',1,'callback'),  	
        array('username','checkStringLength_username','用户名不能为空，并且长度必须在 1-50 之间',1,'callback'), 		
	);	
	
	// 自动完成
  protected $_auto = array ( 
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('branch_id','getBranch_id',1,'callback'),  // 新增的时候把branch_id字段设置为 分支机构id  $_SESSION['branch_id'];
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间	
	   array('creat_name','getUsername',1,'callback'),  // 建立人 
       array('last_login_time','getDateTime',1,'callback'),  // 最近登陆时间
       array('last_ip','getIp',1,'callback'),  // 最近登陆ip地址	   	   
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

   protected function  getUsername(){   // 得到username  get_real_ip()
       return $_SESSION['username'];
   } 

   protected function checkUnique_mail(){   //判断邮件唯一性	
       return checkVarUniqueNoCompanyHaveId('user','mail')  ;    
   }  
   
   protected function checkUnique_username(){   //判断用户名唯一性	
       return checkVarUnique('user','username')  ;  	   
   }  

   protected function checkStringLength_username(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('username','1','150');    
   }    
   
   protected function getIp(){   //的到ip地址	
       return get_real_ip()  ;    
   }
}

        

                           