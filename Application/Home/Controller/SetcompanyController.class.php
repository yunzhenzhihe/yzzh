<?php
namespace Home\Controller;
use Think\Controller;

//公司信息管理模块
class SetcompanyController extends PublicController {
    public function user_info(){  //登录用户信息
		$dao = M('user');
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['username'] = $_SESSION['loginname'];  
	    $rs=$dao
		    ->where($map)
			->field(array('id','username','mail','group_id','servicestaff','realname','status'))	
			->find();	

		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
			$this->error('查询失败');
			return;
		}
		$this->assign('userinfo',$rs);
	    if ($rs['group_id'] != 10 ) {  //如果不是超级用户  就生成权限列表
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
		}
		$this->assign('data',$data);	// 顶级		
		$this->assign('flag',$_GET['flag']);	// 是否显示全部的权限状态
		$this->display();			
	
    }  	
	
	function company_info(){   //公司信息
		$map['company_id'] = array("EQ",$_SESSION['company_id']);  //基准地图的修改
		$dao = M('company');			
		$rs=$dao
		    ->field(array('name','phone','mail','mail','mail','company_name','s_province','s_city','s_county','company_address','company_abbreviation','creat_date'))
			->where($map)
			->find();	
	   if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败 
		     $this->error('操作失败，请刷新重试');
			 return;
		}
		$this->assign("user", $rs); 	///公司信息
        $this->display();	       			
	}	
	
	function money_info(){   //软件付费明细		
		$table_head_array = array( array('key'=>"order_number", 'value'=>"订单编号", 'number'=>2  , 'search'=>false   ),									   
							);		
		$i=3 ;	
		$table_head_array[] =  array('key'=>"date_received", 'value'=>"付款日期", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"plan_name", 'value'=>"套餐名称", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"plan_type", 'value'=>"付款类型", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"quantity", 'value'=>"数量", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"price", 'value'=>"单价", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"money", 'value'=>"金额", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;
		$table_head_array[] =  array('key'=>"buy_way", 'value'=>"付款方式", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"date_planbegin", 'value'=>"套餐开始", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"date_planend", 'value'=>"套餐截至", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		
		
	
		$this->assign("table_head", $table_head_array); //表头循环变量	

		$dao = M("admin_money");
		// import("@.ORG.Page");  //3.1.3       //导入分页类
		// $map['a.company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面		
	    $map['a.companyid'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	 2016-08-29 修正
		$list=$dao	
			->alias('a')
			->field(array('a.order_number','a.plan_id','a.plan_type','a.quantity','a.price','a.money','a.date_planbegin','a.date_planend','a.date_received','a.buy_way',
						  'a.memo',
						  'b.plan_name ','b.count_record'))							  
			->join( C('DB_PREFIX') . 'admin_price AS b ON a.plan_id = b.plan_id ' )				
			->where($map)			
			->order('a.creat_time DESC '  )  
			->select();	
		$this->assign("recordlist", $list); //数据循环变量				
        $this->display();	
	}	

	function companyinfo(){   //公司信息  参数设置里面 修改缩写
		$map['company_id'] = array("EQ",$_SESSION['company_id']);  //基准地图的修改
		$dao = M('company');			
		$rs=$dao
		    ->field(array('name','phone','mail','mail','mail','company_name','s_province','s_city','s_county','company_address','company_abbreviation','creat_date'))
			->where($map)
			->find();	
	   if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败 
		     $this->error('操作失败，请刷新重试');
			 return;
		}
		$this->assign("user", $rs); 	///公司信息
        $this->display();	       			
	}	
	
	function ajaxsave(){  //修改保存
		$company_abbreviation = $_POST['company_abbreviation'];
		$map1['company_id'] = array("EQ",$_SESSION['company_id']);  
		$dao1 = M('company');			
		$rs1=$dao1->field(array('id'))->where($map1)->find();	
	    if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败 
		     $this->ajaxReturn(0,"数据错误，请刷新重试",0);	
		}		

	    $dao = M('Company');  	
		$data['company_abbreviation'] = $company_abbreviation ;  //公司缩写
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['id'] = $rs1['id'];   // 
		$rs = $dao->where($map)->save($data); // 根据条件保存数据 	
		if( $rs ){   //成功		
			 $_SESSION['company_name'] = $company_abbreviation;  
			 $this->ajaxReturn(1,'数据保存成功，所有客户端退出软件，重新登录，数据才会生效',1);				    								
		 } else{    //失败	
			$this->ajaxReturn(0,"数据保存失败或者没有变化不需要保存，请刷新重试",0);					
		 }	
	}

	function questions_list(){   //答疑、建议、反馈处理
	    $table_head_array = array( array('key'=>"creat_time", 'value'=>"日期", 'number'=>2  , 'search'=>false   ),									   
							);		
		$i=3 ;
		
		$table_head_array[] =  array('key'=>"status", 'value'=>"状态", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		
		$table_head_array[] =  array('key'=>"question_type", 'value'=>"类型", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		
		$table_head_array[] =  array('key'=>"memo", 'value'=>"内容", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		
		$table_head_array[] =  array('key'=>"creat_name", 'value'=>"提交人", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		

		$this->assign("table_head", $table_head_array); //表头循环变量	
        $this->assign("table_head_startnumber", 2); //表头起始行号
        $this->assign("table_head_endnumber", $i); //表头截至行号	
		

        $dao = M("question");
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['branch_id'] = $_SESSION['branch_id'];
		$map['loginname'] = $_SESSION['loginname'];  //登录的用户名	  各人查询个人的问题 和公司的问题做区别
		// import("@.ORG.Page");  //3.1.3       //导入分页类
        $count = $dao->where($map)->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页		
		$list=$dao		
			->where($map)
			->order(' creat_time DESC ')			
			->limit($p->firstRow.','.$p->listRows)
			->select();			
			
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
        $this->assign("recordlist", $list); //数据循环变量	
        $this->display();	
    }
	
	function questions_info(){   //答疑、建议、反馈处理
	   if  (!isset($_GET['id'])) {  //如果没有guid值 就返回  order_guid
			 $this->error('操作失败，请刷新重试');	
		     return;
		}

		$dao = M('question');	
		$map['id'] = array("EQ",(int)$_GET['id']); 
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['branch_id'] = $_SESSION['branch_id'];		
		$rs=$dao		
			->where($map)
			->find();	
		if (!($rs)) {
			 $this->error('操作失败，请退出重试');	
		}
		else {
			$dao1 = M("questiondetails");
			$map1['order_guid'] = $rs['guid'];   // 查询记录 限定在本公司id里面	
			$map1['company_id'] = $rs['company_id'];   // 查询记录 限定在本公司id里面	
			$map1['branch_id'] = $rs['branch_id'];
			$rs1=$dao1->where($map1)->order(' creat_time ASC ')->select(); 

		for ($j= 0;$j< count($rs1); $j++){  ////实现把文本中的URL转换为链接
		    if ( $rs1[$j]['creat_name'] !='')  {
				$rs1[$j]['memo']=get_autolink($rs1[$j]['memo'], array("target"=>"_blank","rel"=>"nofollow"));		
			}			
		}			
			
			$this->assign("question_info", $rs); //订单的操作记录
			$this->assign("questiondetails_list", $rs1); //订单的操作记录				
		    $this->display();	 	
		}	
    }	
	

	function questions_add(){   //保存数据答疑、建议、反馈
		if (  (!isset($_POST['question_type'])) || (!isset($_POST['memo']))   )   { 
		   $this->ajaxReturn(0,"操作数据失败,请刷新重试！",0);
		} else {
            $dao = M('question');
			$data['guid'] =get_guid() ;
			$data['question_type'] =I('question_type') ;
			$data['memo'] =I('memo') ;
			$data['status'] ='待处理' ;
		    $data['branch_id'] = $_SESSION['branch_id'];
		    $data['company_id'] = $_SESSION['company_id'];
		    $data['creat_time'] = date('Y-m-d H:i:s');
			$data['question_time'] = date('Y-m-d H:i:s');
			$data['loginname'] = $_SESSION['loginname'];  //登录的用户名	
		    $data['creat_name'] = $_SESSION['username'];	//实名
			$rs=$dao->add($data); 
			if( $rs ){   //成功		
				 $this->ajaxReturn(1,'',1);					    								
			 } else{    //失败	
				$this->ajaxReturn(0,"数据保存失败，请刷新重试",0);					
			 }					
		}   
	
	}	
	
 	function questions_save(){   //继续提问 保存数据答疑、建议、反馈
		if (  (!isset($_POST['guid'])) || (!isset($_POST['memo']))   )   { 		
			  $this->ajaxReturn(0,"操作数据失败,请刷新重试！",0);		
		}
		$dao = M("question");
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['branch_id'] = $_SESSION['branch_id'];
		$map['loginname'] = $_SESSION['loginname'];  //登录的用户名	  各人查询个人的问题 和公司的问题做区别		
		$map['guid'] = array("EQ",$_POST['guid']); 
		$rs=$dao->where($map)->find(); 	// 
		if (!($rs)) {
			  $this->ajaxReturn(0,"操作数据失败,请刷新重试！",0);
		}
		else {			
			$dao1 = M('questiondetails');
			$data1['order_guid'] =$rs['guid'] ;
			$data1['memo'] =I('memo') ;
			$data1['branch_id'] = $rs['branch_id'];	//反馈者的branch_id
			$data1['company_id'] = $rs['company_id'];   // 反馈者的company_id	
			$data1['creat_time'] = date('Y-m-d H:i:s');
			$data1['loginname'] = $rs['loginname'];  //反馈者的loginname				
			$rs1=$dao1->add($data1); 
			$dao2 = M('question');
			$data2['status'] ='待处理' ;
			$data2['question_time'] = date('Y-m-d H:i:s');
		    $map2['id'] = $rs['id']; 
			$rs2=$dao2->where($map2)->save($data2); 
            $this->ajaxReturn(1,'',1);		
		}	
	      
   }

	function notice_list(){   //系统通知
	    $table_head_array = array( array('key'=>"creat_time", 'value'=>"日期", 'number'=>1  , 'search'=>false   ),									   
							);		
		$i=2 ;
		
		$table_head_array[] =  array('key'=>"title", 'value'=>"标题", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;
		$table_head_array[] =  array('key'=>"memo", 'value'=>"内容", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;
	
		$this->assign("table_head", $table_head_array); //表头循环变量	
        $this->assign("table_head_startnumber", 1); //表头起始行号
        $this->assign("table_head_endnumber", $i); //表头截至行号	

        $dao = M("notice");
		// import("@.ORG.Page");  //3.1.3       //导入分页类
        $count = $dao->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页		
		$list=$dao
			->field(array('creat_time','title','memo'))				
			->order(' creat_time DESC ')			
			->limit($p->firstRow.','.$p->listRows)
			->select();		

        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
		

		for ($j= 0;$j< count($list); $j++){  ////实现把文本中的URL转换为链接
			$list[$j]['memo']=get_autolink($list[$j]['memo'], array("target"=>"_blank","rel"=>"nofollow"));		
		}		

        $this->assign("recordlist", $list); //数据循环变量	
		
		
		
		$dao1 = M('user');  
		$map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map1['branch_id'] = $_SESSION['branch_id'];
	    $map1['username'] = $_SESSION['loginname'];  
		$data1['last_read_notice']	= date('Y-m-d H:i:s');	//最后读系统信息的时间的时间
		$rs1 = $dao1->where($map1)->save($data1); // 根据条件保存添加的数据 	数据表    last_read_notice
		$_SESSION['last_read_notice']  =date('Y-m-d H:i:s');   ///最后读公司信息的时间的时间	
		$_SESSION['count_notice']  ='';   ///公司信息数量	
//dump($recordlist);	
        $this->display();	
    }   

}