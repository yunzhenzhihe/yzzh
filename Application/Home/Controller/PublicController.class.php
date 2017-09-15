<?php
namespace Home\Controller;
use Think\Controller;

// 公共类
class PublicController extends Controller {
	
    function _initialize() {		
        if  (!$_SESSION['company_id']) {   //公司id 为空转登陆页面 在这里也可以做权限验证  is_set('company_id')   (!$_SESSION['company_id'])
			if ( IS_AJAX ) {   //如果是ajax提交的
			    $_SESSION['company_id']=null ;
				$this->ajaxReturn(0,"错误，刷新重试。",0);
			} else {
				redirect(U('User/logout') )	;  
			}	
        }
		
		if (cookie('NumberOfRows')==null) {   //默认每页显示的数据行数 说明  cookie已经不在了
			redirect(U('User/login') )	;  
		}
		
		
	//	if( empty($_SESSION['city_lng']) ){  //判断是否是新注册用户 如果是转补全资料的界面
	//		redirect(U('User/userinfo') )	;  
	//	}

	    if  (isset($_GET['NumberOfRows'])) {
	    	saveNumberOfRows();  //直接调用common.php 里面的函数  
		} 
		
	    if (  (isset($_GET['company_id'])) ||  (isset($_POST['company_id']))  ){  //安全检测 如果从前端传过来 company_id   就是非法
			if ( IS_AJAX ) {   //如果是ajax提交的
			    $_SESSION['company_id']=null ;
				$this->ajaxReturn(0,"错误，刷新重试。",0);
			} else {
				redirect(U('User/logout') )	;  
			}			    	 
		} 
		
	//	$id=I('id');	
	//	$guid=I('guid');	
	//	$search_key=I('search_key');
	//	$search_txt=I('search_txt');
	//	str_ireplace("WORLD","Shanghai","Hello world!");
	/*
       if (  (isset($_GET['guid'])) ||  (isset($_POST['guid']))  ){  //安全检测 如果从前端传过来 company_id   就是非法
			if ( IS_AJAX ) {   //如果是ajax提交的
			    $_SESSION['company_id']=null ;
				$this->ajaxReturn(0,"错误，刷新重试。",0);
			} else {
				redirect(U('User/logout') )	;  
			}			    	 
		} 		 
	*/
		$this->assign( "selectrowslist", get_array_numberofrows() );  //选择每页显示多少行  select 下拉框的内容
		
		//开始做权限验证
		$action='/'.CONTROLLER_NAME.'/'.ACTION_NAME.'/'	;  //得到当前/当前模块名/当前操作名/  检索 这个变量是否有权限操作	

			
		
	//	\Think\Log::write('调试的$MODULE_NAME：'.MODULE_NAME);  
	//	\Think\Log::write('调试的MODULE_PATH：'.MODULE_PATH);  
	//	\Think\Log::write('调试的CONTROLLER_NAME：'.CONTROLLER_NAME);  
	//	\Think\Log::write('调试的CONTROLLER_PATH：'.CONTROLLER_PATH);  		
	//	\Think\Log::write('调试的ACTION_NAME：'.ACTION_NAME); 
		
	//	\Think\Log::write('调试的$action：'.$action);  
	//	\Think\Log::write('调试的allaction：'.session('group_allaction_rules'));  
	//	\Think\Log::write('调试的action：'.session('group_action_rules'));  
	//	\Think\Log::write('调试的strpos all：'.strpos(session('group_allaction_rules'),$action));  
	//	\Think\Log::write('调试的strpos：'.strpos(session('group_action_rules'),$action));  
		if(( session('group_id') != '10') && ( strpos(session('group_allaction_rules'),$action) > -1 ) && ( !strpos(session('group_action_rules'),$action)  ) ){
			if ( IS_AJAX ) {   //如果是ajax提交的
				$this->ajaxReturn(0,"您没有权限操作这个功能，请联系系统管理员做相关授权。",0);
			} else {
			   if ( $_SESSION['login_type'] =='Mobile' ) {//手机客户端登陆
					   $this->assign('jump_memo','Mobile');
			           $this->error('您没有权限操作这个功能');			        
				} else {
					  $this->error('您没有权限操作这个功能，请联系系统管理员做相关授权。');
				}
			}
		}
		//结束做权限验证
		
		
		//套餐验证 是否过期 是否超标
		if ((  $_SESSION['plan_date'] < date('Y-m-d') ) || ( (int)$_SESSION['count_total'] >  (int)$_SESSION['plan_count'] ) ){
		    redirect(U('User/money_info') )	;  
		}
		//套餐验证结束
		
		//开始检测有没有系统消息
		  $dao = M("notice");
		  $map['creat_time'] =  array('gt',$_SESSION['last_read_notice']);  
          $count = $dao->where($map)->count();    //计算总数
	//   $count=0;
		  if ( $count>0 ) {
			  $_SESSION['count_notice']  =$count;   ///系统信息数量
		  } else {
			  $_SESSION['count_notice']  ='';   ///公司信息数量	
		  }
		//结束检测系统消息

     }
	 	 	 
