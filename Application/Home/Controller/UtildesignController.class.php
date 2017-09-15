<?php
namespace Home\Controller;
use Think\Controller;

// 报表设计模块
class UtildesignController extends PublicController {
	
    function _initialize() {		
     // 'MINIFY'=>true,  //压缩 设置 
	  C('MINIFY',false);
  }	
	

	function utildesign_salesrecord(){  // 设计修改销售单格式	
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}	
		
	   if ( $_SESSION['action_err_info'] !='' ) {   //如果 装入系统默认的模板 这个变量不为空 
		    $dao1 = M('reportglobalprogramcodes');   //全局的参数
			$map1['flag'] = 1;  	
            $rs1=$dao1
			 ->field(array('report_programcodes'))
			  ->where($map1)->find();	 
			if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
					$this->error('操作失败，请刷新重试');  //错误
			        return;
			} else {
				   $this->assign("report_programcodes", $rs1['report_programcodes']); 
			}
			$_SESSION['action_err_info']='';  
			$this->display();	
			return;
		}

		$report_programcodes=get_reportprogramcodes(1);  //取出报表程序代码
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_programcodes", $report_programcodes); 
		}

	    $this->display();	
	}
 
	function ajax_programcodes(){  //保存 修改打印参数		
		$find='<br>';
        $replace=' ' ;
		$_POST['report_programcodes'] = str_replace($find, $replace, $_POST['report_programcodes']);
		
		$find='“';
        $replace='"';
		$_POST['report_programcodes'] = str_replace($find, $replace, $_POST['report_programcodes']);
	
		$dao = M('reportprogramcodes');
		$map['flag'] = array("EQ",(int)$_POST['flag']);  		
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
	    $map['branch_id'] = $_SESSION['branch_id'];
		$data['report_programcodes']= $_POST['report_programcodes'] ;
		$rs=$dao
			 ->field(array('id'))
			  ->where($map)->find();	
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		    $data['flag']= (int)$_POST['flag'] ;
			$data['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
			$data['branch_id'] = $_SESSION['branch_id'];						
		    $rs1 = $dao->add($data); // 根据条件保存添加的数据 	
		} else {
			$rs1=$dao->where($map)->save($data); 	// 根据条件保存修改的数据   
		}
		
		// \Think\Log::write('调试的SQL：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去
		 
		//cho $dao->getLastSql();
		//cho $dao->getLastSql();

	//	if (!($rs1)) {
	//		$this->ajaxReturn(0,$dao->getLastSql(),0);  //保存失败
	//	}
	//	else {
	//	  $this->ajaxReturn(1,$dao->getLastSql(),1);   //保存数据成功
	//	} 
		if (!($rs1)) {
			$this->ajaxReturn(0,'数据保存失败或者没有变化不需要保存，请刷新重试',0);  //保存失败
		}
		else {
		  $this->ajaxReturn(1,"保存数据成功！",1);   //保存数据成功
		} 
	
	}

	function ajaxload_programcodes(){  //取出默认的参数		
         $_SESSION['action_err_info']='ok';  
	     $this->ajaxReturn(1,"读数据成功！如果修改了别忘了点修改确认按钮",1);   //保存数据成功
	}

	function utildesign_servicerecord(){  // 设计修改售后服务单格式
	   $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}	
		
	  if ( $_SESSION['action_err_info'] !='' ) {   // 如果 装入系统默认的模板 这个变量不为空 
		    $dao1 = M('reportglobalprogramcodes');   //全局的参数
			$map1['flag'] = 2;  	
            $rs1=$dao1
			 ->field(array('report_programcodes'))
			  ->where($map1)->find();	 
			if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
					$this->error('操作失败，请刷新重试');  //错误
			        return;
			} else {
				   $this->assign("report_programcodes", $rs1['report_programcodes']); 
			}
			$_SESSION['action_err_info']='';  
			$this->display();	
			return;
		}

		$report_programcodes=get_reportprogramcodes(2);  //取出报表程序代码
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_programcodes", $report_programcodes); 
		}

	    $this->display();	
	}

	function utildesign_stockinrecord(){  // 设计入库单格式	
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}	
		
	   if ( $_SESSION['action_err_info'] !='' ) {   //如果 装入系统默认的模板 这个变量不为空 
		    $dao1 = M('reportglobalprogramcodes');   //全局的参数
			$map1['flag'] = 3;  	
            $rs1=$dao1
			 ->field(array('report_programcodes'))
			  ->where($map1)->find();	 
			if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
					$this->error('操作失败，请刷新重试');  //错误
			        return;
			} else {
				   $this->assign("report_programcodes", $rs1['report_programcodes']); 
			}
			$_SESSION['action_err_info']='';  
			$this->display();	
			return;
		}

		$report_programcodes=get_reportprogramcodes(3);  //取出报表程序代码
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_programcodes", $report_programcodes); 
		}
		
	    $this->display();	
	}	
	
	function utildesign_stockservicestaffoutrecord(){  // 设计领料单格式	
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}	
	
	   if ( $_SESSION['action_err_info'] !='' ) {   //如果 装入系统默认的模板 这个变量不为空 
		    $dao1 = M('reportglobalprogramcodes');   //全局的参数
			$map1['flag'] = 4;  	
            $rs1=$dao1
			 ->field(array('report_programcodes'))
			  ->where($map1)->find();	 
			if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
					$this->error('操作失败，请刷新重试');  //错误
			        return;
			} else {
				   $this->assign("report_programcodes", $rs1['report_programcodes']); 
			}
			$_SESSION['action_err_info']='';  
			$this->display();	
			return;
		}

		$report_programcodes=get_reportprogramcodes(4);  //取出报表程序代码
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_programcodes", $report_programcodes); 
		}
		
	    $this->display();	
	}	
	
	function utildesign_stockservicestaffinrecord(){  // 设计退料单格式	
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}	
	
	   if ( $_SESSION['action_err_info'] !='' ) {   //如果 装入系统默认的模板 这个变量不为空 
		    $dao1 = M('reportglobalprogramcodes');   //全局的参数
			$map1['flag'] = 5;  	
            $rs1=$dao1
			 ->field(array('report_programcodes'))
			  ->where($map1)->find();	 
			if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
					$this->error('操作失败，请刷新重试');  //错误
			        return;
			} else {
				   $this->assign("report_programcodes", $rs1['report_programcodes']); 
			}
			$_SESSION['action_err_info']='';  
			$this->display();	
			return;
		}

		$report_programcodes=get_reportprogramcodes(5);  //取出报表程序代码
		//		$this->error($report_programcodes);  //错误
		//	return;	
		
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_programcodes", $report_programcodes); 
		}
		
	    $this->display();	
	}	
	
	
	
}