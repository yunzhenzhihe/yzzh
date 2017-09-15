<?php
namespace Home\Model;
use Think\Model;

// 引入RelationModel类
import('RelationModel');
// 必需继承RelationModel模型类  RelationModel
class OrderModel extends RelationModel{
 /* protected $_link = array(  //关联模式 从属
      'Group'=>array(
            'mapping_type' =>BELONGS_TO,
            'class_name'  =>'Group',
			'foreign_key'=>'cat_id',   //		Group中的cat_id 必须设置成主键
			'mapping_name'=>'Group',
            'as_fields'=>'cat_name',
      ),
    ) ;  */
	
	
	// 自动完成
  protected $_auto = array ( 
       array('company_id','getCompany_id',1,'callback'),  // 新增的时候把company_id字段设置为 公司id $_SESSION['company_id'])
	   array('company_name','getCompany_name',1,'callback'),  // 新增的时候把company_name字段设置为 公司名称  $_SESSION['company_name'])
	   array('guid','getGuid',1,'callback'),  // 新增的时候写入一个随机数 唯一识别码
	   array('order_status','待处理'),  // 订单状态,在新增的时候,赋值 待处理状态
	   array('order_sn','getRand_string',1,'callback'),  // 新增的时候把订单编号字段写入一个数字随机数 唯一识别码
	   array('creat_time','getDateTime',1,'callback'),  // 建立时间
	   array('creat_name','getUsername',1,'callback'),  // 建立人	   
	   array('last_change_time','getDateTime',3,'callback'),  // 最后修改时间
	   array('last_change_name','getUsername',3,'callback'),  // 最后修改人  	
    );
	
  protected function  getCompany_id(){   // 得到company_id session值
       return $_SESSION['company_id'];
   }	
   
   protected function  getCompany_name(){   // 得到company_id session值
       return $_SESSION['company_name'];
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

    protected function  getRand_string(){   // 得到6位的数字随机数  这个是订单号,在整个数据库里面,这个数据不一定是一个惟一数,不能做惟一数来做查询 如果要查询,结合公司id  订单的时间段,不要用find  用select
       return get_rand_string(6,1);
   }     
     
}

        

                           