    var $tree=array();
	var $treelevel=0;  //数结构的层级
	var $treetotalcount=0; //客户的总数量
    var $cookietime = 15552000;   //180天 cook有效期  180*24*60*60
	
	function tabletotree($ModuleName,$OrderString,$id,$name)   //商品分类-->数组  tree  
	{
	   	$this->tree=   array(); //清空数组
		$Dao = M($ModuleName);
    	load('extend');
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$vo  = $Dao->where($map)->order($OrderString)->select();	
	//	$vo  = $Dao->order($OrderString)->select();	
		$list=list_to_tree($vo,$pk=$id,$pid='parent_id',$child='_child',0);
		$this->treetoary($list,$name);			
	}	

    function treetoary($list,$name,$level=0)   //商品分类-->数组  tree 递归
	{
	  foreach($list as $key=>$val)
	  {
		$tmp_str=str_repeat("&nbsp;&nbsp;",$level*2);
		if($level>0) {
			$tmp_str.="&nbsp;&nbsp;├";
		}
		$val[$name]=$tmp_str."&nbsp;&nbsp;".$val[$name];

		if(!array_key_exists('_child',$val)) {
		   array_push($this->tree,$val);
		}else{
			$tmp_ary = $val['_child'];
			unset($val['_child']);
		   array_push($this->tree,$val);
		   $this->treetoary($tmp_ary,$name,$level+1);
		}
	  }
	  return;
	}	
	
	function tabletotreetocount($ModuleName,$OrderString,$id,$name,$CountModuleName)   //分类-->数组 计算数据库里面客户的数量 tree  
	{
	   	$this->tree=   array(); //清空数组
		$this->treelevel=0;  //结构数的层级初始化
		$this->treetotalcount=0;  //客户的总数量清零
		$Dao = M($ModuleName);
    	load('extend');
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$vo  = $Dao->where($map)->order($OrderString)->select();	
	//	$vo  = $Dao->order($OrderString)->select();	
		$list=list_to_tree($vo,$pk=$id,$pid='parent_id',$child='_child',0);
		$this->treetoarytocount($list,$name,$id,$CountModuleName);				 		  
	}

