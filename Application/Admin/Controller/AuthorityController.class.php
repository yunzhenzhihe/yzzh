<?php
namespace Admin\Controller;
use Think\Controller;

//权限管理模块
class AuthorityController extends PublicController {
	
	function user_list(){   //用户列表
	
        $dao1 = M('auth_group');
		$map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
        $map1['branch_id'] = $_SESSION['branch_id'];		
		$list1=$dao1
			->where($map1)	
			->order(' CONVERT( title USING gbk ) asc ')
			->select();		
        $this->assign("group_list", $list1); //用户组	
		
        $dao2 = M('servicestaff');
		$map2['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
        $map2['branch_id'] = $_SESSION['branch_id'];		
		$list2=$dao2
			->where($map2)	
			->field('name')
			->order(' CONVERT( name USING gbk ) asc ')
			->select();		
        $this->assign("servicestaff_list", $list2); //用户组		

        $dao = M('user');	
		$map['a.company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['a.branch_id'] = $_SESSION['branch_id'];
		$list=$dao
		    ->alias('a')
			->field(array('a.id','a.username','a.mail','a.group_id','a.servicestaff','a.realname','a.status','a.status_info','a.status_time',
						  'a.creat_time','a.creat_name',
						  'b.title '))	
			->join( C('DB_PREFIX') . 'auth_group AS b ON a.group_id = b.group_id and b.company_id='.$_SESSION['company_id'] )			
			->where($map)
			->order(' CONVERT( title USING gbk ) asc , CONVERT( realname USING gbk ) asc ')
			->select();	
			
	   for ($j= 0;$j< count($list); $j++){  
		   if ( $list[$j]['status_time']=='0000-00-00 00:00:00' )  { 
				$list[$j]['status_time']=''  ;
		   }  				
		}	

        $this->assign("recordlist", $list); //数据循环变量	
		$this->assign( "selectrowslist", get_array_numberofrows() );  //选择每页显示多少行  select 下拉框的内容
        $this->display();	
	}

	function ajaxinsert(){	//添加	
		$email = trim($_POST['mail']);	 
		if(empty($email)){
			$this->ajaxReturn(0,"邮件地址不能为空",0);
		}
		if (  !( preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email) ) )  {
			$this->ajaxReturn(0,"邮件格式不正确",0);
		}	

		$password = trim($_POST['password']);
		$rpassword = trim($_POST['rpassword']);		

		if ( $password != $rpassword )  {
			$this->ajaxReturn(0,"两次密码输入不一样",0);
		} 			
		if (  !( preg_match("/^[A-Za-z0-9]+$/", $password) ) )  {	
			$this->ajaxReturn(0,"密码只能由字母和数字组成，不能有其它字符",0);
		}
		if ( ( strlen($password)<4 ) || ( strlen($password)>10 )  ) {
			$this->ajaxReturn(0,"密码长度大于4，小于10",0);
		}
		
		if (  trim($_POST['status'])  =='正常' ) {
			$_POST['status_info'] =='';
		} else {
			$_POST['status_time']=date('Y-m-d H:i:s');
		}
		
		if  (  !( empty($_POST['servicestaff']) ) )  {		
			if  ( !checkVarUniqueNoCompanyHaveId('user','servicestaff') ) {
				 $this->ajaxReturn(0,'【'.$_POST['servicestaff'].'】已经有登录用户名和密码，设置错误',0);
			}  			
		}	

		$_POST['password']=md5($password); 	//md5 加密

		$dao = D('User');  
        if (!$dao->create($_POST,1)){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $this->ajaxReturn(0,$dao->getError(),0);
        }
		else{                // 验证通过 可以进行其他数据操作          
		$rs = $dao->add(); // 根据条件保存添加的数据 	
		if ($rs) {
				/* 保存成功以后开始写操作日志   */
				   $data4['content'] = '登录用户名：'.trim($_POST['username']).'，操作：添加新用户'; 
				   $data4['branch_id'] = $_SESSION['branch_id'];
				   $data4['company_id'] = $_SESSION['company_id'];
				   $data4['creat_time'] = date('Y-m-d H:i:s');
				   $data4['creat_name'] = $_SESSION['username'];		   
				   $this->pub_process('Auth_log',$data4,'0'); // pub_process($ModuleName,&$Data,$flag)  写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
				/* 结束写 订单处理的流程明细  */				
              $this->ajaxReturn($rs,'',1);
        }
		else{
             $this->ajaxReturn(0,"添加数据失败！",0);
        }		   		  		  		   
       } 		
	}
	
	function ajaxedit(){  //修改查询
		$dao = M('user');
        $map1['id'] = array("EQ",(int)$_POST['id']);  
        $map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
	    $rs=$dao
		    ->where($map1)
			->field(array('id','username','mail','group_id','servicestaff','realname','status','status_info'))	
			->find();	 		
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		     $this->ajaxReturn(0,"读数据失败！请刷新重试",0);
		}
        else {
			 $rs['password']='9999';
			 $rs['rpassword']='9999';
		     $this->ajaxReturn($rs,"读数据成功！",1);
		} 			
	}	

