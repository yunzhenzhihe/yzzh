<?php
namespace Admin\Model;
use Think\Model;

class RuleModel extends Model {
	// 自动验证设置
  protected $_validate	 =	 array(								
	);
	// 自动完成
  protected $_auto = array (
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('last_change_time','getDateTime',3,'callback'),  // 最后修改时间
	   array('last_change_name','getUsername',3,'callback'),  // 最后修改人  	   
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
 
}


	    // $aa=' name:'.$_POST['name'].
		    // ' phone:'.$_POST['phone'].
		    // ' mail:'.$_POST['mail'].
		    // ' company_name:'.$_POST['company_name'].   company_abbreviation
		    // ' company_address:'.$_POST['company_address'].			
		    // ' city:'.$_POST['city'].
		    // ' authcode:'.$_POST['authcode'].	
		    // ' lat:'.$_POST['lat'].
		    // ' lng:'.$_POST['lng'].	
		    // ' c_province:'.$_POST['c_province'].	
		    // ' c_city:'.$_POST['c_city'].
		    // ' c_county:'.$_POST['c_county'].
			// ' password:'.$password.
			// ' company_id:'.$company_id.
            // ' ip:'.get_real_ip();
			
		//	company_abbreviation
		
		



        

                           