    function treetototalcount()   //分类-->数组  tree 递归  计算数据库里面客户的总数量 
	{
	//   dump($this->tree);
	//   dump($this->treelevel);	   
		for  ( $level = $this->treelevel; $level >= 1; $level--) {  //开始计算各个分类里面的客户的合计  15层分类
		       	 foreach($this->tree as $key=>$val)
	                {
					  if ( $val['level']== $level ) {
						   $parent_id=$val['parent_id'];
						   $totalcount=$val['totalcount'];						   
						   		   foreach($this->tree as $key=>$val1)
									{
									  if ( $val1['cat_id']== $parent_id ) {
										   $this->tree[$key][totalcount]=$this->tree[$key][totalcount]+$totalcount;
										   break;
									   }
									}
					   }
					}		
		  }
		 foreach($this->tree as $key=>$val)
			{
			  if ( $val['totalcount']!= 0 ) {
                  $this->tree[$key][cat_name]=$this->tree[$key][cat_name]."(".$val['count']."/".$val['totalcount'].")";
			   }
			}	
	}	

    function treetoarytocount($list,$name,$id,$CountModuleName,$level=0)   //分类-->数组  tree 递归  计算数据库里面客户的数量 
	{
	  foreach($list as $key=>$val)
	  {
		$tmp_str=str_repeat("&nbsp;&nbsp;",$level*2);
		if($level>0) {
			$tmp_str.="&nbsp;&nbsp;├";
		}		
	    $dao = M($CountModuleName);
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['cat_id'] = array("EQ",$val[$id]); 
		$count = $dao->where($map)->count();    //计算总数
		$val['count'] =$count;
		$val['totalcount'] =$count;
		$this->treetotalcount=$this->treetotalcount+$count;  //总的客户数量
		$val['level'] =$level;
		if ( $level>$this->treelevel ) {
		$this->treelevel=$level;
		}
		$val[$name]=$tmp_str."&nbsp;&nbsp;".$val[$name];
		if(!array_key_exists('_child',$val)) {
		   array_push($this->tree,$val);
		}else{
			$tmp_ary = $val['_child'];
			unset($val['_child']);
		   array_push($this->tree,$val);
		   $this->treetoarytocount($tmp_ary,$name,$id,$CountModuleName,$level+1);
		}
	  }
	  return;
	}	

	function pub_add($ModuleName){  //添加	
		$dao = D($ModuleName);  
        if (!$dao->create($_POST,1)){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $this->ajaxReturn(0,$dao->getError(),0);
        }
		else{                // 验证通过 可以进行其他数据操作				
		$rs = $dao->add(); // 根据条件保存添加的数据 			
		if ($rs) {
              $this->ajaxReturn($rs,'',1);
        }
		else{
             $this->ajaxReturn(0,"添加数据失败！",0);
        }		   		  		  		   
       } 
    }	

