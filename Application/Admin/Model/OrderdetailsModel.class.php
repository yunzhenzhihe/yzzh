<?php
namespace Admin\Model;
use Think\Model;

class OrderdetailsModel extends Model {
	// 自动验证设置
  protected $_validate	 =	 array(		
	);
	// 自动完成
  protected $_auto = array (  //主键是guid的话,不能实现自动完成,这个是tp的一个bug 可能,现在用手工来实现自动完成, 	  	   
    ); 
}

        

                           