	function ajaxsave(){  //修改保存
		$dao = M('User');
		if  (  !( isset($_POST['id']) ) )  {		//当 $_POST['id'] 不存在  就错误返回	
			$this->ajaxReturn(0,'数据保存失败，请刷新重试',0);  //删除数据失败
		}	

		$id=I('id');	//组ID	
		$username = $dao->where('id='.$id)->getField('username');

		if ( $username =='admin') {  //系统管理员不能被删除
			$this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
		}	
		
		$email = trim($_POST['mail']);	 
		if(empty($email)){
			$this->ajaxReturn(0,"邮件地址不能为空",0);
		}
		if (  !( preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email) ) )  {
			$this->ajaxReturn(0,"邮件格式不正确",0);
		}		
		
		if (  trim($_POST['status'])  =='正常' ) {
			$_POST['status_info'] =='';
			$_POST['status_time']='0000-00-00 00:00:00';
		} else {
			$_POST['status_time']=date('Y-m-d H:i:s');
		}	
		
		if  (  !( empty($_POST['servicestaff']) ) )  {		
			if  ( !checkVarUniqueNoCompanyHaveId('user','servicestaff') ) {
				 $this->ajaxReturn(0,'【'.$_POST['servicestaff'].'】已经有登录用户名和密码，设置错误',0);
			}  			
		}