	function pub_edit($ModuleName){  //修改查询
		$dao = M($ModuleName);
        $map1['id'] = array("EQ",(int)$_POST['id']);  
        $map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
	    $rs=$dao->where($map1)->find();	 		
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		     $this->ajaxReturn(0,"读数据失败！请刷新重试",0);
		}
        else {
		     $this->ajaxReturn($rs,"读数据成功！",1);
		} 	
	}	 
	
	function pub_save($ModuleName,$map=null){  //修改保存  必须要有  $_POST['id']
		$dao = D($ModuleName);		
		if  (  !( isset($_POST['id']) ) )  {		//当 $_POST['id'] 不存在  就错误返回	
			$this->ajaxReturn(0,'数据保存失败，请刷新重试',0);  //删除数据失败
		}		
		
        if (!$dao->create($_POST,2)){           
			$this->ajaxReturn(0,$dao->getError(),0);  // 创建失败 表示验证没有通过 输出错误提示信息	   	
        }
		else{
		    $map['id'] = array("EQ",(int)$_POST['id']);  
            $map['company_id'] = $_SESSION['company_id'];   //修改记录 限定在本公司id里面								
			$rs=$dao->where($map)->save(); 	// 根据条件保存修改的数据 
		    if (!($rs)) {
				$this->ajaxReturn(0,'数据保存失败或者没有变化不需要保存，请刷新重试',0);  //保存失败
		    }
            else {
			  $this->ajaxReturn(1,"写数据成功！",1);   //保存数据成功
		    } 
	    }	
	}	
	 	 
	function pub_del($ModuleName,$map=null)  {  //删除   必须要有  $_POST['id']
		$dao = M($ModuleName);	
		if  (  !( isset($_POST['id']) ) )  {		//当 $_POST['id'] 不存在  就错误返回	
			$this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
		}
        $map['id'] = array("EQ",(int)$_POST['id']) ;  
        $map['company_id'] = $_SESSION['company_id'];   //删除记录 限定在本公司id里面	
	    $rs=$dao->where($map)->delete();
		if (!($rs)) {
            $this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
    	}
        else {	
		   $this->ajaxReturn(1,"删除数据成功！",1);   //删除成功，在这里可以记录删除的日志，什么时间，删除了那个表的数据，是谁删除的等等
		} 		
	}

	function pub_find($ModuleName,$map1){  //查询某个条件的数据是否存在 非ajax调用 
		$dao = M($ModuleName);
	    $rs=$dao->where($map1)->find();	
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回0   否则 返回 查询结果
		     return 0 ;  
		}
        else {
		     return $rs ;
		} 	
	}
	
	function pub_find_guid($ModuleName,$FieldName){  //根据传过来的id 查询$FieldName值
		$dao = M($ModuleName);
        $map1['id'] = array("EQ",(int)$_POST['id']);  
        $map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
	    $rs=$dao->where($map1)->getField($FieldName);	 
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		     $this->ajaxReturn(0,"读数据失败！请刷新重试",0);
		}
        else {
		     $this->ajaxReturn($rs,"读数据成功！",1);
		} 	
	}	
	
	
	function pub_process($ModuleName,&$Data,$flag){  //写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
		$dao = D($ModuleName);  
		if  ($flag=='0') {
			$rs = $dao->add($Data); // 单个数据写入 
//Log::write('调试的SQL 1：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去			
		} else {
			$rs= $dao->addAll($Data); // 批量数据的写入	
//Log::write('调试的SQL 2：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去			
		}   		  		  		   
    }	
	
	function pub_customerdate($guid,$date,$flag){  //写客户最近来电日期  最近销售日期  最近售后日期  最近回访日期 $flag ： 1：来电  2：销售  3：售后  当删除的时候$date=0000-00-00
	    $dao = M('customer');
	    $map['guid'] = $guid;  
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['branch_id'] = $_SESSION['branch_id'];		
	    $map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
	    $map1['branch_id'] = $_SESSION['branch_id'];		
		if  ($flag=='1') {  //来电
               $dao1 = M('call_record');
			   $map1['call_customer_guid'] = $guid;  			   
			   $maxDate = $dao1->where($map1)->max('call_date');	
			   $typeDate='date_call';
		} else if   ($flag=='2') {  //销售		
               $dao1 = M('ordersale');
			   $map1['customer_guid'] = $guid;  			   
			   $maxDate = $dao1->where($map1)->max('date_sale');	
			   $typeDate='date_sales';
		} else if   ($flag=='3') {  //售后				
               $dao1 = M('orderservice');
			   $map1['customer_guid'] = $guid; 			   
			   $maxDate = $dao1->where($map1)->max('date_appointment');	
			   $typeDate='date_service';
		}
		if ( (is_null($maxDate))  ||  (!($maxDate)) )  {   //判断 如果查询结果是null 或者是 false 
		    $data[$typeDate] = $date;		
		} else {
			if  ( $maxDate > $date ) {
				$data[$typeDate] = $maxDate;					
			} else {
				$data[$typeDate] = $date;	
			}
		}
		$rs=$dao->where($map)->save($data); 	// 根据条件保存修改的数据 
	//	$this->pub_customerdate('96167E6C-EA6D-0601-830D-920C6088FF77','0000-00-00','3'); //修改客户的最近来电日期 
	//	Log::write('调试的dao1：'.$dao1->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去	
     //   Log::write('调试的dao：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去	
    }	

}





