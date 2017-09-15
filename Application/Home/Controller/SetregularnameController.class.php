<?php
namespace Home\Controller;
use Think\Controller;

//设置提醒项目
class SetregularnameController extends PublicController {
 
	function regularname_list(){   //提醒项目 ajax方法处理分页	
        $dao = M("regularname");
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面		      	
		$list=$dao
			->where($map)	
			->order(' CONVERT( name USING gbk ) asc ')
			->select();		
        $this->assign("recordlist", $list); //数据循环变量	
        $this->display();		
	}	
	
	function ajaxinsert(){	//添加	
	   $this->pub_add('Regularname');
	}
	
	function ajaxedit(){  //修改查询
        $this->pub_edit('regularname');			
	}	
		
	function ajaxsave(){  //修改保存
	 $this->pub_save('Regularname');
	}

	function ajaxdel(){	 //删除
	   $this->pub_del('regularname');
    }
	

}