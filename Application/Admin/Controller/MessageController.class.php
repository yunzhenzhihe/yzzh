<?php
namespace Admin\Controller;
use Think\Controller;

//通知模块
class MessageController extends PublicController {
	function drivermessage_list(){   //司机通知  ajax方法处理分页			  
		if  (isset($_GET['NumberOfRows'])) {
	    	saveNumberOfRows();  //直接调用common.php 里面的函数  
		} 				         				
		//司机通知列表处理
        $dao = M("message");
        // import("@.ORG.Page");  //3.1.3       //导入分页类	
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面			
        $count = $dao->where($map)->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页
		$list=$dao->where($map)->order('time desc')->limit($p->firstRow.','.$p->listRows)->select();		
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
        $this->assign("drivermessagelist", $list); //数据循环变量									
        if($this->isAjax()){//判断ajax请求
            exit($this->fetch('drivermessagelist'));
        } 
        $this->display();	
	}	
	
	function ajaxinsert(){	//添加	
	   $this->pub_add('Message');
	}
	
	function ajaxedit(){  //修改查询
        $this->pub_edit('message');			
	}	
		
	function ajaxsave(){  //修改保存
	 $this->pub_save('Message');
	}

	function ajaxdel(){	 //删除
	   $this->pub_del('message');
    }
	

}