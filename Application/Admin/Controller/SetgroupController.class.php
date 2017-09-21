<?php
namespace Admin\Controller;
use Think\Controller;

//客户组管理模块
class SetgroupController extends PublicController {

	public function group_list()
	{			
        $this->tabletotree('group','parent_id asc,CONVERT( cat_name USING gbk ) asc','cat_id','cat_name');   //客户组-->数组  tree		
		$this->assign("grouplist", $this->tree); //数据循环变量	
        $this->display();			
	}

	public  function ajaxinsert(){	//添加	
	    $this->pub_add('Group');
	}
	
	public function ajaxedit(){  //修改查询
        $this->pub_edit('group');			
	}	
		
	public function ajaxsave(){  //修改保存
	  //  $this->pub_save('Group');
	   $map1['id'] = array("EQ",$_POST['id']);  
	   $map1['cat_id'] = array("EQ",$_POST['parent_id']);  
       $map1['company_id'] = $_SESSION['company_id'];   //  限定在本公司id里面	 判断是不是本级的重复 就是自己充当自己的上级
	   	   
	   if ($this->pub_find('group',$map1) !=0) {
		   $this->ajaxReturn(0,'本级不能充当本机的上级分类 修改失败',0);  
	   } else {
	      $this->pub_save('Group');
	   } 
    }	  
	
	public function ajaxdel(){	
	   $map1['parent_id'] = array("EQ",$_POST['cat_id']);  
       $map1['company_id'] = $_SESSION['company_id'];   //  限定在本公司id里面	 判断有没有下级目录     
	   $map2['cat_id'] = array("EQ",$_POST['cat_id']);  
       $map2['company_id'] = $_SESSION['company_id'];   //  限定在本公司id里面	 判断有没有客户   	   	   
	   if ($this->pub_find('group',$map1) !=0) {
		   $this->ajaxReturn(0,'有下级客户分组 不可以删除',0);  
	   } else if  ($this->pub_find('customer',$map2) !=0) {
		   $this->ajaxReturn(0,'本客户分组里面有客户 不可以删除',0);  
	   } else {
	       $this->pub_del('group');	// 没有下级分类，本分类里面没有客户 可以删除
	   } 
    }
	
}	


	
	 
