<?php
namespace Admin\Controller;
use Think\Controller;

//设置计量单位
class SetunitController extends PublicController {
 
	function unit_list(){   //计量单位 ajax方法处理分页	
        $dao = M("unit");
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面		      	
		$list=$dao
			->where($map)	
			->order(' CONVERT( name USING gbk ) asc ')
			->select();		
        $this->assign("recordlist", $list); //数据循环变量	
        $this->display();		
	}	
	
	function ajaxinsert(){	//添加	
	   $this->pub_add('Unit');
	}
	
	function ajaxedit(){  //修改查询
        $this->pub_edit('unit');			
	}	
		
	function ajaxsave(){  //修改保存
	 $this->pub_save('Unit');
	}

	function ajaxdel(){	 //删除
	   $this->pub_del('unit');
    }
	

}