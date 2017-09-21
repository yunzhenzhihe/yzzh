<?php
namespace Admin\Controller;
use Think\Controller;

//客户管理模块
class CustomerController extends PublicController {
 
	function customer_list(){   //客户列表 

	    $table_head_array = array( array('key'=>"name", 'value'=>"姓名", 'number'=>2  , 'search'=>true   ),									   
							);		
		$i=3 ;	
		$table_head_array[] =  array('key'=>"gender", 'value'=>"性别", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;		
		$table_head_array[] =  array('key'=>"address", 'value'=>"地址", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"phone_number", 'value'=>"电话", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;				
		$table_head_array[] =  array('key'=>"cat_name", 'value'=>"客户组", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"date_registration", 'value'=>"注册日期", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"email", 'value'=>"电子邮箱", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	

		if  ( empty(  $_SESSION['custom_field1_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field1", 'value'=>session('custom_field1_text') , 'number'=>$i  , 'search'=>true   ) ; $i=$i+1;	                                                 
		}	
		if  ( empty(  $_SESSION['custom_field2_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field2", 'value'=>session('custom_field2_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;		                                            
		}
		if  ( empty(  $_SESSION['custom_field3_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field3", 'value'=>session('custom_field3_text'), 'number'=>$i  , 'search'=>true    )  ; $i=$i+1;		                                                 
		}		
		if  ( empty(  $_SESSION['custom_field4_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field4", 'value'=>session('custom_field4_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;	                                               
		}	
		if  ( empty(  $_SESSION['custom_field5_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field5", 'value'=>session('custom_field5_text'), 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		                                                 
		}
		if  ( empty(  $_SESSION['custom_field6_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field6", 'value'=>session('custom_field6_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;	                                                 
		}
		if  ( empty(  $_SESSION['custom_field7_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field7", 'value'=>session('custom_field7_text'), 'number'=>$i  , 'search'=>true    )  ; $i=$i+1;		                                                 
		}	
		if  ( empty(  $_SESSION['custom_field8_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field8", 'value'=>session('custom_field8_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;	                                                 
		}
		if  ( empty(  $_SESSION['custom_field9_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field9", 'value'=>session('custom_field9_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;	                                               
		}		
		if  ( empty(  $_SESSION['custom_field10_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field10", 'value'=>session('custom_field10_text'), 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		                                                 
		}


		$table_head_array[] =  array('key'=>"customer_memo", 'value'=>"备注", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"creat_time", 'value'=>"录入日期", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"creat_name", 'value'=>"录入人员", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		
			
		$this->assign("table_head", $table_head_array); //表头循环变量	
        $this->assign("table_head_startnumber", 2); //表头起始行号
        $this->assign("table_head_endnumber", $i); //表头截至行号	
		
        $this->assign("btn_flag1", 'dark'); //	按钮颜色  purple
	    $this->assign("btn_flag2", 'dark'); // 按钮颜色			
							
        $this->tabletotreetocount('group','parent_id asc,CONVERT( cat_name USING gbk ) asc ','cat_id','cat_name','customer');   //客户组-->数组  tree	
        $this->treetototalcount();	//计算数据库里面客户的总数量 		
		$this->assign("group_list", $this->tree); // 客户组	
        $this->assign("totalcount", $this->treetotalcount); // 客户总数			
				
		 if ( (isset($_GET['search_txt'])) && (isset($_GET['search_key'])) ) {
			  $search_key = $_GET['search_key']; 
			  $search_txt = $_GET['search_txt'];  
			  $map2['a.'.$search_key] = array('like','%'.$search_txt.'%');
              $this->assign("search_key", $search_key);
			  $this->assign("search_txt", $search_txt);
			  $this->assign("btn_flag1", 'purple'); //	按钮颜色  purple
		  } else {
			  $this->assign("search_key", 'name');
			  $this->assign("search_txt", '');
		  }		
				
          $date_type = 'a.creat_time';  //查询用录入日期查询		
		  
			if  (isset($_GET['searchcustomer_group'])) {   //但按客户组来查询的时候 把模糊查询的部分做初始化
		        $group_value=$_GET['searchcustomer_group'];
				if ( $group_value !='1' ) {
					$map2['a.cat_id'] = array("EQ",$group_value); 
				}
				$this->assign("group_value", $group_value);	
			} else {
				$this->assign("group_value", '');
			}
			
		 if ( (isset($_GET['date_begin'])) && (isset($_GET['date_end'])) ) {
			  $date_begin = $_GET['date_begin'];  //开始时间
		      $date_end = $_GET['date_end'];  //截止时间
			  if ( !(isdate($date_begin)&&isdate($date_end)&&isdate($date_end)) ) {  //判断过来的起始截至日期是否合法
						 $this->display();
						 return;	
			  }				  
			  $this->assign("date_begin", $date_begin);
		      $this->assign("date_end", $date_end);
              if  ( !(isset($_GET['search_txt'])) && !(isset($_GET['searchcustomer_group'])) ) {
				 $map2[$date_type]  = array('between',array($date_begin.' 00:00:00',$date_end.' 23:59:59')); 
				 $this->assign("btn_flag2", 'purple'); //	按钮颜色  purple
			  }			  
			  			  
		  } 			
			
	
	   // 开始表格排序的处理
			if  (isset($_GET['sorter_number']))  {  //接受到排序的序号 查询 序号对应的 关键词变量和文本  遍历查询
				foreach( $table_head_array as $k=>$val ){
					if  ( $_GET['sorter_number'] == $val['number'] ) {				
						$_GET['sorter_key'] = $val['key'] ;
					}
				}		   
			}				
		   if ( (isset($_GET['sorter_key'])) && (isset($_GET['sorter_ascordesc'])) ) {
			    cookie('customersorter_key',  $_GET['sorter_key'] ,$this->cookietime); 
				cookie('customersorter_number',  $_GET['sorter_number'] ,$this->cookietime); 
				cookie('customersorter_ascordesc',  $_GET['sorter_ascordesc'] ,$this->cookietime); 
			 }	
			 
		   $sorter_key = cookie('customersorter_key');  //从cookie里面取排序字段
           $sorter_ascordesc = cookie('customersorter_ascordesc');  //从cookie里面取排序字段 asc or  desc		
	   // 结束表格排序的处理

		 if ( (is_null($group_value))&& (is_null($search_txt))  && (is_null($date_begin)) )  {
				 $this->display();  //没有查询的条件 就返回	
				 return;			
		 }		

        $dao = M("customer");
        // import("@.ORG.Page");  //3.1.3       //导入分页类
		$map2['a.company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map2['a.branch_id'] = $_SESSION['branch_id'];
        $count = $dao->alias('a')->where($map2)->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页
		
		$list=$dao
		    ->alias('a')
			->field(array('a.id','a.guid','a.name','a.phone_number','a.cat_id','a.gender',
			              'a.address','a.date_registration','a.customer_memo','a.customer_marker_lng','a.customer_marker_lat','a.email',
						  'a.custom_field1','a.custom_field2','a.custom_field3','a.custom_field4','a.custom_field5','a.custom_field6',
						  'a.custom_field7','a.custom_field8','a.custom_field9','a.custom_field10',
						  'a.creat_time','a.creat_name','a.last_change_time','a.last_change_name',
						  'b.cat_name'))	
			->join( C('DB_PREFIX') . 'group AS b ON a.cat_id = b.cat_id and b.company_id='.$_SESSION['company_id'] )			
			->where($map2)
			->order('CONVERT( '.$sorter_key.' USING gbk )'.$sorter_ascordesc.'  ')
			->limit($p->firstRow.','.$p->listRows)
			->select();		
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
        $this->assign("customerlist", $list); //数据循环变量	
	//	Log::write('调试的SQL：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去
	//	Log::write('调试的$rs：Minify_HTML');  //把最后一句sql写到日志里面去
		
        $this->display();	
	}

//	function state_save() {
//	    $a='aaSorting:'.json_encode($_POST['aaSorting']).'   abVisCols:'.json_encode($_POST['abVisCols']);
//	    $this->ajaxReturn($a,"读数据成功！",1);
//	}
	
//	function state_save1() {
//	    $a='searchcustomersorter_key:'.$_POST['searchcustomersorter_key'].'   searchcustomersorter_ascordesc:'.$_POST['searchcustomersorter_ascordesc'];
//	    $this->ajaxReturn($a,"读数据成功！",1);
//	}	

	function customer_statistics(){   ////客户统计   统计 距今多少天 没有来电  没有销售 没有售后  没有回访的 客户是那些
        $this->assign("btn_flag1", 'dark'); //	按钮颜色  purple
	    $this->assign("status1", 'checked');
		$this->assign("status2", 'checked');	
	    $this->assign("status3", 'checked');
		$this->assign("status4", 'checked');	
		$this->assign("search_txt", '30');	
		
		if  (!isset($_GET['search_txt'])  ) {  //如果没有天数 就返回 
			 $this->display();
			 return;	
		}

		if  ( !isset($_GET['status1']) && !isset($_GET['status2']) && !isset($_GET['status3']) && !isset($_GET['status4'])  ) {  //如果没有status值 就返回  
			 $this->display();
			 return;	
		}
		
		$search_txt=(int)$_GET['search_txt'];
		$str='-'.$search_txt.' day';
		$date=date("Y-m-d",strtotime($str)) ;
		
        $status='';	
        if  (isset($_GET['status1']) ) {
               $status1 = 'checked' ;
			   if  ($status=='') {
				  $status=$status."  ( date_call<='".$date."'  )"; 
			   } else {
				  $status=$status." AND  ( date_call<='".$date."'  )"; 
			   }			   
		}
        if  (isset($_GET['status2']) ) {
               $status2= 'checked' ;
			   if  ($status=='') {
				  $status=$status."  ( date_sales<='".$date."'  )"; 
			   } else {
				  $status=$status." AND  ( date_sales<='".$date."'  )"; 
			   }		   
		}	
        if  (isset($_GET['status3']) ) {
               $status3 = 'checked' ;
			   if  ($status=='') {
				  $status=$status."  ( date_service<='".$date."'  )"; 
			   } else {
				  $status=$status." AND  ( date_service<='".$date."'  )"; 
			   }		   
		}

       $map['_string'] = $status ; 			
	   $this->assign("btn_flag1", 'purple'); //查询按钮 变色
	   $this->assign("status1", $status1);
	   $this->assign("status2", $status2);	
	   $this->assign("status3", $status3);
	   $this->assign("status4", $status4);		   
	   $this->assign("search_txt", $search_txt);			

	    $table_head_array = array( array('key'=>"name", 'value'=>"姓名", 'number'=>2  , 'search'=>true   ),									   
							);		
		$i=3 ;	
		$table_head_array[] =  array('key'=>"gender", 'value'=>"性别", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"phone_number", 'value'=>"电话", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		
		$table_head_array[] =  array('key'=>"date_call", 'value'=>"最近来电日期", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"date_sales", 'value'=>"最近销售日期", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"date_service", 'value'=>"最近售后日期", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;			
		
		$table_head_array[] =  array('key'=>"address", 'value'=>"地址", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"cat_name", 'value'=>"客户组", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"date_registration", 'value'=>"注册日期", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"email", 'value'=>"电子邮件", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	

		if  ( empty(  $_SESSION['custom_field1_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field1", 'value'=>session('custom_field1_text') , 'number'=>$i  , 'search'=>true   ) ; $i=$i+1;	                                                 
		}	
		if  ( empty(  $_SESSION['custom_field2_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field2", 'value'=>session('custom_field2_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;		                                            
		}
		if  ( empty(  $_SESSION['custom_field3_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field3", 'value'=>session('custom_field3_text'), 'number'=>$i  , 'search'=>true    )  ; $i=$i+1;		                                                 
		}		
		if  ( empty(  $_SESSION['custom_field4_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field4", 'value'=>session('custom_field4_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;	                                               
		}	
		if  ( empty(  $_SESSION['custom_field5_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field5", 'value'=>session('custom_field5_text'), 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		                                                 
		}
		if  ( empty(  $_SESSION['custom_field6_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field6", 'value'=>session('custom_field6_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;	                                                 
		}
		if  ( empty(  $_SESSION['custom_field7_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field7", 'value'=>session('custom_field7_text'), 'number'=>$i  , 'search'=>true    )  ; $i=$i+1;		                                                 
		}	
		if  ( empty(  $_SESSION['custom_field8_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field8", 'value'=>session('custom_field8_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;	                                                 
		}
		if  ( empty(  $_SESSION['custom_field9_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field9", 'value'=>session('custom_field9_text'), 'number'=>$i  , 'search'=>true    ) ; $i=$i+1;	                                               
		}		
		if  ( empty(  $_SESSION['custom_field10_style']  ) )	{
		        $table_head_array[] = array('key'=>"custom_field10", 'value'=>session('custom_field10_text'), 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		                                                 
		}


		$table_head_array[] =  array('key'=>"customer_memo", 'value'=>"备注", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"creat_time", 'value'=>"录入日期", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"creat_name", 'value'=>"录入人员", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		
			
		$this->assign("table_head", $table_head_array); //表头循环变量	
        $this->assign("table_head_startnumber", 2); //表头起始行号
        $this->assign("table_head_endnumber", $i); //表头截至行号	
		
        $this->assign("btn_flag1", 'dark'); //	按钮颜色  purple
							

        $dao = M("customer");
        // import("@.ORG.Page");  //3.1.3       //导入分页类
		$map['a.company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['a.branch_id'] = $_SESSION['branch_id'];
        $count = $dao->alias('a')->where($map)->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页
		
		$list=$dao
		    ->alias('a')
			->field(array('a.id','a.guid','a.name','a.phone_number','a.cat_id','a.gender',
			              'a.address','a.date_registration','a.customer_memo','a.customer_marker_lng','a.customer_marker_lat','a.email',
						  'a.custom_field1','a.custom_field2','a.custom_field3','a.custom_field4','a.custom_field5','a.custom_field6',
						  'a.custom_field7','a.custom_field8','a.custom_field9','a.custom_field10','a.date_call','a.date_sales','a.date_service',
						  'a.creat_time','a.creat_name','a.last_change_time','a.last_change_name',
						  'b.cat_name'))	
			->join( C('DB_PREFIX') . 'group AS b ON a.cat_id = b.cat_id and b.company_id='.$_SESSION['company_id'] )			
			->where($map)
			->order('CONVERT( name USING gbk )  ASC  ')
			->limit($p->firstRow.','.$p->listRows)
			->select();		
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
		
		foreach ($list as &$key){  //开始遍历这个数组，如果时间为0000-00-00 00:00:00 就赋值零
			if  ( $key['date_call'] =='0000-00-00' ) {
				$key['date_call']='';
			}
			if  ( $key['date_sales'] =='0000-00-00' ) {
				$key['date_sales']='';
			}
			if  ( $key['date_service'] =='0000-00-00' ) {
				$key['date_service']='';
			}			
		}		
		
        $this->assign("customerlist", $list); //数据循环变量	
        $this->display();	
	}


	
	function customer_add(){   //添加新客户 
        $this->tabletotree('group','parent_id asc,CONVERT( cat_name USING gbk ) asc ','cat_id','cat_name');   //客户组-->数组  tree		
		$this->assign("group_list", $this->tree); // 客户组
	
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		
		$dao1 = M('customfields1');	//客户自定义1 下拉	
		$rs1=$dao1->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao2 = M('customfields2');	//客户自定义2 下拉	
		$rs2=$dao2->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao3 = M('customfields3');	//客户自定义3 下拉	
		$rs3=$dao3->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao4 = M('customfields4');	//客户自定义4 下拉	
		$rs4=$dao4->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	

		$this->assign("custom_field1_list", $rs1); //客户自定义1 下拉				     
		$this->assign("custom_field2_list", $rs2); //客户自定义2 下拉	
		$this->assign("custom_field3_list", $rs3); //客户自定义3 下拉				     
		$this->assign("custom_field4_list", $rs4); //客户自定义4 下拉				
		$this->assign("callnumber", $_GET['callnumber']); //客户端传过来的来电号码  自动填到号码的位置	
        $this->display();	
	}
		
	function customer_sale(){   //添加新客户 新客户销售记录
		if  (isset($_GET['id'])) {
	    	  //如果有id值 表示是点击老客户的按钮 否则就是点击新客户新订单按钮
		} 
		
        $this->tabletotree('group','parent_id asc,CONVERT( cat_name USING gbk ) asc ','cat_id','cat_name');   //客户组-->数组  tree		
		$this->assign("group_list", $this->tree); // 客户组

        $this->tabletotree('goodstype','parent_id asc,CONVERT( cat_name USING gbk ) asc','cat_id','cat_name');   //商品分类-->数组  tree		
		$this->assign("goodstype_list", $this->tree); // 商品分类  数据循环变量	
		
		//以下参数设置是总公司统一设置			
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		
		$dao1 = M('customfields1');	//客户自定义1 下拉	
		$rs1=$dao1->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao2 = M('customfields2');	//客户自定义2 下拉	
		$rs2=$dao2->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao11 = M('customfields3');	//客户自定义3 下拉	
		$rs11=$dao11->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao22 = M('customfields4');	//客户自定义4 下拉	
		$rs22=$dao22->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
	
		$dao3 = M('Customsalesfields1');	//销售    自定义1 下拉	
		$rs3=$dao3->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao4 = M('Customsalesfields2');	 //销售    自定义2 下拉	
		$rs4=$dao4->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();
		$dao33 = M('Customsalesfields3');	//销售    自定义3 下拉	
		$rs33=$dao33->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao44 = M('Customsalesfields4');	 //销售    自定义4 下拉			
		$rs44=$dao44->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();
		$dao5 = M('buyway');	 //购买方式
		$rs5=$dao5->where($map)->field(array('name'))->order('CONVERT( name USING gbk ) asc ')->select();					
		$dao9 = M('timedelivery');	 //送货时间  尽快 上午尽快 下午 下午尽快 等等
		$rs9=$dao9->field(array('name'))->order('CONVERT( name USING gbk ) asc ')->select();	
	//    $rs9= array('尽快','上午尽快','下午','下午尽快');
	//	$rs9= array('name'=>"尽快", 'name'=>"上午尽快", 'name'=>"下午"  , 'name'=>"下午尽快" ); 
		
		
		
		
       //以下参数设置是分公司设置	
		$map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map1['branch_id'] = $_SESSION['branch_id'];
		$dao6 = M('salesunit');	 //销售单位
		$rs6=$dao6->where($map1)->field(array('name'))->order('CONVERT( name USING gbk ) asc ')->select();			
		$dao7 = M('technician');	 //技术人员
		$rs7=$dao7->where($map1)->field(array('name'))->order('CONVERT( name USING gbk ) asc ')->select();		
		$dao8 = M('salesman');	 //销售人员
		$rs8=$dao8->where($map1)->field(array('name'))->order('CONVERT( name USING gbk ) asc ')->select();		
		
				

		$this->assign("custom_field1_list", $rs1); //客户自定义1 下拉				     
		$this->assign("custom_field2_list", $rs2); //客户自定义2 下拉
		$this->assign("custom_field3_list", $rs11); //客户自定义3 下拉				     
		$this->assign("custom_field4_list", $rs22); //客户自定义4 下拉			
		$this->assign("customsalesfields1_list", $rs3); //销售  自定义1 下拉	
		$this->assign("customsalesfields2_list", $rs4); //销售  自定义2 下拉	
		$this->assign("customsalesfields3_list", $rs33); //销售  自定义1 下拉	
		$this->assign("customsalesfields4_list", $rs44); //销售  自定义2 下拉			
		
		$this->assign("buyway_list", $rs5); //购买方式
		$this->assign("salesunit_list", $rs6); //销售单位
		$this->assign("technician_list", $rs7); //技术人员
		$this->assign("salesman_list", $rs8); //销售人员
		$this->assign("timedelivery_list", $rs9); //送货时间  尽快 上午尽快 下午 下午尽快 等等
        $this->display();	
	}
	
	function customer_service(){   //添加新客户 新客户售后记录
		if  (isset($_GET['id'])) {
	    	  //如果有id值 表示是点击老客户的按钮 否则就是点击新客户新订单按钮
		} 
		
        $this->tabletotree('group','parent_id asc,CONVERT( cat_name USING gbk ) asc ','cat_id','cat_name');   //客户组-->数组  tree		
		$this->assign("group_list", $this->tree); // 客户组
	    $tree='';
        $this->tabletotree('goodstype','parent_id asc,CONVERT( cat_name USING gbk ) asc','cat_id','cat_name');   //客户组-->数组  tree		
		$this->assign("goodstype_list", $this->tree); // 商品分类  数据循环变量	
				
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		
		$dao1 = M('customfields1');	//客户自定义1 下拉	
		$rs1=$dao1->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao2 = M('customfields2');	//客户自定义2 下拉	
		$rs2=$dao2->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao11 = M('customfields3');	//客户自定义3 下拉	
		$rs11=$dao11->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao22 = M('customfields4');	//客户自定义4 下拉	
		$rs22=$dao22->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	

		
		
		$dao3 = M('customrecordfields1');	//售后记录   自定义1 下拉	
		$rs3=$dao3->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao4 = M('customrecordfields2');	 //售后记录   自定义2 下拉	
		$rs4=$dao4->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();
		$dao33 = M('customrecordfields3');	//售后记录   自定义3 下拉	
		$rs33=$dao33->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao44 = M('customrecordfields4');	 //售后记录   自定义4下拉	
		$rs44=$dao44->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();
		
		
		$dao5 = M('servicetype');	 //售后类型
		$rs5=$dao5->where($map)->field(array('name'))->order('CONVERT( name USING gbk ) asc ')->select();		
		$dao6 = M('servicefault');	//报修故障
		$rs6=$dao6->where($map)->field(array('name'))->order('CONVERT( name USING gbk ) asc ')->select();			

		$this->assign("custom_field1_list", $rs1); //客户自定义1 下拉				     
		$this->assign("custom_field2_list", $rs2); //客户自定义2 下拉	
		$this->assign("custom_field3_list", $rs11); //客户自定义3 下拉				     
		$this->assign("custom_field4_list", $rs22); //客户自定义4 下拉			
		$this->assign("custom_recordfield1_list", $rs3); //售后记录   自定义1 下拉	
		$this->assign("custom_recordfield2_list", $rs4); //售后记录   自定义2 下拉	
		$this->assign("custom_recordfield3_list", $rs33); //售后记录   自定义3 下拉	
		$this->assign("custom_recordfield4_list", $rs44); //售后记录   自定义4 下拉			
		$this->assign("servicetype_list", $rs5); //售后类型
		$this->assign("servicefault_list", $rs6); //报修故障

        $this->display();	
	}	
	
	function customer_complain(){   //添加新客户 新客户投诉记录
        $this->tabletotree('group','parent_id asc,CONVERT( cat_name USING gbk ) asc ','cat_id','cat_name');   //客户组-->数组  tree		
		$this->assign("group_list", $this->tree); // 客户组
	    $tree='';

		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		
		$dao1 = M('customfields1');	//客户自定义1 下拉	
		$rs1=$dao1->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao2 = M('customfields2');	//客户自定义2 下拉	
		$rs2=$dao2->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao11 = M('customfields3');	//客户自定义3 下拉	
		$rs11=$dao11->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao22 = M('customfields4');	//客户自定义4 下拉	
		$rs22=$dao22->where($map)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	

		
		
		$dao5 = M('complaintype');	 //投诉类型
		$rs5=$dao5->where($map)->field(array('name'))->order('CONVERT( name USING gbk ) asc ')->select();		

		$this->assign("custom_field1_list", $rs1); //客户自定义1 下拉				     
		$this->assign("custom_field2_list", $rs2); //客户自定义2 下拉	
		$this->assign("custom_field3_list", $rs11); //客户自定义3 下拉				     
		$this->assign("custom_field4_list", $rs22); //客户自定义4 下拉			
	
		$this->assign("type_list", $rs5); //售后类型

        $this->display();	
	}	
	
	
	function customer_map(){   //客户地图
		$this->assign("customer_info", $_GET['customer_info']); //客户基本资料
		$this->assign("customer_lat", $_GET['lat']); //地图的lat
		$this->assign("customer_lng", $_GET['lng']); //地图的lng		
        $this->display();	
	}	
	
    function customer_call(){	//pc 来电采集部分
		//客户资料查询
		if ( (!isset($_GET['callnumber']))  ){  //如果没有callnumber值 就返回空 
	    	 $this->display();
			 return;
		} 
        $dao = M("customer");
		$map2['a.company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map2['a.branch_id'] = $_SESSION['branch_id'];
		$map2['a.phone_number'] = array('like','%'.$_GET['callnumber'].'%');

		$list=$dao
		    ->alias('a')
			->field(array('a.id','a.guid','a.name','a.phone_number','a.cat_id','a.gender',
			              'a.address','a.date_registration','a.customer_memo','a.customer_marker_lng','a.customer_marker_lat','a.email'))			
			->where($map2)
			->find();	

        $this->assign("customerlist", $list); //数据循环变量	
		$this->display();
	}
	
    function customer_callnumber(){	//pc 定时监测 是不是有手机来电 
	  //检测pc客户端有没有来电上传
	  if ( isset($_GET['callrecord'])) {   //有传上来的数据
	       //$json=$_GET['callrecord'];	//传上来的json数据		   
		    $json=I('callrecord');	//传上来的json数据
			$find1="'";
		    $find2="“";
            $replace='"' ;
			$json = str_replace($find1, $replace, $json);  //替换json字符串里面 可能出现的不合法的 字符 
			$json = str_replace($find2, $replace, $json);
			$json_array = json_decode($json,true); //
		    if(!$json_array)
		     {
				
		     } else {
					foreach ($json_array as $data){  //开始解析需要处理订单的id号	
						$data['branch_id'] = $_SESSION['branch_id'];
						$data['company_id'] = $_SESSION['company_id'];
						$data['creat_time'] = date('Y-m-d H:i:s');
						$data['creat_name'] = $_SESSION['username'];
						$dao = M('call_record');     
						$rs = $dao->add($data); // 根据条件保存添加的数据 	
						$this->pub_customerdate($data['call_customer_guid'],$data['call_date'],'1'); //写客户最近来电日期  最近销售日期  最近售后日期  最近回访日期 $flag ： 1：来电  2：销售  3：售后  当删除的时候$date=0000-00-00	
					}	
		     }
      } 
	  
	  //结束检测pc客户端有没有来电上传
	
	
		$dao = M('user');  
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['branch_id'] = $_SESSION['branch_id'];
	    $map['username'] = $_SESSION['loginname'];  
		$map['last_call_time']  = array('EGT',time()-5*60); //pc端间隔2秒查询轮询一次 每次查询当前5*60秒前的来电 如果有就传输到客户端 并且把数据晴空 清零
		$rs=$dao
			->field(array('call_number','call_address'))			
			->where($map)
			->find();	
	//	Log::write('调试的SQL：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去	
	//	Log::write('date：'.date('Y-m-d H:i:s',time()-5*60));  //把最后一句sql写到日志里面去


	   if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		} else {   //有来电  处理完成以后 数据晴空 清零	
    		$date['last_call_time']=0;
			$rs1 = $dao->where($map)->save($date); // 数据晴空 清零		
		//	Log::write('调试的SQL：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去
		}
		
		$this->assign("call_info", $rs); //数据循环变量	
		$this->display();
	}	
	
    function customer_callmemo(){	//pc 修改来电备注
	  if ( isset($_GET['callmemo'])) {   //有传上来的数据   
			$data['call_memo'] = I('callmemo');
			$dao = M('call_record');    
			$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
			$map['branch_id'] = $_SESSION['branch_id'];		
			$map['call_number'] = I('call_number');	
			$map['call_date'] = I('call_date');
			$map['call_time'] = I('call_time');
            $rs=$dao->where($map)->save($data); 	// 根据条件保存修改的数据 
          //  Log::write('调试的SQL：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去
	  }	 
	}		
	
	
	function customer_calllist(){   //客户来电记录列表
	    $table_head_array = array( array('key'=>"call_number", 'value'=>"来电号码", 'number'=>2  , 'search'=>false   ),									   
							);		
		$i=3 ;	

		$table_head_array[] =  array('key'=>"call_name", 'value'=>"客户姓名", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;
		$table_head_array[] =  array('key'=>"call_date", 'value'=>"来电日期", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;	
	//	$table_head_array[] =  array('key'=>"call_type", 'value'=>"来电类型", 'number'=>$i   , 'search'=>false   ) ; $i=$i+1;		
		$table_head_array[] =  array('key'=>"call_time_length", 'value'=>"通话时长", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"call_record_file", 'value'=>"录音文件名", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"call_memo", 'value'=>"来电备注", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"call_user_name", 'value'=>"接线员", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;					
		$this->assign("table_head", $table_head_array); //表头循环变量	
        $this->assign("table_head_startnumber", 2); //表头起始行号
        $this->assign("table_head_endnumber", $i); //表头截至行号	
		
        $this->assign("btn_flag1", 'dark'); //	按钮颜色  purple
	    $this->assign("btn_flag2", 'dark'); // 按钮颜色			
							
		 if ( (isset($_GET['search_txt'])) && (isset($_GET['search_key'])) ) {
			  $search_key = $_GET['search_key']; 
			  $search_txt = $_GET['search_txt'];  
			  $map[$search_key] = $search_txt;
              $this->assign("search_key", $search_key);
			  $this->assign("search_txt", $search_txt);
			  $this->assign("btn_flag2", 'purple'); //	按钮颜色  purple
		  } else {
			  $this->assign("search_key", 'call_number');
			  $this->assign("search_txt", '');
		  }			  

          $date_type = 'call_date';  //查询用录入日期查询		

		 if ( (isset($_GET['date_begin'])) && (isset($_GET['date_end'])) ) {
			  $date_begin = $_GET['date_begin'];  //开始时间
		      $date_end = $_GET['date_end'];  //截止时间
			  if ( !(isdate($date_begin)&&isdate($date_end)&&isdate($date_end)) ) {  //判断过来的起始截至日期是否合法
						 $this->display();
						 return;	
			  }				  
			  $this->assign("date_begin", $date_begin);
		      $this->assign("date_end", $date_end);
              if  ( !(isset($_GET['search_txt'])) ) {
				 $map[$date_type]  = array('between',array($date_begin,$date_end)); 
				 $this->assign("btn_flag1", 'purple'); //	按钮颜色  purple
			  }			  
			  			  
		  } 			

		 if ( (is_null($search_txt))  && (is_null($date_begin)) )  {
				 $this->display();  //没有查询的条件 就返回	
				 return;			
		 }		

        $dao = M("call_record");
        // import("@.ORG.Page");  //3.1.3       //导入分页类
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['branch_id'] = $_SESSION['branch_id'];
        $count = $dao->where($map)->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页
		
		$list=$dao						
			->where($map)
			->order('call_date desc , call_time  desc ')
			->limit($p->firstRow.','.$p->listRows)
			->select();		
        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
        $this->assign("calllist", $list); //数据循环变量	
        $this->display();	
	}	


	function ajaxinsert1(){	//添加新客户
	    $guid =get_guid(); 
        $_POST['guid'] =$guid;
		$dao = D('Customer'); 		
        if (!$dao->create($_POST,1)){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $this->ajaxReturn(0,$dao1->getError(),0);
        }	
		
		$rs = $dao->add(); // 根据条件保存添加的数据 
		if( $rs ){
             $this->ajaxReturn(1,'',1);
        }
		else{
             $this->ajaxReturn(0,"添加客户数据失败！",0);
        }		   		  		  		   
	}	

	function ajaxinsert2(){	//添加新客户新销售记录
	    $guid =get_guid(); 
        $_POST['guid'] =$guid;
        $_POST['customer_guid'] =$guid;	
		if  ( $_POST['order_number']=="" )   {  //如果为空就自动生成一个随机数做销售单号
		    $_POST['order_number'] =get_rand_string(8,1) ;   // 得到6位的数字随机数  这个是销售单号,在整个数据库里面,这个数据不一定是一个惟一数,不能做惟一数来做查询 如果要查询,结合公司id  订单的时间段,不要用find  		
		};
				
		$find="'";
        $replace='"' ;
		$_POST['sales_json'] = str_replace($find, $replace, $_POST['sales_json']);
		
   	    $json_array=json_decode($_POST['sales_json'],true);
	    $i=0;
		$error_flag=false;			
		$data_arr=array();	
		$_POST['goods_name']='';
		foreach ($json_array as $key){
		   $data=$key; 
		   $data['customer_guid'] = $_POST['customer_guid'];  //客户guid
		   $data['ordersale_guid'] = $_POST['guid'];  //本订单guid
		   $data['guid'] = get_guid();  //本销售商品guid
		   $data['order_number'] = $_POST['order_number'];   //订单号
		   $data['date_sale'] = $_POST['date_sale'];    //销售日期	
           $data['date_regular_maintenance'] = $_POST['date_sale'];    //最近定期维护时间	
	//	   $data['date_regular_visits'] = $_POST['date_sale'];    //最近定期回访时间		   
	       $data['goods_realquantity'] = $data['goods_quantity'];    //  实际数量 
		   $data['date_warranty_period'] = date("Y-m-d",strtotime( $_POST['date_sale']." +".$data['warranty_period']." month" ));    //计算质保截至的时间	
		   $data['branch_id'] = $_SESSION['branch_id'];
		   $data['company_id'] = $_SESSION['company_id'];
		   $data['creat_time'] = date('Y-m-d H:i:s');
		   $data['creat_name'] = $_SESSION['username'];		   
		   array_push($data_arr,$data);
		   if  ( $_POST['goods_name']!='' ) {
			   $_POST['goods_name']=$_POST['goods_name'].'<br>'.$data['goods_name'] ;
		   } else {
			   $_POST['goods_name']=$data['goods_name'] ;
		   }
		   $i++;
           $dao = D('Ordersaledetails')->setProperty('error',''); //每次循环先把error清空 	
           if (!$dao->create($data)){  // 如果创建失败 表示验证没有通过 设置标志位 跳出循环  
		        $error_flag=true;
				break; 
            }		   		   
		}
		
		M()->startTrans();//开启事务
		
		$dao1 = D('Ordersale');  
		$_POST['sale_money_no'] =	$_POST['sale_money']	; //未收 金额=销售金额 为了做应收账款准备 
        if (!$dao1->create($_POST,1)){  // 如果创建失败 表示验证没有通过 修改错误标志为  true           
		    $error_flag=true;
        }

		$dao3 = D('Customer'); 	
        if (!$dao3->create($_POST,1)){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $error_flag=true;
        }	

        if  ( ( $error_flag ) || ( $i<1 ) ) {   //数据验证错误 就跳出
		    M()->rollback();//不成功，回滚
			$this->ajaxReturn(0,'添加数据失败,请刷新重试！',0);
		}		

	    $dao2= D('Ordersaledetails');  	
	    $rs2= $dao2->addAll($data_arr); // 根据条件保存添加的数据 
		
		$rs1 = $dao1->add(); // 根据条件保存添加的数据 
		$rs3 = $dao3->add(); // 根据条件保存添加的数据 	
		
		if($rs1 && $rs2 && $rs3){
			M()->commit();//事务提交
			/* 保存成功以后开始写订单处理流程明细   */
			   $data4['order_guid'] = $_POST['guid'];  //订单的guid   				
			   $data4['order_status'] = '待处理';  		//订单当前状态		
			   $data4['order_number'] = $_POST['order_number'];  //订单号
			   $data4['content'] = '建立新客户订单'; 
			   $data4['branch_id'] = $_SESSION['branch_id'];
			   $data4['company_id'] = $_SESSION['company_id'];
			   $data4['creat_time'] = date('Y-m-d H:i:s');
			   $data4['creat_name'] = $_SESSION['username'];		   
			   $this->pub_process('Ordersalesprocess',$data4,'0'); // pub_process($ModuleName,&$Data,$flag)  写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
               $this->pub_customerdate($_POST['customer_guid'],$_POST['date_sale'],'2'); //写客户最近来电日期  最近销售日期  最近售后日期  最近回访日期 $flag ： 1：来电  2：销售  3：售后  当删除的时候$date=0000-00-00	
			   /* 结束写 订单处理的流程明细  */	
             $this->ajaxReturn(1,'',1);
        }
		else{
			 M()->rollback();//不成功，回滚
             $this->ajaxReturn(0,"添加客户数据失败！",0);
        }		   		  		  		   
 
	}
	
	function ajaxinsert3(){	//添加新客户新售后记录
	    $guid =get_guid(); 
        $_POST['guid'] =$guid;
        $_POST['customer_guid'] =$guid;		
		if ( $_POST['order_number']=="" )  {  //如果为空就自动生成一个随机数做销售单号
		    $_POST['order_number'] =get_rand_string(8,1) ;   // 得到6位的数字随机数  这个是销售单号,在整个数据库里面,这个数据不一定是一个惟一数,不能做惟一数来做查询 如果要查询,结合公司id  订单的时间段,不要用find  		
		};
	//	$_POST['phone_number'] = trim( $_POST['phone1'].' '.$_POST['phone2'].' '.$_POST['phone3'].' '.$_POST['phone4'] ) ; // 把号码合并到一个字段里面 为了在前台显示比较方便
		$dao1 = D('Customer'); 		
        if (!$dao1->create($_POST,1)){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $this->ajaxReturn(0,$dao1->getError(),0);
        }		
		$dao2 = D('Orderservice');  
        if (!$dao2->create($_POST,1)){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $this->ajaxReturn(0,$dao2->getError(),0);
        }	
		// 验证通过 可以进行其他数据操作
        $dao1->startTrans();//开启事务回滚处理	
        $dao2->startTrans();//开启事务回滚处理			
		$rs1 = $dao1->add(); // 根据条件保存添加的数据 
		$rs2 = $dao2->add(); // 根据条件保存添加的数据 	
		
		if($rs1 && $rs2 ){
		     $dao1->commit();//成功
			 $dao2->commit();//成功
			 
				/* 保存成功以后开始写售后订单处理流程明细   */
				   $data4['order_guid'] = $_POST['guid'];  //订单的guid   				
				   $data4['order_status'] = '待处理';  		//订单当前状态		
				   $data4['order_number'] = $_POST['order_number'];  //订单号
				   $data4['content'] = '建立新客户订单'; 
				   $data4['branch_id'] = $_SESSION['branch_id'];
				   $data4['company_id'] = $_SESSION['company_id'];
				   $data4['creat_time'] = date('Y-m-d H:i:s');
				   $data4['creat_name'] = $_SESSION['username'];
				   $this->pub_process('Orderserviceprocess',$data4,'0'); // pub_process($ModuleName,&$Data,$flag)  写操作日志 销售订单或者售后订单 或者回访订单的  操作流程	  $flag='0' 单数据 $flag='1' 多数据
                   $this->pub_customerdate($_POST['customer_guid'],$_POST['date_appointment'],'3'); //写客户最近来电日期  最近销售日期  最近售后日期  最近回访日期 $flag ： 1：来电  2：销售  3：售后  当删除的时候$date=0000-00-00	

				   /* 结束写 售后订单处理的流程明细  */				 
             $this->ajaxReturn(1,'',1);
        }
		else{
			 $dao1->rollback();//不成功，回滚
			 $dao2->rollback();//不成功，回滚
             $this->ajaxReturn(0,"添加客户数据失败！",0);
        }		   		  		  		   
	}	
	
	function ajaxinsert4(){	//添加新客户新投诉记录
	    $guid =get_guid(); 
        $_POST['guid'] =$guid;
        $_POST['customer_guid'] =$guid;		
		if ( $_POST['order_number']=="" )  {  //如果为空就自动生成一个随机数做销售单号
		    $_POST['order_number'] =get_rand_string(6,1) ;   // 得到6位的数字随机数  这个是销售单号,在整个数据库里面,这个数据不一定是一个惟一数,不能做惟一数来做查询 如果要查询,结合公司id  订单的时间段,不要用find  		
		};
	//	$_POST['phone_number'] = trim( $_POST['phone1'].' '.$_POST['phone2'].' '.$_POST['phone3'].' '.$_POST['phone4'] ) ; // 把号码合并到一个字段里面 为了在前台显示比较方便
		$dao1 = D('Customer'); 		
        if (!$dao1->create($_POST,1)){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $this->ajaxReturn(0,$dao1->getError(),0);
        }		
		$dao2 = D('Ordercomplain');  
        if (!$dao2->create($_POST,1)){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $this->ajaxReturn(0,$dao2->getError(),0);
        }	
		// 验证通过 可以进行其他数据操作
        $dao1->startTrans();//开启事务回滚处理	
        $dao2->startTrans();//开启事务回滚处理			
		$rs1 = $dao1->add(); // 根据条件保存添加的数据 
		$rs2 = $dao2->add(); // 根据条件保存添加的数据 	
		
		if($rs1 && $rs2 ){
		     $dao1->commit();//成功
			 $dao2->commit();//成功
             $this->ajaxReturn(1,'',1);
        }
		else{
			 $dao1->rollback();//不成功，回滚
			 $dao2->rollback();//不成功，回滚
             $this->ajaxReturn(0,"添加客户数据失败！",0);
        }		   		  		  		   
	}	
	
	
	function customer_edit(){   //修改客户的资料 
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['id'] = array("EQ",(int)$_GET['id']);  
		$dao = M("customer");
		$rs=$dao
		    ->where($map)
			->field(array('id','name','gender','phone_number','address','date_registration','cat_id','email','customer_memo','customer_marker_lng','customer_marker_lat',
			              'custom_field1','custom_field2','custom_field3','custom_field4','custom_field5','custom_field6','custom_field7','custom_field8','custom_field9','custom_field10'
					  ))				
			->find();	 

	   if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		     $this->error('修改客户资料失败');
			 return;
		}
		
        $this->tabletotree('group','parent_id asc,CONVERT( cat_name USING gbk ) asc ','cat_id','cat_name');   //客户组-->数组  tree		
		$this->assign("group_list", $this->tree); // 客户组

		$dao1 = M('customfields1');	//客户自定义1 下拉	
		$rs1=$dao1->where($map1)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao2 = M('customfields2');	//客户自定义2 下拉	
		$rs2=$dao2->where($map1)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao3 = M('customfields3');	//客户自定义3 下拉	
		$rs3=$dao3->where($map1)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();	 	
		$dao4 = M('customfields4');	//客户自定义4 下拉	
		$rs4=$dao4->where($map1)->field(array('name'))->order('CONVERT( number USING gbk ) asc   , CONVERT( name USING gbk ) asc ')->select();		

		$this->assign("custom_field1_list", $rs1); //客户自定义1 下拉				     
		$this->assign("custom_field2_list", $rs2); //客户自定义2 下拉	
		$this->assign("custom_field3_list", $rs3); //客户自定义3 下拉				     
		$this->assign("custom_field4_list", $rs4); //客户自定义4 下拉	
		
		$this->assign("custom_list", $rs); //客户资料
		
        $this->display();	
	}	
	
   function ajaxedit(){  //来电日志标记 
        $this->pub_edit('call_record');			
	}	
	
    function ajaxsave(){  //修改保存
	  if  (isset($_POST['call_memo'])) {   //如果有 call_memo 就是修改来电标记
	        $this->pub_save('call_record');	    	 
		}  else {
	        $this->pub_save('Customer');			
		}
	}
	
	function ajaxdel(){	 //删除	
	   $map['customer_guid'] = array("EQ",$_POST['guid']);  
       $map['company_id'] = $_SESSION['company_id'];   //  限定在本公司id里面	 判断有没有下级目录       	   
	   if ($this->pub_find('ordersale',$map) !=0) {
		   $this->ajaxReturn(0,'该客户名下有销售记录，不可以删除',0);  
	   } else if  ($this->pub_find('orderservice',$map) !=0) {
		   $this->ajaxReturn(0,'该客户名下有售后记录，不可以删除',0);  
	   } else if  ($this->pub_find('ordercomplain',$map) !=0) {
		   $this->ajaxReturn(0,'该客户名下有投诉记录，不可以删除',0);  
	   } else if  ($this->pub_find('regularday',$map) !=0) {
		   $this->ajaxReturn(0,'该客户名下有提醒日设置，不可以删除',0);  
	   } else {			   
	       $this->pub_del('customer');	// 没有销售记录，本分类里面没有售后记录 可以删除
	   } 	
    }
	
}