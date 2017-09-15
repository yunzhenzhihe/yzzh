<?php
namespace Home\Controller;
use Think\Controller;

// 打印报表模块
class UtilreportController extends PublicController {
	
    function _initialize() {		
     // 'MINIFY'=>true,  //压缩 设置 
	  C('MINIFY',false);
  }		
	
   function utilprint_salesrecord(){  // 打印销售单
		if  (!isset($_GET['guid'])) {  //如果没有guid值 就返回  order_guid
		 $this->error('操作失败，请刷新重试');	
		 return;
		}
   
 	    $dao = M("ordersale");
        $map['a.guid'] = array("EQ",$_GET['guid']);  
        $map['a.company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	 return_money
	    $rs=$dao
		    ->alias('a')
			->field(array('a.guid','a.customer_guid','a.date_sale','a.order_number','a.goods_name','a.sales_json',
			              'a.sale_quantity','a.salegoods_money','a.discount_money','a.sale_money','a.return_money','a.sales_unit','a.buy_way','a.date_delivery','a.time_delivery','a.order_status',
						  'a.salesman','a.technician','a.sales_field1','a.sales_field2','a.sales_field3','a.sales_field4','a.sales_field5','a.sales_field6',
			              'a.sales_field7','a.sales_field8','a.sales_field9','a.sales_field10','a.sales_memo',
			              'a.creat_time','a.creat_name',
						  'b.customer_memo','b.custom_field1','b.custom_field2','b.custom_field3','b.custom_field4','b.custom_field5','b.custom_field6',
						  'b.custom_field7','b.custom_field8','b.custom_field9','b.custom_field10',
			              'b.name','b.phone_number','b.email','b.address'
						  ))	
			->join( C('DB_PREFIX') . 'customer AS b ON a.customer_guid = b.guid and b.company_id='.$_SESSION['company_id'] )			
			->where($map)
			->find();	
			
		$map2['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map2['ordersale_guid'] = array("EQ",$_GET['guid']);     // 	
        $dao2 = M("ordersaledetails");
		$rs2=$dao2
			->field(array('goods_number','goods_name','goods_specs','goods_unit','goods_quantity','goods_unitprice','goods_money'
						  ))		
		     ->where($map2)
			 ->select();	
		
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		    $this->error('操作失败，请刷新重试');  //错误
			return;
		}
        else {		
			$this->assign("order_info", $rs); //销售订单的基本资料					
            $this->assign("goods_list", $rs2); //商品明细	
		}   
		
		$report_programcodes=get_reportprogramcodes(1);  //取出打印程序代码   
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {			
	        $report_programcodes = str_replace('变量_姓名', $rs['name'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话		
			$report_programcodes = str_replace('变量_电话', $rs['phone_number'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话		
			$report_programcodes = str_replace('变量_地址', $rs['address'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话	
			$report_programcodes = str_replace('变量_单号', $rs['order_number'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话	
			$report_programcodes = str_replace('变量_销售日期', $rs['date_sale'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_交货日期', $rs['date_delivery'].$rs['time_delivery'], $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_销售日期', $rs['date_sale'], $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_制单日期', date('Y-m-d H:i:s'), $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_制单人', $_SESSION['username'], $report_programcodes);  //替换 $report_programcodes  变量 			
			
			//以下是未公开变量
			$report_programcodes = str_replace('变量_邮件', $rs['email'], $report_programcodes);  //替换 $report_programcodes  变量  邮件
			$report_programcodes = str_replace('变量_销售单位', $rs['sales_unit'], $report_programcodes);  //替换 $report_programcodes  变量  销售单位
			$report_programcodes = str_replace('变量_技术人员', $rs['technician'], $report_programcodes);  //替换 $report_programcodes  变量  技术负责
			$report_programcodes = str_replace('变量_销售人员', $rs['salesman'], $report_programcodes);  //替换 $report_programcodes  变量  销售人员
			$report_programcodes = str_replace('变量_销售备注', $rs['sales_memo'], $report_programcodes);  //替换 $report_programcodes  变量  销售备注	
            $report_programcodes = str_replace('变量_销售自定义1', $rs['sales_field1'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量1		
			$report_programcodes = str_replace('变量_销售自定义2', $rs['sales_field2'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量2	
			$report_programcodes = str_replace('变量_销售自定义3', $rs['sales_field3'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量3	
			$report_programcodes = str_replace('变量_销售自定义4', $rs['sales_field4'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量4	
			$report_programcodes = str_replace('变量_销售自定义5', $rs['sales_field5'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量5	
            $report_programcodes = str_replace('变量_销售自定义6', $rs['sales_field6'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量6		
			$report_programcodes = str_replace('变量_销售自定义7', $rs['sales_field7'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量7	
			$report_programcodes = str_replace('变量_销售自定义8', $rs['sales_field8'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量8	
			$report_programcodes = str_replace('变量_销售自定义9', $rs['sales_field9'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量9	
			$report_programcodes = str_replace('变量_销售自定义10', $rs['sales_field10'], $report_programcodes);  //替换 $report_programcodes  变量  销售自定义变量10	
            $report_programcodes = str_replace('变量_客户自定义1', $rs['custom_field1'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量1	
            $report_programcodes = str_replace('变量_客户自定义2', $rs['custom_field2'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量2	
            $report_programcodes = str_replace('变量_客户自定义3', $rs['custom_field3'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量3		
			$report_programcodes = str_replace('变量_客户自定义4', $rs['custom_field4'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量4	
			$report_programcodes = str_replace('变量_客户自定义5', $rs['custom_field5'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量5	
            $report_programcodes = str_replace('变量_客户自定义6', $rs['custom_field6'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量6	
            $report_programcodes = str_replace('变量_客户自定义7', $rs['custom_field7'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量7	
            $report_programcodes = str_replace('变量_客户自定义8', $rs['custom_field8'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量8		
			$report_programcodes = str_replace('变量_客户自定义9', $rs['custom_field9'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量9	
			$report_programcodes = str_replace('变量_客户自定义10', $rs['custom_field10'], $report_programcodes);  //替换 $report_programcodes  变量  客户自定义变量10				
			//以上是未公开变量
			$this->assign("report_programcodes", $report_programcodes); 	
		}
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}		
		

       $this->display();	
   }
   
   function utilprint_servicerecord(){  // 打印售后单
		if  (!isset($_GET['guid'])) {  //如果没有guid值 就返回  order_guid
		 $this->error('操作失败，请刷新重试');	
		 return;
		}   
 	    $dao = M("orderservice");
        $map['guid'] = array("EQ",$_GET['guid']);  
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
        $map['branch_id'] = $_SESSION['branch_id'];			
	    $rs=$dao	
			->where($map)
			->find();	
			
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		    $this->error('操作失败，请刷新重试');  //错误
			return;
		}
        else {		
			$this->assign("order_info", $rs); //销售订单的基本资料					
		}   
		
		$report_programcodes=get_reportprogramcodes(2);  //取出打印程序代码   
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {	
			$rs['date_report']=substr($rs['date_report'],0,16);
			$rs['date_appointment']=substr($rs['date_appointment'],0,16);		
	        $report_programcodes = str_replace('变量_姓名', $rs['name'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话		
			$report_programcodes = str_replace('变量_电话', $rs['phone_number'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话		
			$report_programcodes = str_replace('变量_地址', $rs['address'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话	
			$report_programcodes = str_replace('变量_单号', $rs['order_number'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话				
            $report_programcodes = str_replace('变量_报修日期', $rs['date_report'], $report_programcodes);  //替换 $report_programcodes  变量 			
			$report_programcodes = str_replace('变量_服务时间', $rs['date_appointment'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_售后人员', $rs['service_staff'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_商品分类', $rs['goods_type'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_商品名称', $rs['goods_name'], $report_programcodes);  //替换 $report_programcodes  变量 			
			$report_programcodes = str_replace('变量_售后类型', $rs['service_type'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_报修故障', $rs['service_fault'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_备注', $rs['service_memo'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_制单日期', date('Y-m-d H:i:s'), $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_制单人', $_SESSION['username'], $report_programcodes);  //替换 $report_programcodes  变量 		
			
			//以下是未公开变量
            $report_programcodes = str_replace('变量_售后自定义1', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量1		
			$report_programcodes = str_replace('变量_售后自定义2', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量2	
			$report_programcodes = str_replace('变量_售后自定义3', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量3	
			$report_programcodes = str_replace('变量_售后自定义4', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量4	
			$report_programcodes = str_replace('变量_售后自定义5', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量5	
            $report_programcodes = str_replace('变量_售后自定义6', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量6		
			$report_programcodes = str_replace('变量_售后自定义7', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量7	
			$report_programcodes = str_replace('变量_售后自定义8', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量8	
			$report_programcodes = str_replace('变量_售后自定义9', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量9	
			$report_programcodes = str_replace('变量_售后自定义10', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量10	
			//以上是未公开变量  
			$this->assign("report_programcodes", $report_programcodes); 	
		}
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}		
       $this->display();	
   } 
   
   function utilprint_allservicerecord(){  // 售后单打印（填全数据）
		if  (!isset($_GET['guid'])) {  //如果没有guid值 就返回  order_guid
		 $this->error('操作失败，请刷新重试');	
		 return;
		}   
 	    $dao = M("orderservice");
        $map['guid'] = array("EQ",$_GET['guid']);  
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
        $map['branch_id'] = $_SESSION['branch_id'];			
	    $rs=$dao	
			->where($map)
			->find();	
			
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		    $this->error('操作失败，请刷新重试');  //错误
			return;
		}
        else {		
			$this->assign("order_info", $rs); //销售订单的基本资料					
		}   
		
		$report_programcodes=get_reportprogramcodes(2);  //取出打印程序代码   
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {	
			$rs['date_report']=substr($rs['date_report'],0,16);
			$rs['date_appointment']=substr($rs['date_appointment'],0,16);		
	        $report_programcodes = str_replace('变量_姓名', $rs['name'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话		
			$report_programcodes = str_replace('变量_电话', $rs['phone_number'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话		
			$report_programcodes = str_replace('变量_地址', $rs['address'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话	
			$report_programcodes = str_replace('变量_单号', $rs['order_number'], $report_programcodes);  //替换 $report_programcodes  变量  客户姓名 地址 电话				
            $report_programcodes = str_replace('变量_报修日期', $rs['date_report'], $report_programcodes);  //替换 $report_programcodes  变量 			
			$report_programcodes = str_replace('变量_服务时间', $rs['date_appointment'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_售后人员', $rs['service_staff'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_商品分类', $rs['goods_type'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_商品名称', $rs['goods_name'], $report_programcodes);  //替换 $report_programcodes  变量 			
			$report_programcodes = str_replace('变量_售后类型', $rs['service_type'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_报修故障', $rs['service_fault'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_备注', $rs['service_memo'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_制单日期', date('Y-m-d H:i:s'), $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_制单人', $_SESSION['username'], $report_programcodes);  //替换 $report_programcodes  变量 		
			
			$report_programcodes = str_replace('到达', '到达日期：'.$rs['date_arrival'], $report_programcodes);  //替换 $report_programcodes  变量 	
			
			
			
			//以下是未公开变量
            $report_programcodes = str_replace('变量_售后自定义1', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量1		
			$report_programcodes = str_replace('变量_售后自定义2', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量2	
			$report_programcodes = str_replace('变量_售后自定义3', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量3	
			$report_programcodes = str_replace('变量_售后自定义4', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量4	
			$report_programcodes = str_replace('变量_售后自定义5', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量5	
            $report_programcodes = str_replace('变量_售后自定义6', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量6		
			$report_programcodes = str_replace('变量_售后自定义7', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量7	
			$report_programcodes = str_replace('变量_售后自定义8', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量8	
			$report_programcodes = str_replace('变量_售后自定义9', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量9	
			$report_programcodes = str_replace('变量_售后自定义10', $rs['record_field1'], $report_programcodes);  //替换 $report_programcodes  变量  售后自定义变量10	
			//以上是未公开变量  
			$this->assign("report_programcodes", $report_programcodes); 	
		}
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}		
       $this->display();	
   }    
   
   

   function utilprint_stockinrecord(){  // 打印入库单
		if  (!isset($_GET['guid'])) {  //如果没有guid值 就返回  order_guid
		 $this->error('操作失败，请刷新重试');	
		 return;
		}
   
 	    $dao = M("stockin");
        $map['guid'] = array("EQ",$_GET['guid']);  
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	 return_money
		$map['branch_id'] = $_SESSION['branch_id'];
		$map['flag']  = 1; //标记 1：入库 
	    $rs=$dao
			->field(array('order_number','goods_totalquantity','goods_totalmoney','goods_date',
			              'gestor','supplier','memo'
						  ))			
			->where($map)
			->find();	
			
		$map2['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map2['branch_id'] = $_SESSION['branch_id'];
		$map2['order_guid'] = array("EQ",$_GET['guid']);  
        $dao2 = M("Stockdetails");
		$rs2=$dao2->where($map2)->select();	 	
		

		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		    $this->error('操作失败，请刷新重试');  //错误
			return;
		}
        else {		
			$this->assign("order_info", $rs); //入库订单的基本资料					
            $this->assign("goods_list", $rs2); //商品明细	
		}   
		
		$report_programcodes=get_reportprogramcodes(3);  //取出打印程序代码   
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {			
			$report_programcodes = str_replace('变量_单号', $rs['order_number'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_入库日期', $rs['goods_date'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_经办人', $rs['gestor'].$rs['time_delivery'], $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_供应商', $rs['supplier'], $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_订单备注', $rs['memo'], $report_programcodes);  //替换 $report_programcodes  变量 			
			$report_programcodes = str_replace('变量_制单日期', date('Y-m-d H:i:s'), $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_制单人', $_SESSION['username'], $report_programcodes);  //替换 $report_programcodes  变量 	
			$this->assign("report_programcodes", $report_programcodes); 	
		}
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}		
		

       $this->display();	
   }  
   
   function utilprint_stockservicestaffoutrecord(){  // 打印领料单
		if  (!isset($_GET['guid'])) {  //如果没有guid值 就返回  order_guid
		 $this->error('操作失败，请刷新重试');	
		 return;
		}
   
 	    $dao = M("stockservicestaff");
        $map['guid'] = array("EQ",$_GET['guid']);  
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	 return_money
		$map['branch_id'] = $_SESSION['branch_id'];
		$map['flag']  = 4; //标记 4：领料 5：退料 
	    $rs=$dao
			->field(array('order_number','goods_totalquantity','goods_totalmoney','goods_date',
			              'gestor','servicestaff','memo'
						  ))			
			->where($map)
			->find();	

		$map2['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map2['branch_id'] = $_SESSION['branch_id'];
		$map2['order_guid'] = array("EQ",$_GET['guid']);  
        $dao2 = M("Stockdetails");
		$rs2=$dao2->where($map2)->select();	 	
		
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		    $this->error('操作失败，请刷新重试');  //错误
			return;
		}
        else {		
			$this->assign("order_info", $rs); //入库订单的基本资料					
            $this->assign("goods_list", $rs2); //商品明细	
		}   
		
		$report_programcodes=get_reportprogramcodes(4);  //取出打印程序代码   
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {			
			$report_programcodes = str_replace('变量_单号', $rs['order_number'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_领料日期', $rs['goods_date'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_经办人', $rs['gestor'].$rs['time_delivery'], $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_售后人员', $rs['servicestaff'], $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_备注', $rs['memo'], $report_programcodes);  //替换 $report_programcodes  变量 			
			$report_programcodes = str_replace('变量_制单日期', date('Y-m-d H:i:s'), $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_制单人', $_SESSION['username'], $report_programcodes);  //替换 $report_programcodes  变量 	
			$this->assign("report_programcodes", $report_programcodes); 	
		}
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}		
       $this->display();	
   }   

   function utilprint_stockservicestaffinrecord(){  // 打印退料单
		if  (!isset($_GET['guid'])) {  //如果没有guid值 就返回  order_guid
		 $this->error('操作失败，请刷新重试');	
		 return;
		}
   
 	    $dao = M("stockservicestaff");
        $map['guid'] = array("EQ",$_GET['guid']);  
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	 return_money
		$map['branch_id'] = $_SESSION['branch_id'];
		$map['flag']  = 5; //标记 4：领料 5：退料 
	    $rs=$dao
			->field(array('order_number','goods_totalquantity','goods_totalmoney','goods_date',
			              'gestor','servicestaff','memo'
						  ))			
			->where($map)
			->find();	

		$map2['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map2['branch_id'] = $_SESSION['branch_id'];
		$map2['order_guid'] = array("EQ",$_GET['guid']);  
        $dao2 = M("Stockdetails");
		$rs2=$dao2->where($map2)->select();	 	
		
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		    $this->error('操作失败，请刷新重试');  //错误
			return;
		}
        else {		
			$this->assign("order_info", $rs); //入库订单的基本资料					
            $this->assign("goods_list", $rs2); //商品明细	
		}   
		
		$report_programcodes=get_reportprogramcodes(5);  //取出打印程序代码   
		if (   $report_programcodes == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {			
			$report_programcodes = str_replace('变量_单号', $rs['order_number'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_退料日期', $rs['goods_date'], $report_programcodes);  //替换 $report_programcodes  变量  
			$report_programcodes = str_replace('变量_经办人', $rs['gestor'].$rs['time_delivery'], $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_售后人员', $rs['servicestaff'], $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_备注', $rs['memo'], $report_programcodes);  //替换 $report_programcodes  变量 			
			$report_programcodes = str_replace('变量_制单日期', date('Y-m-d H:i:s'), $report_programcodes);  //替换 $report_programcodes  变量 
			$report_programcodes = str_replace('变量_制单人', $_SESSION['username'], $report_programcodes);  //替换 $report_programcodes  变量 	
			$this->assign("report_programcodes", $report_programcodes); 	
		}
        $report_setup=get_reportsetup() ;  //获取打印报表参数 打印份数  纵向打印 或者横向打印		
		if (   $report_setup == 'flase' ) {
			$this->error('操作失败，请刷新重试');  //错误
			return;
		}  else {
			$this->assign("report_setup", $report_setup); 
		}		
       $this->display();	
   }    
   
   

   
   
	
	
	
}