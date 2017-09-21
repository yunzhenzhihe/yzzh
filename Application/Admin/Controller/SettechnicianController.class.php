<?php
namespace Admin\Controller;
use Think\Controller;

//设置技术人员
class SettechnicianController extends PublicController {
 
	function technician_list(){   //技术人员 ajax方法处理分页	
        $dao = M('technician');
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	

		// import("@.ORG.Page");  //3.1.3       //导入分页类		
		$count = $dao->where($map)->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页
				
		$list=$dao
			->where($map)	
			->order('  CONVERT( number USING gbk ) asc,CONVERT( name USING gbk ) asc ')
			->limit($p->firstRow.','.$p->listRows)			
			->select();	
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);				
        $this->assign("recordlist", $list); //数据循环变量	
		$this->assign( "selectrowslist", get_array_numberofrows() );  //选择每页显示多少行  select 下拉框的内容
        $this->display();		
	}	
	
	function ajaxinsert(){	//添加	
	   $this->pub_add('Technician');
	}
	
	function ajaxedit(){  //修改查询
        $this->pub_edit('technician');			
	}	
		
	function ajaxsave(){  //修改保存
	 $this->pub_save('Technician');
	}

	function ajaxdel(){	 //删除
	   $this->pub_del('technician');
    }
	

}