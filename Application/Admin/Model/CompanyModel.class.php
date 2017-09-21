<?php
namespace Admin\Model;
use Think\Model;

class CompanyModel extends Model {
	// 自动验证设置
  protected $_validate	 =	 array(								
	);
	// 自动完成
  protected $_auto = array ( 
    );
	
  protected function checkStringLength_name(){   //判断字符串的长度是否在一个范围内  
	   return checkStringLength('goods_name','1','100');    
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
		
		



        

                           