        $dao = M('User');
		if  ( !checkVarUniqueNoCompanyHaveId('user','mail') ) {
			 $this->ajaxReturn(0,'注册邮箱重复(本公司或者是别的公司注册已经使用),请换一个邮箱重试',0);
		}    
		else{
		    $map['id'] = array("EQ",(int)$_POST['id']);  
			$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
			$map['branch_id'] = $_SESSION['branch_id'];	
			$data['mail'] =$_POST['mail'] ;
			$data['group_id'] =$_POST['group_id'] ;
			$data['realname'] =$_POST['realname'] ;
			$data['status'] =$_POST['status'] ;
			$data['status_info'] =$_POST['status_info'] ;
			$data['status_time'] =$_POST['status_time'] ;
			$data['servicestaff'] =$_POST['servicestaff'] ;
			$rs=$dao->where($map)->save($data); 	// 根据条件保存修改的数据 
		    if (!($rs)) {
				$this->ajaxReturn(0,'数据保存失败或者没有变化不需要保存，请刷新重试',0);  //保存失败
		    }
            else {
				
				/* 保存成功以后开始写操作日志   */
				   $data4['content'] = '登录用户名：'.$username.'，操作：用户权限或者资料被修改'; 
				   $data4['branch_id'] = $_SESSION['branch_id'];
				   $data4['company_id'] = $_SESSION['company_id'];
				   $data4['creat_time'] = date('Y-m-d H:i:s');
				   $data4['creat_name'] = $_SESSION['username'];		   
				   $this->pub_process('Auth_log',$data4,'0'); // pub_process($ModuleName,&$Data,$flag)  写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
				/* 结束写 订单处理的流程明细  */					
				
			  $this->ajaxReturn(1,"写数据成功！",1);   //保存数据成功
		    } 
	    }		
	}

	function ajaxdel(){	 //删除
	   if  (  !( isset($_POST['id']) ) )  {		//当 $_POST['id'] 不存在  就错误返回	
			$this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
		}		
		$id=I('id');	//组ID	
		$dao = M("user"); // 实例化User对象
		$username = $dao->where('id='.$id)->getField('username');

		if ( $username =='admin') {  //系统管理员不能被删除
			$this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
		}	

		$dao = M('user');	
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
			/* 保存成功以后开始写操作日志   */
			   $data4['content'] = '登录用户名：'.$username.'，操作：用户被删除'; 
			   $data4['branch_id'] = $_SESSION['branch_id'];
			   $data4['company_id'] = $_SESSION['company_id'];
			   $data4['creat_time'] = date('Y-m-d H:i:s');
			   $data4['creat_name'] = $_SESSION['username'];		   
			   $this->pub_process('Auth_log',$data4,'0'); // pub_process($ModuleName,&$Data,$flag)  写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
			/* 结束写 订单处理的流程明细  */			
		   $this->ajaxReturn(1,"删除数据成功！",1);   //删除成功，在这里可以记录删除的日志，什么时间，删除了那个表的数据，是谁删除的等等
		} 			
	   
    }
	
	function authgroup_list(){   //用户组（角色）
        $dao = M('auth_group');
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
        $map['branch_id'] = $_SESSION['branch_id'];		
		$list=$dao
			->where($map)	
			->order(' CONVERT( title USING gbk ) asc ')
			->select();	
	
        $this->assign("recordlist", $list); //数据循环变量	
        $this->display();		
	}	

	function authgroup_add(){   //添加新用户组（角色）
    	if(!empty($_POST)){
			$_POST['title']=trim($_POST['title']);
			if (!(I('title'))) { 
			    $this->error('用户组（角色）名称不能为空');
				return;
			} 
			
		  if ( !checkVarUnique('auth_group','title') ) {
			    $this->error('用户（角色）组名称重复');
				return;			  
		  }  	  	

    		$data['rules'] = I('rules');
    		$m = M('auth_group');
    		$data['title'] = I('title');
    		$data['rules'] = implode(',', $data['rules']);
			$data['branch_id'] = $_SESSION['branch_id'];
		    $data['company_id'] = $_SESSION['company_id'];
			$data['group_id'] =get_rand_string(8,1) ;
			$data['creat_time'] = date('Y-m-d H:i:s');
    		if($m->add($data)){
				/* 保存成功以后开始写操作日志   */
				   $data4['content'] = '用户（角色）组：'.$_POST['title'].'，操作：添加新用户（角色）组'; 
				   $data4['branch_id'] = $_SESSION['branch_id'];
				   $data4['company_id'] = $_SESSION['company_id'];
				   $data4['creat_time'] = date('Y-m-d H:i:s');
				   $data4['creat_name'] = $_SESSION['username'];		   
				   $this->pub_process('Auth_log',$data4,'0'); // pub_process($ModuleName,&$Data,$flag)  写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
				/* 结束写 订单处理的流程明细  */	
				$this->assign('jump_flag','true');	
    			$this->success('添加成功，继续添加或者关闭本页面');
				return;
    		}else{
    			$this->error('添加失败');
				return;
    		}
    	}else{
			$m = M('auth_rule');
			$data = $m->field('id,name,title')->where('pid=0')->order(' sort asc ')->select();
			foreach ($data as $k=>$v){
				$data[$k]['sub'] = $m->field('id,name,title')->where('pid='.$v['id'])->order(' sort asc ')->select();
				for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
				  $data[$k]['sub'][$i]['sub1'] = $m->field('id,name,title')->where('pid='.$data[$k]['sub'][$i]['id'])->order(' sort asc ')->select();	
				} 		
			}
			$this->assign('data',$data);	// 顶级		
			$this->display();	
    	}	
	}
	
    //编辑组
    public function group_edit(){
    	$m = M('auth_group');
    	if(!empty($_POST)){
			$_POST['title']=trim($_POST['title']);
			if (!(I('title'))) { 
			    $this->error('用户（角色）组不能为空');
				return;
			} 	
		  if ( !checkVarUnique('auth_group','title') ) {
			    $this->error('用户（角色）组名称重复');
				return;			  
		  } 			
    		$data['title'] = I('title');
    		$data['rules'] = implode(',', I('rules'));			
    		$where['id'] = I('id');	//组ID
			$where['branch_id'] = $_SESSION['branch_id'];
		    $where['company_id'] = $_SESSION['company_id'];		
			$where['group_id'] =  array('neq',10);		 //系统管理员组不能被修改	
    		if($m->where($where)->save($data)){
				/* 保存成功以后开始写操作日志   */
				   $data4['content'] = '用户（角色）组：'.$_POST['title'].'，操作：修改用户（角色）组名称或者权限'; 
				   $data4['branch_id'] = $_SESSION['branch_id'];
				   $data4['company_id'] = $_SESSION['company_id'];
				   $data4['creat_time'] = date('Y-m-d H:i:s');
				   $data4['creat_name'] = $_SESSION['username'];		   
				   $this->pub_process('Auth_log',$data4,'0'); // pub_process($ModuleName,&$Data,$flag)  写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
				/* 结束写 订单处理的流程明细  */
				$this->assign('jump_flag','true');	
    			$this->success('修改成功');
				return;
    		}else{
    			$this->error('修改失败');
				return;
    		}
    	}else{
    		$where['id'] = I('id');	//组ID
			$where['branch_id'] = $_SESSION['branch_id'];
		    $where['company_id'] = $_SESSION['company_id'];	
            $where['group_id'] =  array('neq',10);		 //系统管理员组不能被修改	
    		$reuslt = $m->field('id,title,rules')->where($where)->find();
		    if (!($reuslt)) {
				$this->error('修改失败');
				return;
		    }
    		$reuslt['rules'] = ','.$reuslt['rules'].',';
    		$this->assign('reuslt',$reuslt);

			$m = M('auth_rule');
			$data = $m->field('id,name,title')->where('pid=0')->order(' sort asc ')->select();
			foreach ($data as $k=>$v){
				$data[$k]['sub'] = $m->field('id,name,title')->where('pid='.$v['id'])->order(' sort asc ')->select();
				for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
				  $data[$k]['sub'][$i]['sub1'] = $m->field('id,name,title')->where('pid='.$data[$k]['sub'][$i]['id'])->order(' sort asc ')->select();	
				} 		
			}
			$this->assign('data',$data);	// 顶级		
			$this->display();		
    	}
    }

  //  删除组
	function ajaxdelauthgroup(){	 //删除	
	   if  (  !( isset($_POST['id']) ) )  {		//当 $_POST['id'] 不存在  就错误返回	
			$this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
		}
		
		$id=I('id');	//组ID

		$dao = M("auth_group"); // 实例化auth_group对象
		$map['id'] = array("EQ",(int)$id) ;  
		$map['company_id'] = $_SESSION['company_id'];   //删除记录 限定在本公司id里面	
		$rs=$dao->where($map)->find();
		$group_id=$rs['group_id'];
	//	$group_id = $dao->where('id='.$id)->getField('group_id');
		
	   if ( empty($group_id) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		     $this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
		}	
		
		if ( $group_id =='10') {  //系统管理员组不能被删除
			$this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
		}

	    $dao1 = M('user');	
		$map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map1['branch_id'] = $_SESSION['branch_id'];
		$map1['group_id'] = $group_id;		
        $count = $dao1->where($map1)->count();    //计算总数

	   if ( $count <1)  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
				$dao1 = M('auth_group');	
				$map1['id'] = array("EQ",(int)$id) ;  
				$map1['company_id'] = $_SESSION['company_id'];   //删除记录 限定在本公司id里面	
				$rs1=$dao1->where($map1)->delete();
				if (!($rs1)) {			   
				  $this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
				}
				else {	
					/* 保存成功以后开始写操作日志   */
					   $data4['content'] = '用户（角色）组：'.$rs['title'].'，操作：删除用户（角色）组'; 
					   $data4['branch_id'] = $_SESSION['branch_id'];
					   $data4['company_id'] = $_SESSION['company_id'];
					   $data4['creat_time'] = date('Y-m-d H:i:s');
					   $data4['creat_name'] = $_SESSION['username'];		   
					   $this->pub_process('Auth_log',$data4,'0'); // pub_process($ModuleName,&$Data,$flag)  写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
					/* 结束写 订单处理的流程明细  */					
				   $this->ajaxReturn(1,"删除数据成功！",1);   //删除成功，在这里可以记录删除的日志，什么时间，删除了那个表的数据，是谁删除的等等
				} 			  
			  
		}
        else {
		     $this->ajaxReturn(0,"该用户（角色）组里面有".$count."个用户，不能被删除！",0);
		} 	
   }	
   
    public function auth_info(){
		$dao = M('user');
        $map1['id'] = array("EQ",(int)$_GET['id']);  
        $map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map1['group_id'] =  array('neq',10);		 //系统管理员组不能被显示
	    $rs=$dao
		    ->where($map1)
			->field(array('id','username','mail','group_id','servicestaff','realname','status'))	
			->find();	

		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
			$this->error('查询失败');
			return;
		}
		$this->assign('userinfo',$rs);
     
		$m = M('auth_group');
		$where['branch_id'] = $_SESSION['branch_id'];
		$where['company_id'] = $_SESSION['company_id'];	
		$where['group_id'] =  array('eq',$rs['group_id']);		
		$reuslt = $m->field('id,title,rules')->where($where)->find();
		if (!($reuslt)) {
			$this->error('查询失败');
			return;
		}						
		$reuslt['rules'] = ','.$reuslt['rules'].',';
		$this->assign('reuslt',$reuslt);

		$m = M('auth_rule');
		$data = $m->field('id,name,title')->where('pid=0')->order(' sort asc ')->select();
		foreach ($data as $k=>$v){
			$data[$k]['sub'] = $m->field('id,name,title')->where('pid='.$v['id'])->order(' sort asc ')->select();
			for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
			  $data[$k]['sub'][$i]['sub1'] = $m->field('id,name,title')->where('pid='.$data[$k]['sub'][$i]['id'])->order(' sort asc ')->select();	
			} 		
		}
		$this->assign('data',$data);	// 顶级		
		$this->assign('flag',$_GET['flag']);	// 是否显示全部的权限状态
		$this->display();		
    }   
   
 	function watchdog_auth(){   //账户操作日志	
	    $table_head_array = array( array('key'=>"content", 'value'=>"日志内容", 'number'=>3  , 'search'=>false  ),								   
							);								
		$i=4 ;			
		$table_head_array[] =  array('key'=>"creat_time", 'value'=>"操作时间", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;		
		$table_head_array[] =  array('key'=>"creat_name", 'value'=>"操作人", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;		
		
		$this->assign("table_head", $table_head_array); //表头循环变量	

        $this->assign("btn_flag1", 'dark'); //	按钮颜色  purple	
		
		$date_begin = $_GET['date_begin'];  //开始时间
		$date_end = $_GET['date_end'];  //截止时间

		if ( !(isdate($date_begin)&&isdate($date_end)) ) {  //判断过来的起始截至日期是否合法
		         $this->display();   //退出 什么都不做
				 return;	
         }	
		 			
        $dao = M("auth_log");
        // import("@.ORG.Page");  //3.1.3       //导入分页类
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['branch_id'] = $_SESSION['branch_id'];
		$map['creat_time']  = array('between',array($date_begin.' 00:00:00',$date_end.' 23:59:59'));
			
        $count = $dao->where($map)->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页

		$list=$dao		
			->where($map)	
			->field(array('content','creat_time','creat_name'  ))	
			->order(' creat_time DESC')
			->limit($p->firstRow.','.$p->listRows)
			->select();		
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);

        $this->assign("recordlist", $list); //数据循环变量	
		$this->assign("date_begin", $date_begin);
		$this->assign("date_end", $date_end);	
		$this->assign("btn_flag1", 'purple'); //	按钮颜色  purple	
        $this->display();
	}	  
   
   
   

	
}